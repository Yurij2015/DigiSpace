#!/usr/bin/env bash
# Runs on the server (over SSH) after `current` points at the new release.
# Env: BASE_PATH (release root), PHP_BINARY (e.g. /usr/bin/php8.3), optional FPM_SERVICE (default php8.3-fpm).
set -euo pipefail

: "${BASE_PATH:?BASE_PATH is required}"
PHP_BINARY="${PHP_BINARY:-php}"
FPM_SERVICE="${FPM_SERVICE:-php8.3-fpm}"

cd "${BASE_PATH}/current"

echo "PHP: $("$PHP_BINARY" -r 'echo PHP_VERSION;')"

"$PHP_BINARY" artisan migrate --force --no-interaction
"$PHP_BINARY" artisan livewire:publish --assets --no-interaction
# No route:cache: routes/web.php registers a closure route (locale.switch).
"$PHP_BINARY" artisan config:cache --no-interaction
"$PHP_BINARY" artisan view:cache --no-interaction
"$PHP_BINARY" artisan sitemap:generate --no-interaction

# Opcache: reload PHP-FPM when the site user is allowed to; otherwise CloudPanel's
# timestamp validation picks the new release up on its own.
if sudo -n systemctl reload "$FPM_SERVICE" 2>/dev/null; then
  echo "Reloaded ${FPM_SERVICE}"
else
  echo "PHP-FPM reload not permitted for this user; relying on opcache timestamp validation"
fi

echo "After-deploy finished for $(readlink -f "${BASE_PATH}/current")"
