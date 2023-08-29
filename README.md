<p align="center">
    <a href="https://laravel.com"><img alt="Laravel v10.x" src="https://img.shields.io/badge/Laravel-v10.x-FF2D20?style=for-the-badge&logo=laravel"></a>
    <a href="https://laravel-livewire.com"><img alt="Livewire v2.x" src="https://img.shields.io/badge/Livewire-v2.x-FB70A9?style=for-the-badge"></a>
    <a href="https://php.net"><img alt="PHP 8.2" src="https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php"></a>
</p>

## About Adm System

It is a Filament based web application (cms) for Laravel developers. After install you will have:
### Dashboard
- Posts
- Comments
- Pages (with custom fields)
- Categories
- Tags
- Menu
- Site settings
- Chunks
- Users
- Roles
- Permissions
- AdmForms

## How install on server or local environment
- copy project files
- composer install
- npm i
- npm run build
- run server and db on your environment
- create new db for project
- cp .env.example .env
- add db credentials to env file
- change APP_URL in env file to real website address (local on with domain)
- php artisan adm:start

## How install on hosting
- copy installed project with ALL files (vendor and node_modules too if exist)
- add db credentials to env file
- change APP_URL in env file to real website address (local on with domain)
- go to site using SSH
- cp .htaccess_example .htaccess
- php artisan adm:start

## Demo data
#### add demo data
- php artisan adm:demo
#### remove demo data
- php artisan adm:demo-remove

## Problem solving
### storage images 404
- cd storage/app/public/
- chmod 775 images
- chmod 775 logo
- php artisan storage:link 
### 500 щк 404 error after install (without any logs)
- cd public
- cp .htaccess_example .htaccess

## Got to Admin panel
- go to {your-website}/admin

login: admin@admin.com
password: password

## Recaptcha V3 settings 
### add credentials in .env
- RECAPTCHA_SITE_KEY=
- RECAPTCHA_SECRET_KEY=
