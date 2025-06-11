<?php

require_once('../hex.php');


$BOCA_DB_HOST = getenv('BOCA_DB_HOST') ?: 'localhost';
$BOCA_DB_NAME = getenv('BOCA_DB_NAME') ?: 'localhost';
$BOCA_DB_PASSWORD = getenv('BOCA_DB_PASSWORD') ?: 'localhost';
$BOCA_DB_USER = getenv('BOCA_DB_USER') ?: 'bocauser';
$BOCA_URL = getenv('BOCA_URL') ?: 'localhost';
$DB_PORT = getenv('DB_PORT') ?: 5432;

$bdcon = pg_connect("host=$BOCA_DB_HOST port=$DB_PORT dbname=$BOCA_DB_NAME user=$BOCA_DB_USER password=$BOCA_DB_PASSWORD connect_timeout=5") or die("Não foi possível conectar ao DB");
?>

<html>
<head>
	<title>Cadastro</title>
</head>

<body>

<?php
	$username = $_POST["username"];
	$fullname = $_POST["fullname"];
	$email = $_POST["email0"];
	$password = $_POST["passwordn1"];
	$checkpass = $_POST["passwordn2"];

	if(trim($_POST['username'])=='' || trim($_POST['fullname'])=='' || trim($_POST['email0'])=='' || trim($_POST['passwordn1'])=='' || trim($_POST['passwordn2'])=='')
	{
	    echo('All fields are required!');
	    die;
	}
    else if($password != $checkpass){
		echo "Password don't match!!!";
		die;
	}
	else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
		echo "E-mail address '$email' is considered invalid.\n";
		die;
	}
	
	$result = pg_query($bdcon, "SELECT username FROM usertable");
	if (!$result) {
  		echo "An error occurred.\n";
  		exit;
	}

	$libera=TRUE;
	while ($row = pg_fetch_row($result)) {
  	if($username == $row[0]){
        echo "username already taken! Choose other.";
        $libera=FALSE;
  }
  echo "<br />\n";
}
if($libera){
        $result = pg_query($bdcon, "SELECT usernumber FROM usertable")  or die("ERROR: Cannot execute query\n");
        if (!$result) {
                echo "An error occurred.\n";
                exit;
        }

        $max=1000;
        while ($row = pg_fetch_row($result)) {
                if($max<$row[0]){
                        $max=$row[0];
                }
        }
        $max=$max+1;
        echo "Next ID: $max <br />\n";

        $senha = myhash($password);

        $partea = "INSERT INTO usertable VALUES(1,1,"; //1002,'testando','apenas um teste','','team',TRUE,TRUE,'!";
        $cma = ",";
        $aps = "'";
		$parteaa = ",'team',TRUE,TRUE,'!";
        $parteb = "')";
        
        $partec = $partea . $max. $cma . $aps . $username . $aps . $cma. $aps .  $fullname . $aps . $cma. $aps . $email . $aps . $parteaa . $senha . $parteb;

        $query = $partec;  
        pg_query($bdcon, $query) or die("ERROR:001!\n");

		pg_close($bdcon);
		
		header("Location: http://$BOCA_URL/cadastro/sucess.php");

}
?>

</body>

<?php

?>

</html>

