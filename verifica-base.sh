#!/bin/bash
# Confere se as imagens base mudaram algum arquivo que personalizamos: o que
# personalizacao/ sobrescreve no web (e o /init.sh que o init-pet.sh substitui quando o
# banco já existe) e o que jail/personalizacao/ sobrescreve no jail.
#
# Arquivos de personalizacao/ que existem na base a substituem inteira: se o Rodrigo
# corrigir um deles numa versão nova, a nossa cópia esconde a correção. base.sha256 e
# jail/base.sha256 guardam o hash de cada um na versão da base em que a personalização
# foi feita.
#
#   ./verifica-base.sh            falha se a base de algum Dockerfile difere do manifesto
#   ./verifica-base.sh --atualiza regrava os manifestos (depois de revisar e portar)
set -euo pipefail
export LC_ALL=C   # ordem do sort igual em qualquer máquina
cd "$(dirname "$0")"

SRC=/var/www/boca/src
falhou=0

# $1: pasta com Dockerfile, personalizacao/ e base.sha256; $2: "init" para conferir o /init.sh
confere() {
  local raiz=$1 base manifesto atual
  base=$(awk '/^FROM /{print $2; exit}' "$raiz/Dockerfile")
  manifesto="$raiz/base.sha256"

  # lista na base: hash de cada arquivo que personalizacao/ também tem, ou "ausente"
  atual=$(
    cd "$raiz/personalizacao"
    find . -type f | sed 's#^\./##' | sort | docker run --rm -i --entrypoint sh "$base" -c '
      while read -r f; do
        if [ -f "'$SRC'/$f" ]; then sha256sum "'$SRC'/$f" | sed "s#  '$SRC'/#  #"
        else echo "ausente  $f"; fi
      done
      if [ "'"${2:-}"'" = init ]; then sha256sum /init.sh | sed "s#  /#  (entrypoint) #"; fi'
  )

  if [ "$ATUALIZA" = 1 ]; then
    echo "$atual" > "$manifesto"
    echo "$manifesto regravado a partir de $base"
    return
  fi

  if diff <(echo "$atual") "$manifesto" > /dev/null; then
    echo "Base sem mudança nos arquivos personalizados ($base)."
    return
  fi

  echo "A base $base mudou arquivos que $raiz/personalizacao/ sobrescreve:"
  # diff sai com 1 quando difere: sem o || true, o pipefail abortaria antes de conferir a outra base
  { diff <(echo "$atual") "$manifesto" || true; } | awk '/^[<>]/{print "  " $3}' | sort -u
  falhou=1
}

ATUALIZA=0
[ "${1:-}" = "--atualiza" ] && ATUALIZA=1

confere . init
confere jail

if [ "$falhou" = 1 ]; then
  cat <<'EOF'

Para cada arquivo acima, compare a versão nova da base com a nossa, traga para
personalizacao/ o que a base corrigiu ou acrescentou e rode ./verifica-base.sh --atualiza.
Um arquivo que era "ausente" e passou a existir na base: renomeie o nosso ou incorpore o dela.
No jail, se o rlaiola/boca voltar a traduzir o retorno do compare (4 = YES), o nosso
autojudging.php pode sair.
EOF
  exit 1
fi
