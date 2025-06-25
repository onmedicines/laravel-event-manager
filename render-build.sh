#!/usr/bin/env bash

# Install dependencies
composer install --no-dev --optimize-autoloader

# Create .env file
cp .env.example .env

# Generate app key
php artisan key:generate

# Run migrations (optional)
php artisan migrate --force
php artisan db:seed --force

# Set correct permissions
chmod -R 775 storage bootstrap/cache
