#!/bin/bash
# Entrypoint do boca-web do PET, na frente do /init.sh do boca-docker.
#
# O /init.sh decide que o banco não existe quando o bocauser não consegue conectar, por
# qualquer motivo (senha trocada, conexões esgotadas, falha de rede no boot), e aí roda o
# createdb.php, que apaga e recria o banco. Aqui a existência é perguntada ao Postgres como
# superusuário: se o banco existe, sobe o Apache sem passar pelo /init.sh; se a pergunta
# falha, o container sai e o Docker tenta de novo. O /init.sh só roda num banco que não existe.
set -uo pipefail

BOCA_DB_HOST="${BOCA_DB_HOST:-boca-db}"
BOCA_DB_SUPER_USER="${BOCA_DB_SUPER_USER:-postgres}"
BOCA_DB_NAME="${BOCA_DB_NAME:-bocadb}"
export PGPASSWORD="${BOCA_DB_SUPER_PASSWORD:-}"

until psql -h "$BOCA_DB_HOST" -U "$BOCA_DB_SUPER_USER" -d postgres -c '\q' 2>/dev/null; do
  >&2 echo "PostgreSQL server is unavailable - sleeping"
  sleep 1
done

if ! existe=$(psql -h "$BOCA_DB_HOST" -U "$BOCA_DB_SUPER_USER" -d postgres -tAc \
      "SELECT 1 FROM pg_database WHERE datname = '$BOCA_DB_NAME'"); then
  >&2 echo "Não foi possível verificar se o banco $BOCA_DB_NAME existe; saindo sem mexer nele"
  exit 1
fi
unset PGPASSWORD

if [ "$existe" = 1 ]; then
  echo "Database $BOCA_DB_NAME exists - starting Apache"
  exec apache2 -DFOREGROUND
fi

echo "Database $BOCA_DB_NAME does not exist - running boca-docker /init.sh"
exec /init.sh
