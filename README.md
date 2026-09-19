# boca-topcom

BOCA de treinamento do Topcom (`boca.pet.inf.ufes.br/boca`), no ar o ano todo para treinar com as
questões das edições anteriores.

A imagem é a `boca-web` do [boca-docker](https://github.com/rlaiola/boca-docker) (BOCA do
[cassiopc/boca](https://github.com/cassiopc/boca)) com os arquivos de `personalizacao/` copiados por cima:

- `Css.php`, `index.php` e os `header.php` — cores e tela de login do Topcom
- `cadastro/` — autocadastro de equipes
- `images/` e `arquivos/` — logos e o manual do usuário

Atualizar o BOCA é trocar a versão no `FROM` do `Dockerfile` e conferir se algum arquivo de
`personalizacao/` mudou na versão nova (`index.php` e `Css.php` costumam mudar).

`competicao/` guarda o BOCA usado no dia de cada Topcom, que roda numa máquina à parte, não na VM do PET.

## Publicar e implantar

Merge na `main` publica `ghcr.io/pet-eng-comp-org/boca-topcom:sha-<commit>`; o digest aparece no resumo do
workflow. Implantar é trocar o digest em `docker-compose.prod.yml` por um PR e atualizar a stack `boca` (30) no
Portainer. As senhas ficam nas variáveis da stack (`BOCA_DB_PASSWORD`, `BOCA_DB_SUPER_PASSWORD`,
`BOCA_PASSWORD`, `BOCA_KEY`), com cópia no Notion.

## Senha do `bocauser`

As tabelas do banco pertencem ao `bocauser`. Se a senha dele no banco não for a de `BOCA_DB_PASSWORD`, o
`init.sh` da imagem conclui que o banco não existe e roda o `createdb.php`, **que recria o banco do zero**.
Trocar essa senha é sempre nos dois lugares, banco primeiro:
`ALTER ROLE bocauser PASSWORD '...'` e depois a variável da stack.
