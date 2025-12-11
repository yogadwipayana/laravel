#!/bin/bash

# Update script for Laravel application
# Usage: ./scripts/update.sh

set -e

echo "🔄 Starting application update..."

# Create backup before update
echo "📦 Creating backup before update..."
./scripts/backup.sh

# Pull latest changes
echo "📥 Pulling latest changes from git..."
git pull origin main

# Stop services
echo "⏹️  Stopping services..."
docker compose down

# Rebuild images
echo "🏗️  Rebuilding Docker images..."
docker compose build --no-cache

# Start services
echo "🚀 Starting services..."
docker compose up -d mysql

echo "⏳ Waiting for database..."
sleep 15

# Run migrations
echo "📊 Running database migrations..."
docker compose exec -T app php artisan migrate --force

# Install/update dependencies
echo "📦 Updating dependencies..."
docker compose exec -T app composer install --optimize-autoloader --no-dev

# Build assets
echo "🎨 Building assets..."
docker compose exec -T app npm ci
docker compose exec -T app npm run build

# Clear and optimize caches
echo "🧹 Clearing caches..."
docker compose exec -T app php artisan config:clear
docker compose exec -T app php artisan cache:clear
docker compose exec -T app php artisan route:clear
docker compose exec -T app php artisan view:clear

echo "⚡ Optimizing for production..."
docker compose exec -T app php artisan config:cache
docker compose exec -T app php artisan route:cache
docker compose exec -T app php artisan view:cache

# Start all services
echo "🚀 Starting all services..."
docker compose up -d

# Wait for services
echo "⏳ Waiting for services to be ready..."
sleep 10

# Show status
echo ""
echo "✅ Update completed successfully!"
echo ""
echo "📊 Service Status:"
docker compose ps
