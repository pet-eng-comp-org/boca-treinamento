# boca-topcom

Imagem do BOCA de treinamento do Topcom (`boca.pet.inf.ufes.br/boca`): a `boca-web` oficial do
[rlaiola/boca-docker](https://github.com/rlaiola/boca-docker) 1.2.1 com a pasta `src` do PET por cima.

- `src/` — o BOCA 1.5.17 com as personalizações do PET: visual do Topcom, placar e o autocadastro de
  equipes em `src/cadastro/`.
- `docker-compose.prod.yml` — a stack `boca` da VM. As senhas ficam nas variáveis de ambiente da stack no
  Portainer (`BOCA_DB_PASSWORD`, `BOCA_DB_SUPER_PASSWORD`, `BOCA_PASSWORD`, `BOCA_KEY`), com cópia no Notion.

## Publicar uma versão

Merge na `main` publica `ghcr.io/pet-eng-comp-org/boca-topcom:sha-<commit>`; o digest aparece no resumo do
workflow. Implantar é trocar o digest em `docker-compose.prod.yml` por um PR e atualizar a stack.

## Senha do `bocauser`

As tabelas do banco pertencem ao `bocauser`. Se a senha dele no banco não for a de `BOCA_DB_PASSWORD`, o
`init.sh` da imagem oficial conclui que o banco não existe e roda o `createdb.php`, **que recria o banco do zero**.
Trocar essa senha é sempre nos dois lugares, banco primeiro:
`ALTER ROLE bocauser PASSWORD '...'` e depois a variável da stack.
