# Coding Standards

- Follow Laravel conventions and PSR-12-compatible PHP.
- Keep controllers focused on HTTP coordination and use form requests for validation.
- Use Eloquent relationships and eager loading where related data is rendered in collections.
- Keep secrets in environment variables.
- Run `php artisan test` and `php artisan pint --test` before release when the local PHP version supports the installed Laravel release.
