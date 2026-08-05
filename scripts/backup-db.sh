#!/bin/bash
# Backup diario de la base de datos de wp-cesmeca
# Lee credenciales desde .env, guarda en backups/, rota lo de más de 14 dias

set -euo pipefail

PROJECT_DIR="/home/dockerdata/cesmeca-wordpress"
BACKUP_DIR="$PROJECT_DIR/backups"
DATE=$(date +%Y%m%d-%H%M%S)
FILENAME="db-cesmeca-$DATE.sql.gz"

# Cargar variables del .env
set -a
source "$PROJECT_DIR/.env"
set +a

mkdir -p "$BACKUP_DIR"

echo "[$(date)] Iniciando backup de base de datos..."

sudo docker exec cesmeca_mariadb mysqldump \
  -u"$DB_USER" \
  -p"$DB_PASSWORD" \
  "$DB_NAME" | gzip > "$BACKUP_DIR/$FILENAME"

if [ -s "$BACKUP_DIR/$FILENAME" ]; then
    echo "[$(date)] Backup completado: $FILENAME ($(du -h "$BACKUP_DIR/$FILENAME" | cut -f1))"
else
    echo "[$(date)] ERROR: el backup salio vacio, revisar credenciales/conexion"
    rm -f "$BACKUP_DIR/$FILENAME"
    exit 1
fi

# Rotacion: borrar backups de mas de 14 dias
find "$BACKUP_DIR" -name "db-cesmeca-*.sql.gz" -mtime +14 -delete
echo "[$(date)] Rotacion completada (backups >14 dias eliminados)"
