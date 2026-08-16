# Architecture

The project follows the conventional Laravel application layout.

## Layers

- Routes in `routes/web.php` expose public pages, authentication, and authenticated admin CRUD endpoints.
- Controllers in `app/Http/Controllers` coordinate requests and responses.
- Form requests in `app/Http/Requests` handle request validation.
- Eloquent models in `app/Models` represent the content domain.
- Blade templates in `resources/views` render public and admin pages.
- Uploaded files use the `public` filesystem disk and are exposed through `public/storage`.

The admin area is protected by `auth` and `verified` middleware. Public assets are served exclusively from `public/`.
