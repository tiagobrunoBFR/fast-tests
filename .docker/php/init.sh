#!/usr/bin/env bash

if [ ! -d vendor ];

then
  composer install
fi

php artisan optimize
php artisan migrate

php-fpm
