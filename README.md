# YMIITS

Website and admin CMS for Yayasan Manarul Ilmi ITS, built with Laravel.

## Local Setup

1. Copy `.env.example` to `.env` and configure MySQL.
2. Run `composer install`.
3. Run `php artisan key:generate`.
4. Run `php artisan storage:link`.
5. Run `php artisan serve`.

## Verification

```bash
php artisan test
npm ci
npm run build
```

## Deployment

`deploy.sh` uses SSH alias `alurelab`, checks out the configured branch into `/home/alurelab/repositories/ymiits`, preserves server uploads, and synchronizes `public/` to `/home/alurelab/ymiits.com`.

Migrations are disabled by default. Enable them explicitly with `RUN_MIGRATIONS=1 ./deploy.sh` after a database backup.
