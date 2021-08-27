#!/bin/sh

composer install --no-interaction
npm i
npm run prod
php artisan migrate:fresh
exec apache2-foreground