# boca-treinamento

BOCA de treinamento do Topcom (`boca.pet.inf.ufes.br/boca`), no ar o ano todo para treinar com as
questões das edições anteriores. O BOCA do dia da competição roda em outra máquina e não está aqui.

A imagem é a `boca-web` do [boca-docker](https://github.com/rlaiola/boca-docker) (BOCA do
[cassiopc/boca](https://github.com/cassiopc/boca)) com os arquivos de `personalizacao/` copiados por cima:

- `Css.php`, `index.php` e os `header.php` — cores e tela de login do Topcom
- `cadastro/` — autocadastro de equipes
- `images/` e `arquivos/` — logos e o manual do usuário

## Atualizar o BOCA

O Dependabot abre PR quando sai versão nova do `boca-web` (no `Dockerfile`), do `boca-jail` e do
`postgres` (no `docker-compose.prod.yml`). Os dois primeiros chegam em PRs separados e vão juntos para produção.

No PR do `boca-web`, o CI roda `./verifica-base.sh`, que falha se a versão nova mudou algum arquivo que
`personalizacao/` sobrescreve (`base.sha256` guarda o hash de cada um na base atual). Nesse caso: comparar o
arquivo novo da base com o nosso, trazer para `personalizacao/` o que a base mudou, rodar
`./verifica-base.sh --atualiza` e commitar no mesmo PR.

Nada chega à VM sozinho: as imagens estão fixadas por digest, e implantar continua sendo trocar o digest do
`boca-treinamento` no compose e atualizar a stack.

## Publicar e implantar

Merge na `main` publica `ghcr.io/pet-eng-comp-org/boca-treinamento:sha-<commit>`; o digest aparece no resumo do
workflow. Implantar é trocar o digest em `docker-compose.prod.yml` por um PR e atualizar a stack `boca-treinamento` no
Portainer. As senhas ficam nas variáveis da stack (`BOCA_DB_PASSWORD`, `BOCA_DB_SUPER_PASSWORD`,
`BOCA_PASSWORD`, `BOCA_KEY`), com cópia no Notion.

## Senha do `bocauser`

As tabelas do banco pertencem ao `bocauser`. Se a senha dele no banco não for a de `BOCA_DB_PASSWORD`, o
`init.sh` da imagem conclui que o banco não existe e roda o `createdb.php`, **que recria o banco do zero**.
Trocar essa senha é sempre nos dois lugares, banco primeiro:
`ALTER ROLE bocauser PASSWORD '...'` e depois a variável da stack.
