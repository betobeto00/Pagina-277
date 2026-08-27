#!/bin/bash
set -e

echo "[init] Iniciando entrypoint personalizado..."

# Parsear DATABASE_URL si existe (formato: mysql://user:pass@host:port/dbname)
if [ -n "$DATABASE_URL" ]; then
    # mysql://user:pass@host:port/dbname
    DB_HOST=$(echo "$DATABASE_URL" | sed -n 's/.*@\([^:]*\):.*/\1/p')
    DB_PORT=$(echo "$DATABASE_URL" | sed -n 's/.*:\([0-9]*\)\/.*/\1/p')
    DB_NAME=$(echo "$DATABASE_URL" | sed -n 's/.*\/\([^?]*\).*/\1/p')
    DB_USER=$(echo "$DATABASE_URL" | sed -n 's/.*\/\/\([^:]*\):.*/\1/p')
    DB_PASS=$(echo "$DATABASE_URL" | sed -n 's/.*:\([^@]*\)@.*/\1/p')
    echo "[init] Parseado DATABASE_URL -> host=$DB_HOST port=$DB_PORT db=$DB_NAME user=$DB_USER"
fi

# Fallback a variables individuales
DB_HOST=${DB_HOST:-$WORDPRESS_DB_HOST}
DB_PORT=${DB_PORT:-3306}
DB_NAME=${DB_NAME:-$WORDPRESS_DB_NAME}
DB_USER=${DB_USER:-$WORDPRESS_DB_USER}
DB_PASS=${DB_PASS:-$WORDPRESS_DB_PASSWORD}

echo "[init] Esperando a MariaDB en $DB_HOST:$DB_PORT..."
for i in {1..60}; do
    if mysqladmin ping -h"$DB_HOST" -P"$DB_PORT" -u"$DB_USER" -p"$DB_PASS" --silent 2>/dev/null; then
        echo "[init] MariaDB lista"
        break
    fi
    if [ $i -eq 60 ]; then
        echo "[init] ERROR: Timeout esperando MariaDB"
        exit 1
    fi
    sleep 2
done

# Verificar si ya hay tablas
TABLE_COUNT=$(mysql -h"$DB_HOST" -P"$DB_PORT" -u"$DB_USER" -p"$DB_PASS" "$DB_NAME" -e "SHOW TABLES" 2>/dev/null | wc -l)

if [ "$TABLE_COUNT" -gt "1" ]; then
    echo "[init] Tablas existentes ($TABLE_COUNT), saltando import"
else
    echo "[init] Primera instalación, importando init.sql..."

    if [ -f /docker-entrypoint-initdb.d/init.sql ]; then
        SITE_URL="${WORDPRESS_SITE_URL:-https://virtud-y-victoria-277.onrender.com}"
        echo "[init] Reemplazando URLs en dump..."
        sed "s|http://virtud-y-victoria-277.local|$SITE_URL|g" \
            /docker-entrypoint-initdb.d/init.sql > /tmp/init-transformed.sql

        echo "[init] Ejecutando importación..."
        mysql -h"$DB_HOST" -P"$DB_PORT" -u"$DB_USER" -p"$DB_PASS" "$DB_NAME" < /tmp/init-transformed.sql
        echo "[init] Import completado"

        # Configurar tema y URLs
        mysql -h"$DB_HOST" -P"$DB_PORT" -u"$DB_USER" -p"$DB_PASS" "$DB_NAME" <<EOF
UPDATE wp_options SET option_value = 'virtud-y-victoria' WHERE option_name = 'template' OR option_name = 'stylesheet';
UPDATE wp_options SET option_value = '$SITE_URL' WHERE option_name = 'siteurl' OR option_name = 'home';
EOF
        echo "[init] Tema y URLs configurados"
    else
        echo "[init] ADVERTENCIA: No se encontró init.sql"
    fi
fi

# Ejecutar entrypoint original de WordPress
echo "[init] Iniciando WordPress..."
exec docker-entrypoint.sh apache2-foreground