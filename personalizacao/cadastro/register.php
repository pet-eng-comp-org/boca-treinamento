<?php
// Autocadastro de equipes do BOCA de treinamento.
// Os valores vão ao banco por pg_query_params, nunca concatenados no SQL.

require_once('../hex.php');
require_once('../private/conf.php');   // globalconf(): a mesma configuração de banco do BOCA

function falha($msg) {
	http_response_code(400);
	echo '<html><head><meta charset="utf-8"><title>Cadastro</title></head><body>';
	echo '<p>' . htmlspecialchars($msg, ENT_QUOTES, 'UTF-8') . '</p>';
	echo '<p><a href="index.php">Voltar</a></p></body></html>';
	exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	header('Location: index.php');
	exit;
}

session_start();
$token = $_POST['token'] ?? '';
if (empty($_SESSION['cadastro_token']) || !is_string($token) || !hash_equals($_SESSION['cadastro_token'], $token))
	falha('O formulário expirou. Volte e preencha de novo.');
// isca: só robô preenche; responde como se tivesse dado certo, sem gravar nada
if (($_POST['site'] ?? '') !== '') {
	header('Location: sucess.php');
	exit;
}

$username = trim($_POST['username'] ?? '');
$fullname = trim($_POST['fullname'] ?? '');
$email = trim($_POST['email0'] ?? '');
$password = $_POST['passwordn1'] ?? '';
$checkpass = $_POST['passwordn2'] ?? '';

if ($username === '' || $fullname === '' || $email === '' || $password === '' || $checkpass === '')
	falha('Preencha todos os campos.');
// o login do BOCA (flog.php) só aceita nome de usuário alfanumérico
if (!preg_match('/^[A-Za-z0-9]{3,20}$/', $username))
	falha('O usuário deve ter de 3 a 20 caracteres, só letras sem acento e números.');
// a imagem não tem mbstring; o /u conta caracteres e recusa UTF-8 inválido
if (!preg_match('/^.{1,200}$/su', $fullname))
	falha('O nome completo pode ter no máximo 200 caracteres.');
// o placar do BOCA imprime o nome sem escape
if (preg_match('/[<>"`\\\\\x00-\x1f]/', $fullname))
	falha('O nome completo não pode ter os caracteres < > " ` \\.');
// O FILTER_VALIDATE_EMAIL aceita parte local entre aspas, com < > [ ] e ".
// O BOCA imprime o e-mail (userdesc) sem escape na lista de usuários do admin e
// lê bandeira de [..] dele no placar, então só entra e-mail simples.
if (strlen($email) > 300 || !filter_var($email, FILTER_VALIDATE_EMAIL)
    || !preg_match('/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/', $email))
	falha('E-mail inválido.');
if (strlen($password) < 6)
	falha('A senha deve ter pelo menos 6 caracteres.');
if ($password !== $checkpass)
	falha('As senhas não conferem.');

$cf = globalconf();
$q = function ($v) { return "'" . addcslashes((string) $v, "'\\") . "'"; };
$bdcon = pg_connect('host=' . $q($cf['dbhost']) . ' port=' . $q($cf['dbport']) . ' dbname=' . $q($cf['dbname'])
	. ' user=' . $q($cf['dbuser']) . ' password=' . $q($cf['dbpass']) . ' connect_timeout=5');
if (!$bdcon)
	falha('Não foi possível conectar ao banco. Tente de novo mais tarde.');

// Trava só entre cadastros (não a tabela, que o login do BOCA também atualiza), para dois
// cadastros simultâneos não pegarem o mesmo número nem o mesmo nome.
pg_query($bdcon, 'BEGIN');
pg_query($bdcon, "SELECT pg_advisory_xact_lock(hashtext('boca-cadastro'))");

// o login do BOCA procura o usuário no concurso ativo e no site local dele
$r = pg_query($bdcon, 'SELECT contestnumber, contestlocalsite FROM contesttable WHERE contestactive = true ORDER BY contestnumber DESC LIMIT 1');
if ($r === false || pg_num_rows($r) == 0) {
	pg_query($bdcon, 'ROLLBACK');
	falha('Não há concurso ativo no momento. Tente mais tarde.');
}
$concurso = (int) pg_fetch_result($r, 0, 0);
$site = (int) pg_fetch_result($r, 0, 1);

$r = pg_query_params($bdcon, 'SELECT 1 FROM usertable WHERE username = $1 AND contestnumber = $2', array($username, $concurso));
if ($r === false) {
	pg_query($bdcon, 'ROLLBACK');
	falha('Erro ao consultar o banco.');
}
if (pg_num_rows($r) > 0) {
	pg_query($bdcon, 'ROLLBACK');
	falha('Esse usuário já existe. Escolha outro.');
}

$r = pg_query($bdcon, 'SELECT GREATEST(COALESCE(MAX(usernumber), 0), 1000) + 1 FROM usertable');
$numero = (int) pg_fetch_result($r, 0, 0);

// '!' na frente do hash: senha definida no cadastro, que o time não troca pelo BOCA.
$ok = pg_query_params($bdcon,
	"INSERT INTO usertable (contestnumber, usersitenumber, usernumber, username, userfullname, userdesc,
	                        usertype, userenabled, usermultilogin, userpassword)
	 VALUES ($6, $7, $1, $2, $3, $4, 'team', TRUE, TRUE, $5)",
	array($numero, $username, $fullname, $email, '!' . myhash($password), $concurso, $site));

if ($ok === false) {
	pg_query($bdcon, 'ROLLBACK');
	falha('Não foi possível concluir o cadastro.');
}
pg_query($bdcon, 'COMMIT');
pg_close($bdcon);
unset($_SESSION['cadastro_token']);

header('Location: sucess.php');
