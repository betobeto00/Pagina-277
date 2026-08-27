#!/bin/bash
set -e

# Esperar a que la DB de Render esté lista
echo "[init] Esperando a la base de datos..."
for i in {1..30}; do
    if mysqladmin ping -h"$WORDPRESS_DB_HOST" -u"$WORDPRESS_DB_USER" -p"$WORDPRESS_DB_PASSWORD" --silent 2>/dev/null; then
        echo "[init] DB lista"
        break
    fi
    sleep 2
done

# Verificar si ya hay tablas (deploy posterior, no primer boot)
TABLE_COUNT=$(mysql -h"$WORDPRESS_DB_HOST" -u"$WORDPRESS_DB_USER" -p"$WORDPRESS_DB_PASSWORD" "$WORDPRESS_DB_NAME" -e "SHOW TABLES" 2>/dev/null | wc -l)

if [ "$TABLE_COUNT" -gt "0" ]; then
    echo "[init] Tablas existentes ($TABLE_COUNT), saltando import"
    exit 0
fi

# Primer boot: importar dump
if [ -f /docker-entrypoint-initdb.d/init.sql ]; then
    echo "[init] Importando init.sql..."
    # Reemplazar URLs de http://virtud-y-victoria-277.local por la URL de Render
    sed "s|http://virtud-y-victoria-277.local|${WORDPRESS_SITE_URL:-https://virtud-y-victoria-277.onrender.com}|g" \
        /docker-entrypoint-initdb.d/init.sql > /tmp/init-transformed.sql
    mysql -h"$WORDPRESS_DB_HOST" -u"$WORDPRESS_DB_USER" -p"$WORDPRESS_DB_PASSWORD" "$WORDPRESS_DB_NAME" < /tmp/init-transformed.sql
    echo "[init] Import completado"

    # Asegurar que el tema activo es el nuestro
    mysql -h"$WORDPRESS_DB_HOST" -u"$WORDPRESS_DB_USER" -p"$WORDPRESS_DB_PASSWORD" "$WORDPRESS_DB_NAME" <<EOF
UPDATE wp_options SET option_value = 'virtud-y-victoria' WHERE option_name = 'template' OR option_name = 'stylesheet';
UPDATE wp_options SET option_value = 'http://${WORDPRESS_SITE_URL:-virtud-y-victoria-277.onrender.com}' WHERE option_name = 'siteurl' OR option_name = 'home';
EOF
    echo "[init] Tema y URLs configuradas"
fi

# Ejecutar el entrypoint original de WordPress
exec docker-entrypoint.sh apache2-foreground
