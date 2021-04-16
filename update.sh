#!/bin/bash
composer update

sail top > /dev/null 2>&1

# Ensure that Docker is running...
if [ $? -ne 0 ]; then
    echo "Sail is not running. Starting..."
    ./vendor/bin/sail up -d
fi
./vendor/bin/sail artisan migrate:fresh --seed
./vendor/bin/sail artisan livewire:discover
./vendor/bin/sail artisan view:clear
./vendor/bin/sail artisan cache:clear
./vendor/bin/sail artisan vendor:publish --tag=filament-config
