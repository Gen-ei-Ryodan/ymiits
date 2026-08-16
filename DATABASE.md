# Database

The schema is defined by migrations in `database/migrations/`.

## Main Content Areas

- Users and password/authentication support.
- Home banners and home statistics.
- News and news sources.
- Galleries.
- Foundation profiles, founders, board members, and managers.
- Donors and beneficiaries.
- Testimonials.
- Religious, social, education, humanitarian, and waqf programs with sub-programs.

Run migrations only after confirming the production backup and database credentials. `deploy.sh` keeps migrations opt-in through `RUN_MIGRATIONS=1`.
