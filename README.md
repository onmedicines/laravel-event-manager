<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## TODO before using the app (local or production)

### Database

- Create a "database.sqlite" file inside the /database directory
- Run migrations
- Seed the database, because this app used some roles that need to be present in the database for authentication and authorization purposes

### Environment

Create a ".env" file, inside the project root and make sure the following:

- Copy the contents of the .env.example inside .env
- Generate an app key using "php artisan key:generate"
- Make sure to add the absolute path of the database.sqlite file inside a variable "DB\_DATABASE"
