# API Reference

The application is primarily a server-rendered web application.

## Authentication API

- `GET /api/user` returns the authenticated Sanctum user.
- Authentication middleware: `auth:sanctum`.

## Web Routes

Public and admin route names are defined in `routes/web.php`. Admin resource routes are under `/admin`, require `auth` and `verified`, and use the `admin.` route-name prefix.
