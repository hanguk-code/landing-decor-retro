# DecorRetro

> A DecorRetro backend-frontend project.

## Features

- Nuxt ^2.8
- Laravel ^7
- SPA or SSR

## Installation

- `composer install`
- Edit `.env` to set your database connection details and
  - `CLIENT_URL` (local domain, ex: http://192.168.0.107:8000)
  - `APP_URL` (local domain for api, ex: http://192.168.0.107:8000/api)
  - `API_URL` (local domain for api, ex: http://192.168.0.107:8000/api)
  - `API_WEB_URL` (local domain, ex: http://192.168.0.107:8000)
  - `EMAIL_ORDER` (client email, ex:email_to_order@mail.com)
  - `EMAIL_FROM` (email from, ex:order@decor-retro.ru)

- (When installed via git clone or download, run `php artisan passport:install`)
- `php artisan migrate` or connect to main database
- `npm install`
  
- commands for start site on local:
    - `npm run dev` (command for nuxt)
    - `php artisan serve --host=192.168.0.107 --port=8000` (command for Laravel)

