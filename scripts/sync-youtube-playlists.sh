#!/usr/bin/env bash
#
# sync-youtube-playlists.sh
#
# Descarga los últimos videos de las playlists de YouTube de cada cátedra
# de Vinculación y los guarda como JSON, para que WordPress los lea del
# lado del servidor (sin depender de ninguna imagen Docker de terceros).
#
# Reemplaza al microservicio codigopozol.com/playlist-youtube usado antes
# en Joomla — misma API oficial de YouTube (YouTube Data API v3), sin caja
# negra de por medio.
#
# Uso: bash sync-youtube-playlists.sh
# Requiere: curl, y un archivo .env-youtube en el mismo directorio (o
# pasado por variable de entorno YOUTUBE_ENV_FILE) con la línea:
#   DEVELOPER_KEY=tu-api-key-aqui

set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
ENV_FILE="${YOUTUBE_ENV_FILE:-$SCRIPT_DIR/.env-youtube}"
OUT_DIR="${YOUTUBE_OUT_DIR:-$SCRIPT_DIR/youtube-cache}"

if [ ! -f "$ENV_FILE" ]; then
  echo "ERROR: no se encontró $ENV_FILE (debe contener DEVELOPER_KEY=...)" >&2
  exit 1
fi

# shellcheck disable=SC1090
source "$ENV_FILE"

if [ -z "${DEVELOPER_KEY:-}" ]; then
  echo "ERROR: DEVELOPER_KEY no está definida en $ENV_FILE" >&2
  exit 1
fi

mkdir -p "$OUT_DIR"

# prefix (mismo que usa cesmeca_render_gallery_tabs) => playlist ID de YouTube
declare -A PLAYLISTS=(
  [merc]="PLUHF2q-bWzXlb_XTXJ3fOWb5QFmhcjfoM"   # Cátedra Mercedes Olivera
  [lacem]="PLUHF2q-bWzXmoAOUSbworIlyDeRpMd6Fv"  # LACEM
  [semhist]="PLUHF2q-bWzXlZgQ8WaBUwP8ncPcRnStoJ" # Seminario Historia de Chiapas
  [laud]="PLUHF2q-bWzXl2vPOKfHcDnBLOTRFHhgGG"   # LAUD
  [marti]="PLUHF2q-bWzXkRW1hy5lKU8vIAeYIEeIei"  # Cátedra José Martí
)

FAILED=0

for prefix in "${!PLAYLISTS[@]}"; do
  pid="${PLAYLISTS[$prefix]}"
  out_file="$OUT_DIR/${prefix}.json"
  tmp_file="$OUT_DIR/.${prefix}.json.tmp"

  echo "Sincronizando '$prefix' (playlist $pid)..."

  http_code=$(curl -s -o "$tmp_file" -w "%{http_code}" \
    "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=50&playlistId=${pid}&key=${DEVELOPER_KEY}")

  if [ "$http_code" != "200" ]; then
    echo "  ERROR: la API respondió $http_code para '$prefix' — se conserva el JSON anterior" >&2
    rm -f "$tmp_file"
    FAILED=1
    continue
  fi

  # Validación mínima: que sea JSON parseable y tenga la forma esperada
  if ! grep -q '"kind": "youtube#playlistItemListResponse"' "$tmp_file"; then
    echo "  ERROR: respuesta inesperada para '$prefix' — se conserva el JSON anterior" >&2
    rm -f "$tmp_file"
    FAILED=1
    continue
  fi

  mv "$tmp_file" "$out_file"
  echo "  OK -> $out_file"
done

if [ "$FAILED" -ne 0 ]; then
  echo "Sincronización terminada CON ERRORES en al menos una playlist." >&2
  exit 1
fi

echo "Sincronización completa."
