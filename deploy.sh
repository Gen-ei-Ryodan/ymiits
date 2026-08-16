#!/usr/bin/env bash
set -Eeuo pipefail

REMOTE_HOST="${REMOTE_HOST:-alurelab}"
REMOTE_REPO="${REMOTE_REPO:-/home/alurelab/repositories/ymiits}"
REMOTE_DOMAIN="${REMOTE_DOMAIN:-/home/alurelab/ymiits.com}"
DEPLOY_BRANCH="${DEPLOY_BRANCH:-refactor/laravel-standard}"
RUN_MIGRATIONS="${RUN_MIGRATIONS:-0}"
RELEASE_ARCHIVE="/tmp/ymiits-release-$$.tar"

git archive --format=tar "$DEPLOY_BRANCH" | ssh "$REMOTE_HOST" "umask 077; cat > '$RELEASE_ARCHIVE'"

ssh "$REMOTE_HOST" "REMOTE_REPO='$REMOTE_REPO' REMOTE_DOMAIN='$REMOTE_DOMAIN' DEPLOY_BRANCH='$DEPLOY_BRANCH' RUN_MIGRATIONS='$RUN_MIGRATIONS' RELEASE_ARCHIVE='$RELEASE_ARCHIVE' bash -s" <<'REMOTE_SCRIPT'
set -Eeuo pipefail

mkdir -p "$REMOTE_REPO"
git -C "$REMOTE_REPO" init -q -b "$DEPLOY_BRANCH" 2>/dev/null || true
git -C "$REMOTE_REPO" clean -fdx -e .env -e storage/app/public -e storage/app/public/ 2>/dev/null || true
tar -xf "$RELEASE_ARCHIVE" -C "$REMOTE_REPO"
rm -f "$RELEASE_ARCHIVE"

if [ ! -f "$REMOTE_REPO/.env" ]; then
    printf '%s\n' "Missing $REMOTE_REPO/.env; deployment stopped without changing the domain." >&2
    exit 1
fi

if [ -d "$REMOTE_DOMAIN/storage" ] && [ ! -L "$REMOTE_DOMAIN/storage" ]; then
    mkdir -p "$REMOTE_REPO/storage/app/public"
    cp -a "$REMOTE_DOMAIN/storage/." "$REMOTE_REPO/storage/app/public/"
fi

cd "$REMOTE_REPO"
composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction
mkdir -p storage/framework/cache/data storage/framework/sessions storage/framework/testing storage/framework/views
php artisan storage:link || true
if [ "$RUN_MIGRATIONS" = "1" ]; then
    php artisan migrate --force
fi
php artisan config:cache
php artisan route:cache
php artisan view:cache

mkdir -p "$REMOTE_DOMAIN"
cp -a public/. "$REMOTE_DOMAIN/"
rm -f "$REMOTE_DOMAIN/storage"
ln -s "$REMOTE_REPO/storage/app/public" "$REMOTE_DOMAIN/storage"

for sub in build css images img; do
    if [ -d "$REMOTE_REPO/public/$sub" ] && [ -d "$REMOTE_DOMAIN/$sub" ]; then
        ( cd "$REMOTE_REPO/public/$sub" && find . -type f | sort ) > /tmp/ymiits-sync-src
        ( cd "$REMOTE_DOMAIN/$sub" && find . -type f | sort ) > /tmp/ymiits-sync-dst
        comm -23 /tmp/ymiits-sync-dst /tmp/ymiits-sync-src | while IFS= read -r f; do
            target="$REMOTE_DOMAIN/$sub/$f"
            rm -f -- "$target"
            d="$(dirname -- "$target")"
            while [ "$d" != "$REMOTE_DOMAIN/$sub" ] && [ "$d" != "/" ]; do
                rmdir "$d" 2>/dev/null || break
                d="$(dirname -- "$d")"
            done
        done
        rm -f /tmp/ymiits-sync-src /tmp/ymiits-sync-dst
    fi
done

for f in index.php robots.txt favicon.ico googlec0cc72f61677e79a.html; do
    [ -e "$REMOTE_REPO/public/$f" ] || rm -f -- "$REMOTE_DOMAIN/$f"
done
REMOTE_SCRIPT

printf 'Deployment completed for %s on %s\n' "$DEPLOY_BRANCH" "$REMOTE_HOST"
