#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
DUMP_FILE="${1:-$ROOT_DIR/database/init/001-webshop.sql}"

if [[ ! -f "$DUMP_FILE" ]]; then
  echo "Dump file not found: $DUMP_FILE" >&2
  exit 1
fi

cd "$ROOT_DIR"

docker compose exec -T webshop-db \
  mariadb \
  -u"$WORDPRESS_DB_USER" \
  -p"$WORDPRESS_DB_PASSWORD" \
  "$WORDPRESS_DB_NAME" < "$DUMP_FILE"

echo "Database imported from $DUMP_FILE"
