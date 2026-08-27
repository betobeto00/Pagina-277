#!/bin/bash
# Post-create setup for Codespaces

echo "[setup] Configurando entorno Codespaces..."

# Set git config
git config --global user.email "dev@codespaces.local"
git config --global user.name "Codespaces Dev"

# Ensure permissions
sudo chown -R www-data:www-data /var/www/html/wp-content/themes/virtud-y-victoria 2>/dev/null || true

# Install WP-CLI if not present
if ! command -v wp &> /dev/null; then
    echo "[setup] Instalando WP-CLI..."
    curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
    chmod +x wp-cli.phar
    sudo mv wp-cli.phar /usr/local/bin/wp
fi

# Verify WP install
cd /var/www/html
if wp core is-installed --allow-root 2>/dev/null; then
    echo "[setup] WordPress ya instalado"
    
    # Activate theme
    wp theme activate virtud-y-victoria --allow-root 2>/dev/null || true
    
    # Flush rewrite rules
    wp rewrite flush --hard --allow-root 2>/dev/null || true
    
    echo "[setup] Tema activado y rewrite rules actualizadas"
else
    echo "[setup] WordPress se instalará en el primer acceso"
fi

echo "[setup] Listo! Accede a la URL del puerto 80 para ver el sitio."