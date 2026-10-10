# 🎈 boca-treinamento

[![Publica imagem no GHCR](https://github.com/pet-eng-comp-org/boca-treinamento/actions/workflows/publica-imagem.yml/badge.svg)](https://github.com/pet-eng-comp-org/boca-treinamento/actions/workflows/publica-imagem.yml)

BOCA de treinamento do Topcom, no ar o ano todo em **[boca.pet.inf.ufes.br/boca](https://boca.pet.inf.ufes.br/boca)**
com as questões das edições anteriores. Equipes se cadastram sozinhas.

## De onde vem

| Camada | Projeto |
|---|---|
| BOCA | [cassiopc/boca](https://github.com/cassiopc/boca) — o juiz da Maratona SBC |
| BOCA com melhorias | [rlaiola/boca](https://github.com/rlaiola/boca) — fork do Rodrigo Laiola |
| Docker | [rlaiola/boca-docker](https://github.com/rlaiola/boca-docker) — imagens `boca-web` e `boca-jail`; variáveis de ambiente e opções documentadas lá |
| Personalização do PET | este repositório |

## O que o PET muda

A imagem é a `boca-web` do boca-docker com `personalizacao/` copiada por cima de `/var/www/boca/src`:

| Em `personalizacao/` | O quê |
|---|---|
| `index.php`, `Css.php` | tela de login e cores do Topcom, botões de cadastro e manual |
| `admin/`, `system/`, `team/` `header.php` | cor da barra de cada perfil |
| `admin/language.php` | cor dos links |
| `cadastro/` | autocadastro de equipes (não existe no BOCA), com token no formulário, campo isca para robô e limite por IP no Traefik |
| `images/`, `arquivos/` | logos do Topcom e o manual do usuário |

O entrypoint é o `init-pet.sh`: se o banco já existe, sobe o Apache sem passar pelo `/init.sh` do boca-docker, que
recria o banco do zero quando o `bocauser` não consegue conectar por qualquer motivo.

O jail é a `boca-jail` do boca-docker com o `autojudging.php` de antes do commit
[`e46ca73`](https://github.com/rlaiola/boca/commit/e46ca73) do rlaiola/boca (em `jail/personalizacao/`). Esse commit
passou a usar o código de saída do script `compare` como número da resposta, e os pacotes de problema no formato do
BOCA saem com 4 quando a saída bate: 4 é "Time limit exceeded", então toda solução certa virava TLE. A versão
anterior traduz 4 para YES e para no primeiro caso de teste errado.

Opções do BOCA ligadas no `docker-compose.prod.yml`: `BOCA_ENABLE_VIEW_RUNS`, `BOCA_ENABLE_PROBLEM_STATS`,
`BOCA_SHOW_UNSOLVED_FIRST`, `BOCA_ENABLE_TABLE_FILTER`, `BOCA_DISABLE_TASKS` e `BOCA_TRUSTED_PROXIES`.

## Como roda

Stack `boca-treinamento` na VM do PET, atrás do Traefik:

| Container | Imagem |
|---|---|
| `boca-treinamento_web` | `ghcr.io/pet-eng-comp-org/boca-treinamento/web`, publicada por este repositório |
| `boca-treinamento_jail` | `ghcr.io/pet-eng-comp-org/boca-treinamento/jail`, publicada por este repositório |
| `boca-treinamento_database` | `postgres:14-alpine` |

O jail e o banco ficam numa rede só da stack, sem internet. Senhas nas variáveis da stack no Portainer, com cópia
no Notion (página Senhas).

## Rodar localmente

```sh
docker compose -f docker-compose.dev.yml watch
```

BOCA em http://localhost:8000/boca, usuário `system`, senha `boca`, com banco vazio. Arquivo editado em
`personalizacao/` aparece na hora, sem rebuild.

<details>
<summary><b>Atualizar o BOCA</b></summary>

As bases (`boca-web` no `Dockerfile`, `boca-jail` no `jail/Dockerfile`) vêm de um espelho no GHCR deste
repositório (`boca-treinamento/web-base` e `jail-base`, uma tag por data). O `rlaiola/boca-docker` reconstrói a
`1.2.3` todo dia e apaga as versões antigas aos sábados, então um `FROM` fixado direto nele quebrava o build em até
uma semana. Toda segunda o `espelha-base.yml` copia a base e, se ela mudou, abre PR trocando o `FROM` e dispara o
build dela; também roda pela aba Actions. O Dependabot cuida só do `postgres` (nos composes) e das actions. O
`boca-web` e o `boca-jail` vão juntos para produção.

Nesses PRs, o CI roda `./verifica-base.sh`, que falha se a versão nova mudou algum arquivo que `personalizacao/` ou
`jail/personalizacao/` sobrescreve, ou o `/init.sh` (conferir se o `init-pet.sh` continua cobrindo o que ele faz).
Nesse caso: comparar o arquivo novo da base com o nosso, trazer para a personalização o que a base mudou, rodar
`./verifica-base.sh --atualiza` e commitar no mesmo PR. Se o `autojudging.php` novo voltar a tratar o 4 do `compare`
como YES, o nosso pode sair.

</details>

<details>
<summary><b>Publicar e implantar</b></summary>

Merge na `main` é implantar: o CI publica `ghcr.io/pet-eng-comp-org/boca-treinamento/web` e `.../jail` com a tag
`sha-<commit>` e grava em `docker-compose.prod.yml` o digest de quem mudou; a stack `boca-treinamento` é git-ops e o
Portainer aplica em até 5 minutos. PR do Dependabot no compose (postgres) também vai para produção no merge.

Voltar uma versão: `git revert` do commit `deploy: ...`.

</details>

<details>
<summary><b>Trocar a senha do <code>bocauser</code></b></summary>

Sempre no banco primeiro e depois na variável `BOCA_DB_PASSWORD` da stack:

```sql
ALTER ROLE bocauser PASSWORD '...';
```

Na ordem inversa o site não conecta ao banco até a variável ser corrigida (o `init-pet.sh` impede que o banco seja
recriado).

</details>

## Créditos e licença

BOCA por Cassio de Campos; boca-docker por João Vitor Alves Fazolo e Rodrigo Laiola Guimarães (UFES).
Personalização do PET Engenharia de Computação — UFES.

GPL-3.0, como o BOCA e o boca-docker. Os arquivos de `personalizacao/` que existem no BOCA são versões modificadas
dos originais.
