#!/bin/bash

# View logs script
# Usage: ./scripts/logs.sh [service]

if [ -z "$1" ]; then
    echo "📋 Available services:"
    echo "  all     - All services"
    echo "  app     - Laravel application"
    echo "  nginx   - Nginx web server"
    echo "  mysql   - MySQL database"
    echo "  certbot - SSL certificate manager"
    echo ""
    echo "Usage: ./scripts/logs.sh [service]"
    echo "Example: ./scripts/logs.sh app"
    exit 1
fi

case "$1" in
    all)
        echo "📋 Viewing all logs (press Ctrl+C to exit)..."
        docker compose logs -f
        ;;
    app)
        echo "📋 Viewing Laravel application logs (press Ctrl+C to exit)..."
        docker compose logs -f app
        ;;
    nginx)
        echo "📋 Viewing Nginx logs (press Ctrl+C to exit)..."
        docker compose logs -f nginx
        ;;
    mysql)
        echo "📋 Viewing MySQL logs (press Ctrl+C to exit)..."
        docker compose logs -f mysql
        ;;
    certbot)
        echo "📋 Viewing Certbot logs (press Ctrl+C to exit)..."
        docker compose logs -f certbot
        ;;
    *)
        echo "❌ Unknown service: $1"
        echo "Available services: all, app, nginx, mysql, certbot"
        exit 1
        ;;
esac
