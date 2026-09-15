#!/usr/bin/env bash
# Writes the .env used by the PHPUnit job in .github/workflows/deploy.yml.
# phpunit.xml pins DB_DATABASE=testing; host/credentials must point at the MySQL service.
set -euo pipefail

: "${MYSQL_ROOT_PASSWORD:?MYSQL_ROOT_PASSWORD is required}"

cp .env.example .env

set_env() {
  local key="$1" value="$2"
  if grep -qE "^${key}=" .env; then
    sed -i.bak -E "s|^${key}=.*|${key}=${value}|" .env && rm -f .env.bak
  else
    printf '%s=%s\n' "$key" "$value" >> .env
  fi
}

set_env APP_NAME DigiSpace
set_env APP_ENV testing
set_env APP_URL "http://localhost:8100"
set_env DB_CONNECTION mysql
set_env DB_HOST 127.0.0.1
set_env DB_PORT 3306
set_env DB_DATABASE testing
set_env DB_USERNAME root
set_env DB_PASSWORD "$MYSQL_ROOT_PASSWORD"
set_env CACHE_DRIVER array
set_env SESSION_DRIVER array
set_env QUEUE_CONNECTION sync
set_env MAIL_MAILER array

php artisan key:generate --force --no-interaction
