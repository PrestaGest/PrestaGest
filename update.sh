#!/bin/bash
composer update

sail top > /dev/null 2>&1

# Ensure that Docker is running...
if [ $? -ne 0 ]; then
    ./vendor/bin/sail up -d
fi
./vendor/bin/sail artisan view:clear
./vendor/bin/sail artisan cache:clear
./vendor/bin/sail artisan migrate:fresh
./vendor/bin/sail artisan orchid:admin admin admin@admin.com password
./vendor/bin/sail artisan prestashop:update-all
