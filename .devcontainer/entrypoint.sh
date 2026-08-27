#!/bin/bash
set -e

echo "[entrypoint] Iniciando WordPress en Codespaces..."

# Wait for MariaDB
echo "[entrypoint] Esperando a MariaDB..."
for i in {1..60}; do
    if mysqladmin ping -h"mariadb" -P"3306" -u"virtud_user" -p"virtud_pass" --silent 2>/dev/null; then
        echo "[entrypoint] MariaDB lista"
        break
    fi
    if [ $i -eq 60 ]; then
        echo "[entrypoint] ERROR: Timeout esperando MariaDB"
        exit 1
    fi
    sleep 2
done

# Check if tables exist
TABLE_COUNT=$(mysql -h"mariadb" -P"3306" -u"virtud_user" -p"virtud_pass" "virtud_y_victoria" -e "SHOW TABLES" 2>/dev/null | wc -l)

if [ "$TABLE_COUNT" -gt "1" ]; then
    echo "[entrypoint] Tablas existentes ($TABLE_COUNT), saltando import"
else
    echo "[entrypoint] Primera instalación, importando init.sql..."

    if [ -f /docker-entrypoint-initdb.d/init.sql ]; then
        # Replace local URL with Codespaces URL
        # Codespaces provides CODESPACE_NAME and GITHUB_CODESPACES_PORT_FORWARDING_DOMAIN
        if [ -n "$CODESPACE_NAME" ] && [ -n "$GITHUB_CODESPACES_PORT_FORWARDING_DOMAIN" ]; then
            SITE_URL="https://${CODESPACE_NAME}-80.${GITHUB_CODESPACES_PORT_FORWARDING_DOMAIN}"
        else
            SITE_URL="http://localhost"
        fi
        
        echo "[entrypoint] URL del sitio: $SITE_URL"
        
        sed "s|http://virtud-y-victoria-277.local|$SITE_URL|g" \
            /docker-entrypoint-initdb.d/init.sql > /tmp/init-transformed.sql

        echo "[entrypoint] Importando base de datos..."
        mysql -h"mariadb" -P"3306" -u"virtud_user" -p"virtud_pass" "virtud_y_victoria" < /tmp/init-transformed.sql
        echo "[entrypoint] Import completado"

        # Configure theme and URLs
        mysql -h"mariadb" -P"3306" -u"virtud_user" -p"virtud_pass" "virtud_y_victoria" <<EOF
UPDATE wp_options SET option_value = 'virtud-y-victoria' WHERE option_name = 'template' OR option_name = 'stylesheet';
UPDATE wp_options SET option_value = '$SITE_URL' WHERE option_name = 'siteurl' OR option_name = 'home';
EOF
        echo "[entrypoint] Tema y URLs configurados"
    else
        echo "[entrypoint] ADVERTENCIA: No se encontró init.sql"
    fi
fi

# Start Apache
echo "[entrypoint] Iniciando Apache..."
exec apache2-foreground