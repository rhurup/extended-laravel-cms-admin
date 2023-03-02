#!/bin/bash

ROOTDIR=/data/rest/www
cd $ROOTDIR
# Link shared folder to data with: ln -s /data/x_shared_files /data/rest/www/storage/files/shared

# Make sure we keep Laravel and data intact
php artisan down

# Update from Git
git fetch ; exit_git=$?
git reset --hard origin/main

# Run those files(!)
php artisan migrate --force ; exit_migrate=$?

# Clear cached facades, views, configs, events & listeners
php artisan view:clear
php artisan cache:clear
php artisan route:clear
php artisan config:clear
php artisan event:clear
php artisan clear-compiled
php artisan auth:clear-resets
php artisan schedule:clear-cache
rm -R $ROOTDIR/storage/cache/*
php artisan telescope:prune --hours=0

# Optimize config & routes - https://laravel.com/docs/5.8/deployment#optimizing-configuration-loading & https://laravel.com/docs/5.8/deployment#optimizing-route-loading
php artisan optimize

# Enable Laravel again
php artisan up ; exit_artisan=$?

# Update composer and dependencies after artisan is up to keep downtime minimal
COMPOSER_MEMORY_LIMIT=-1 composer update ; exit_composer=$?

# Stuff is cached already - clear the necessary ones
composer dump-autoload -o
php artisan config:clear

# Publish all assets (but publish telescope & horizon separately as they need to override assets using the --force)
php artisan vendor:publish --all ; exit_publish1=$?
php artisan telescope:publish ; exit_publish2=$?
php artisan horizon:publish ; exit_publish3=$?

# Finally remove the cached bootstrap files & generate them again (aka optimize)
php artisan optimize

if (( $exit_git != 0 || $exit_composer != 0 || $exit_migrate != 0 || $exit_publish1 != 0 || $exit_publish2 != 0 || $exit_publish3 != 0 || $exit_artisan != 0 || $exit_supervisor != 0 )); then
    echo "Failure(s) found in exitcode(s)";
    exit 1;
fi
