# Changelog

## 2026-08-16

- Normalized the legacy hosting export into a conventional Laravel root layout.
- Added a dedicated `public/` web root and deployment-safe front controller.
- Removed obfuscated legacy entry points, large local logs, archives, and unused hosting artifacts from the release tree.
- Added deployment automation and project documentation.
- Release source was synchronized to `~/repositories/ymiits`; domain activation remains gated on a production `.env`.
- Production `.env` created on the server (`~/repositories/ymiits/.env`); `ymiits.sql` imported into the `alurelab_ymiits` database (27 tables).
- `deploy.sh` hardened: creates `storage/framework/{cache,data,sessions,testing,views}` before artisan caching (fixes `view:cache` "View path not found"), and replaces `rsync` (unavailable on server) with `cp -a` + stale-file pruning.
- Front controller `public/index.php` basePath fix for the `~/repositories/ymiits` deployment layout.
- Hosting blocks symlinks pointing outside the docroot, so uploaded media is now served via `GET /storage/{path}` (`StorageFileController`) instead of the `public/storage` symlink; 141 production media files synchronized to `~/repositories/ymiits/storage/app/public`.
- Site is live: `https://ymiits.com` returns 200 on the home page, `/login`, and all storage URLs.
