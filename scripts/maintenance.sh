#!/bin/bash

# Maintenance mode toggle script
# Usage: ./scripts/maintenance.sh [up|down]

if [ -z "$1" ]; then
    echo "Usage: ./scripts/maintenance.sh [up|down]"
    echo "  up   - Enable maintenance mode"
    echo "  down - Disable maintenance mode"
    exit 1
fi

if [ "$1" = "up" ]; then
    echo "🔧 Enabling maintenance mode..."
    docker compose exec app php artisan down --render="errors::503" --retry=60
    echo "✅ Maintenance mode enabled"
    echo "ℹ️  Users will see a maintenance page"
elif [ "$1" = "down" ]; then
    echo "✨ Disabling maintenance mode..."
    docker compose exec app php artisan up
    echo "✅ Maintenance mode disabled"
    echo "ℹ️  Application is now accessible"
else
    echo "❌ Invalid argument: $1"
    echo "Usage: ./scripts/maintenance.sh [up|down]"
    exit 1
fi
