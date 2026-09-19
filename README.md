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

Opções do BOCA ligadas no `docker-compose.prod.yml`: `BOCA_ENABLE_VIEW_RUNS`, `BOCA_ENABLE_PROBLEM_STATS`,
`BOCA_SHOW_UNSOLVED_FIRST`, `BOCA_ENABLE_TABLE_FILTER`, `BOCA_DISABLE_TASKS` e `BOCA_TRUSTED_PROXIES`.

## Como roda

Stack `boca-treinamento` na VM do PET, atrás do Traefik:

| Container | Imagem |
|---|---|
| `boca-treinamento_web` | `ghcr.io/pet-eng-comp-org/boca-treinamento/web`, publicada por este repositório |
| `boca-treinamento_jail` | `ghcr.io/rlaiola/boca-docker/boca-jail` |
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

O Dependabot abre PR quando sai versão nova do `boca-web` (no `Dockerfile`), do `boca-jail` e do `postgres` (nos
composes). O `boca-web` e o `boca-jail` vão juntos para produção.

No PR do `boca-web`, o CI roda `./verifica-base.sh`, que falha se a versão nova mudou algum arquivo que
`personalizacao/` sobrescreve ou o `/init.sh` (conferir se o `init-pet.sh` continua cobrindo o que ele faz). Nesse caso: comparar o arquivo novo da base com o nosso, trazer para
`personalizacao/` o que a base mudou, rodar `./verifica-base.sh --atualiza` e commitar no mesmo PR.

</details>

<details>
<summary><b>Publicar e implantar</b></summary>

1. Merge na `main` publica `ghcr.io/pet-eng-comp-org/boca-treinamento/web:sha-<commit>`; o digest aparece no resumo
   do workflow.
2. Trocar o digest em `docker-compose.prod.yml` por um PR.
3. No Portainer, atualizar a stack `boca-treinamento` com o compose novo, mantendo as variáveis.

Nada chega à VM sozinho: as imagens estão fixadas por digest.

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
