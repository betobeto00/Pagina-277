#!/bin/bash
set -e

echo "[init] Iniciando entrypoint personalizado..."

# Parsear DATABASE_URL (formato mysql://user:pass@host:port/dbname O postgresql://user:pass@host:port/dbname)
if [ -n "$DATABASE_URL" ]; then
    if [[ "$DATABASE_URL" =~ ^mysql://([^:]+):([^@]+)@([^:]+):([0-9]+)/(.+)$ ]]; then
        DB_USER="${BASH_REMATCH[1]}"
        DB_PASS="${BASH_REMATCH[2]}"
        DB_HOST="${BASH_REMATCH[3]}"
        DB_PORT="${BASH_REMATCH[4]}"
        DB_NAME="${BASH_REMATCH[5]}"
        echo "[init] Parseado MySQL DATABASE_URL -> host=$DB_HOST port=$DB_PORT db=$DB_NAME user=$DB_USER"
    elif [[ "$DATABASE_URL" =~ ^postgresql://([^:]+):([^@]+)@([^:]+):([0-9]+)/(.+)$ ]]; then
        echo "[init] ADVERTENCIA: DATABASE_URL es PostgreSQL, pero WordPress requiere MySQL/MariaDB"
        echo "[init] Ignorando DATABASE_URL y usando variables individuales..."
        DATABASE_URL=""
    else
        echo "[init] ADVERTENCIA: Formato DATABASE_URL no reconocido: ${DATABASE_URL:0:50}..."
        DATABASE_URL=""
    fi
fi

# Fallback a variables individuales (proporcionadas por Render para el servicio pserv/MariaDB)
DB_HOST=${DB_HOST:-$WORDPRESS_DB_HOST}
DB_PORT=${DB_PORT:-3306}
DB_NAME=${DB_NAME:-$WORDPRESS_DB_NAME}
DB_USER=${DB_USER:-$WORDPRESS_DB_USER}
DB_PASS=${DB_PASS:-$WORDPRESS_DB_PASSWORD}

# Si no tenemos host, intentar obtenerlo de la variable de servicio
if [ -z "$DB_HOST" ] && [ -n "$MYSQL_HOST" ]; then
    DB_HOST="$MYSQL_HOST"
fi

echo "[init] Configuración final: host=$DB_HOST port=$DB_PORT db=$DB_NAME user=$DB_USER"

echo "[init] Esperando a MariaDB en $DB_HOST:$DB_PORT..."
for i in {1..120}; do
    if mysqladmin ping -h"$DB_HOST" -P"$DB_PORT" -u"$DB_USER" -p"$DB_PASS" --silent 2>/dev/null; then
        echo "[init] MariaDB lista (tras $i intentos)"
        break
    fi
    if [ $i -eq 120 ]; then
        echo "[init] ERROR: Timeout (4 min) esperando MariaDB en $DB_HOST:$DB_PORT"
        echo "[init] Variables: DB_HOST=$DB_HOST DB_PORT=$DB_PORT DB_USER=$DB_USER"
        exit 1
    fi
    sleep 2
done

# Verificar si ya hay tablas (deploy posterior)
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

echo "[init] Iniciando WordPress..."
exec docker-entrypoint.sh apache2-foreground