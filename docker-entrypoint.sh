#!/bin/bash

# Wait for DB to be ready (optional)
sleep 5

# Run Laravel setup commands
php artisan config:clear
php artisan cache:clear
php artisan config:cache
php artisan migrate --force || true  # Avoid crashing container if DB is not ready

# Start Apache
apache2-foreground
