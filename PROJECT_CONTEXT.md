# Project Context

YMIITS is the public website and content management system for Yayasan Manarul Ilmi ITS.

## Stack

- Laravel 9.52 application with Blade views and Breeze authentication.
- MySQL for application data.
- Vite and Tailwind CSS for frontend assets.
- Laravel public filesystem for uploaded media.

## Runtime Layout

- `app/`, `config/`, `database/`, `resources/`, and `routes/` contain the Laravel application.
- `public/` is the only web-facing directory.
- `storage/app/public/` contains uploaded media and is not committed to Git.
- `deploy.sh` deploys the repository to `alurelab` and synchronizes `public/` to `ymiits.com`.

## Operational Notes

Production secrets belong only in the server `.env`. Never commit `.env`, database credentials, logs, `vendor/`, or uploaded media.
