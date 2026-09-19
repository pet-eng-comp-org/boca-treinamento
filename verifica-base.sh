#!/bin/bash
# Confere se a imagem base mudou algum arquivo que personalizacao/ sobrescreve.
#
# Arquivos de personalizacao/ que existem na base a substituem inteira: se o Rodrigo
# corrigir um deles numa versão nova, a nossa cópia esconde a correção. base.sha256
# guarda o hash de cada um na versão da base em que a personalização foi feita.
#
#   ./verifica-base.sh            falha se a base do Dockerfile difere de base.sha256
#   ./verifica-base.sh --atualiza regrava base.sha256 (depois de revisar e portar)
set -euo pipefail
cd "$(dirname "$0")"

BASE=$(awk '/^FROM /{print $2; exit}' Dockerfile)
SRC=/var/www/boca/src
MANIFESTO=base.sha256

# lista na base: hash de cada arquivo que personalizacao/ também tem, ou "ausente"
atual=$(
  cd personalizacao
  find . -type f | sed 's#^\./##' | sort | docker run --rm -i --entrypoint sh "$BASE" -c '
    while read -r f; do
      if [ -f "'$SRC'/$f" ]; then sha256sum "'$SRC'/$f" | sed "s#  '$SRC'/#  #"
      else echo "ausente  $f"; fi
    done'
)

if [ "${1:-}" = "--atualiza" ]; then
  echo "$atual" > "$MANIFESTO"
  echo "$MANIFESTO regravado a partir de $BASE"
  exit 0
fi

if diff <(echo "$atual") "$MANIFESTO" > /dev/null; then
  echo "Base sem mudança nos arquivos personalizados ($BASE)."
  exit 0
fi

echo "A base mudou arquivos que personalizacao/ sobrescreve:"
diff <(echo "$atual") "$MANIFESTO" | awk '/^[<>]/{print "  " $3}' | sort -u
cat <<'EOF'

Para cada arquivo acima, compare a versão nova da base com a nossa, traga para
personalizacao/ o que a base corrigiu ou acrescentou e rode ./verifica-base.sh --atualiza.
Um arquivo que era "ausente" e passou a existir na base: renomeie o nosso ou incorpore o dela.
EOF
exit 1
