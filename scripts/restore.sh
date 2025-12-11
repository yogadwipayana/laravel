#!/bin/bash

# Restore script for Laravel application
# Usage: ./scripts/restore.sh <backup_date>
# Example: ./scripts/restore.sh 20250115_120000

set -e

if [ -z "$1" ]; then
    echo "❌ Error: Backup date required!"
    echo "Usage: ./scripts/restore.sh <backup_date>"
    echo "Example: ./scripts/restore.sh 20250115_120000"
    echo ""
    echo "Available backups:"
    ls -1 backups/ | grep "db_backup_" | sed 's/db_backup_//g' | sed 's/.sql.gz//g'
    exit 1
fi

BACKUP_DATE=$1
BACKUP_DIR="backups"

# Load environment variables
export $(grep -v '^#' .env | xargs)

# Check if backup exists
if [ ! -f "${BACKUP_DIR}/db_backup_${BACKUP_DATE}.sql.gz" ]; then
    echo "❌ Error: Backup not found!"
    echo "Looking for: ${BACKUP_DIR}/db_backup_${BACKUP_DATE}.sql.gz"
    exit 1
fi

echo "⚠️  WARNING: This will restore database from backup: ${BACKUP_DATE}"
echo "This will OVERWRITE current database!"
read -p "Are you sure? (yes/no): " confirm

if [ "$confirm" != "yes" ]; then
    echo "❌ Restore cancelled"
    exit 1
fi

# Decompress backup
echo "📦 Decompressing backup..."
gunzip -k ${BACKUP_DIR}/db_backup_${BACKUP_DATE}.sql.gz

# Restore database
echo "🗄️  Restoring database..."
docker compose exec -T mysql mysql \
    -u ${DB_USERNAME} \
    -p${DB_PASSWORD} \
    ${DB_DATABASE} < ${BACKUP_DIR}/db_backup_${BACKUP_DATE}.sql

if [ $? -eq 0 ]; then
    echo "✅ Database restored successfully!"
    rm ${BACKUP_DIR}/db_backup_${BACKUP_DATE}.sql
else
    echo "❌ Database restore failed!"
    rm ${BACKUP_DIR}/db_backup_${BACKUP_DATE}.sql
    exit 1
fi

# Restore storage if exists
if [ -f "${BACKUP_DIR}/storage_backup_${BACKUP_DATE}.tar.gz" ]; then
    echo "📁 Restoring storage..."
    tar -xzf ${BACKUP_DIR}/storage_backup_${BACKUP_DATE}.tar.gz
    echo "✅ Storage restored successfully!"
fi

echo ""
echo "✅ Restore completed successfully!"
