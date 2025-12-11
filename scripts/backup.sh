#!/bin/bash

# Backup script for Laravel application
# Usage: ./scripts/backup.sh

set -e

BACKUP_DIR="backups"
DATE=$(date +%Y%m%d_%H%M%S)
APP_NAME="laravel-app"

echo "📦 Starting backup process..."

# Create backup directory
mkdir -p $BACKUP_DIR

# Load environment variables
export $(grep -v '^#' .env | xargs)

# Backup database
echo "🗄️  Backing up database..."
docker compose exec -T mysql mysqldump \
    -u ${DB_USERNAME} \
    -p${DB_PASSWORD} \
    ${DB_DATABASE} > ${BACKUP_DIR}/db_backup_${DATE}.sql

if [ $? -eq 0 ]; then
    echo "✅ Database backup created: ${BACKUP_DIR}/db_backup_${DATE}.sql"
    gzip ${BACKUP_DIR}/db_backup_${DATE}.sql
    echo "✅ Database backup compressed: ${BACKUP_DIR}/db_backup_${DATE}.sql.gz"
else
    echo "❌ Database backup failed!"
    exit 1
fi

# Backup storage directory
echo "📁 Backing up storage..."
tar -czf ${BACKUP_DIR}/storage_backup_${DATE}.tar.gz storage/app
echo "✅ Storage backup created: ${BACKUP_DIR}/storage_backup_${DATE}.tar.gz"

# Backup .env file
echo "⚙️  Backing up .env..."
cp .env ${BACKUP_DIR}/env_backup_${DATE}
echo "✅ .env backup created: ${BACKUP_DIR}/env_backup_${DATE}"

# Remove old backups (keep last 7 days)
echo "🧹 Cleaning old backups..."
find ${BACKUP_DIR} -name "*.gz" -type f -mtime +7 -delete
find ${BACKUP_DIR} -name "env_backup_*" -type f -mtime +7 -delete

echo ""
echo "✅ Backup completed successfully!"
echo "📊 Backup location: ${BACKUP_DIR}/"
echo "📅 Backup date: ${DATE}"
