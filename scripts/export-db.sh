#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
DUMP_DIR="$ROOT_DIR/database/init"
DUMP_FILE="${1:-$DUMP_DIR/001-webshop.sql}"

mkdir -p "$DUMP_DIR"

cd "$ROOT_DIR"

docker compose exec -T webshop-db \
  mariadb-dump \
  -u"$WORDPRESS_DB_USER" \
  -p"$WORDPRESS_DB_PASSWORD" \
  "$WORDPRESS_DB_NAME" > "$DUMP_FILE"

echo "Database dump written to $DUMP_FILE"
