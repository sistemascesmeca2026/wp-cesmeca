#!/bin/bash
# Backup diario de wp-content/uploads/ de wp-cesmeca
# Guarda en backups/, rota lo de más de 14 días (mismo patrón que backup-db.sh)
set -euo pipefail
PROJECT_DIR="/home/dockerdata/cesmeca-wordpress"
BACKUP_DIR="$PROJECT_DIR/backups"
DATE=$(date +%Y%m%d-%H%M%S)
FILENAME="uploads-cesmeca-$DATE.tar.gz"

mkdir -p "$BACKUP_DIR"
echo "[$(date)] Iniciando backup de wp-content/uploads/..."

sudo docker exec cesmeca_wordpress tar -czf - -C /var/www/html/wp-content uploads > "$BACKUP_DIR/$FILENAME"

if [ -s "$BACKUP_DIR/$FILENAME" ]; then
    echo "[$(date)] Backup completado: $FILENAME ($(du -h "$BACKUP_DIR/$FILENAME" | cut -f1))"
else
    echo "[$(date)] ERROR: el backup salio vacio, revisar conexion al contenedor"
    rm -f "$BACKUP_DIR/$FILENAME"
    exit 1
fi

find "$BACKUP_DIR" -name "uploads-cesmeca-*.tar.gz" -mtime +14 -delete
echo "[$(date)] Rotacion completada (backups >14 dias eliminados)"
