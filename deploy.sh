#!/usr/bin/env bash
set -Eeuo pipefail

REMOTE_HOST="${REMOTE_HOST:-alurelab}"
REMOTE_REPO="${REMOTE_REPO:-/home/alurelab/repositories/ymiits}"
REMOTE_DOMAIN="${REMOTE_DOMAIN:-/home/alurelab/ymiits.com}"
DEPLOY_BRANCH="${DEPLOY_BRANCH:-refactor/laravel-standard}"
RUN_MIGRATIONS="${RUN_MIGRATIONS:-0}"

ssh "$REMOTE_HOST" "REMOTE_REPO='$REMOTE_REPO' REMOTE_DOMAIN='$REMOTE_DOMAIN' DEPLOY_BRANCH='$DEPLOY_BRANCH' RUN_MIGRATIONS='$RUN_MIGRATIONS' bash -s" <<'REMOTE_SCRIPT'
set -Eeuo pipefail

if [ ! -d "$REMOTE_REPO/.git" ]; then
    git clone --branch "$DEPLOY_BRANCH" https://github.com/Gen-ei-Ryodan/ymiits.git "$REMOTE_REPO"
else
    git -C "$REMOTE_REPO" fetch origin "$DEPLOY_BRANCH"
    git -C "$REMOTE_REPO" checkout "$DEPLOY_BRANCH"
    git -C "$REMOTE_REPO" reset --hard "origin/$DEPLOY_BRANCH"
fi

if [ ! -f "$REMOTE_REPO/.env" ]; then
    printf '%s\n' "Missing $REMOTE_REPO/.env; deployment stopped without changing the domain." >&2
    exit 1
fi

if [ -d "$REMOTE_DOMAIN/storage" ] && [ ! -L "$REMOTE_DOMAIN/storage" ]; then
    mkdir -p "$REMOTE_REPO/storage/app/public"
    rsync -a "$REMOTE_DOMAIN/storage/" "$REMOTE_REPO/storage/app/public/"
fi

cd "$REMOTE_REPO"
composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction
php artisan storage:link || true
if [ "$RUN_MIGRATIONS" = "1" ]; then
    php artisan migrate --force
fi
php artisan config:cache
php artisan route:cache
php artisan view:cache

mkdir -p "$REMOTE_DOMAIN"
rsync -a --delete --exclude='storage' --exclude='.well-known' public/ "$REMOTE_DOMAIN/"
rm -rf "$REMOTE_DOMAIN/storage"
ln -s "$REMOTE_REPO/storage/app/public" "$REMOTE_DOMAIN/storage"
REMOTE_SCRIPT

printf 'Deployment completed for %s on %s\n' "$DEPLOY_BRANCH" "$REMOTE_HOST"
