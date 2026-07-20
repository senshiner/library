#!/usr/bin/env bash
set -euo pipefail

composer install --no-dev --optimize-autoloader --no-interaction

npm ci
npm run build

php artisan config:clear
php artisan route:clear
php artisan view:clear

php artisan migrate --force --seed

php artisan config:cache
php artisan route:cache
php artisan view:cache
