#!/usr/bin/env bash
# Automated WordPress + WooCommerce setup via WP-CLI.
# Runs as a one-off service in Docker Compose (webshop-cli).
# All steps are idempotent — safe to re-run against an existing installation.
set -euo pipefail

MAX_WAIT=120  # seconds

echo "[wpcli] Waiting for WordPress files to be available..."
elapsed=0
until [ -f /var/www/html/wp-load.php ]; do
  if [ "$elapsed" -ge "$MAX_WAIT" ]; then
    echo "[wpcli] ERROR: WordPress files not found after ${MAX_WAIT}s. Check the webshop-web container." >&2
    exit 1
  fi
  sleep 2
  elapsed=$((elapsed + 2))
done

echo "[wpcli] Waiting for the database to accept connections..."
elapsed=0
until wp db check --quiet 2>/dev/null; do
  if [ "$elapsed" -ge "$MAX_WAIT" ]; then
    echo "[wpcli] ERROR: Database not reachable after ${MAX_WAIT}s. Check the webshop-db container." >&2
    exit 1
  fi
  sleep 3
  elapsed=$((elapsed + 3))
done

# Install WordPress core only if it has not been installed yet.
if wp core is-installed --quiet 2>/dev/null; then
  echo "[wpcli] WordPress is already installed — skipping core install."
else
  echo "[wpcli] Installing WordPress core..."
  wp core install \
    --url="http://localhost:${WORDPRESS_PORT:-18080}" \
    --title="${WORDPRESS_TITLE:-Webshop}" \
    --admin_user="${WORDPRESS_ADMIN_USER:-admin}" \
    --admin_password="${WORDPRESS_ADMIN_PASSWORD:-change-me-local}" \
    --admin_email="${WORDPRESS_ADMIN_EMAIL:-admin@example.com}" \
    --skip-email
  echo "[wpcli] WordPress core installed."
fi

# Install and activate WooCommerce.
if wp plugin is-installed woocommerce --quiet 2>/dev/null; then
  echo "[wpcli] WooCommerce is already installed — ensuring it is active..."
  wp plugin activate woocommerce --quiet
else
  echo "[wpcli] Installing and activating WooCommerce..."
  wp plugin install woocommerce --activate
fi

echo "[wpcli] Setup complete. WordPress is ready at http://localhost:${WORDPRESS_PORT:-18080}"
