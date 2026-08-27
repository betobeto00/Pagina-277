FROM wordpress:6.6-php8.3-apache

# Install required tools
RUN apt-get update && apt-get install -y --no-install-recommends \
        default-mysql-client \
        unzip \
    && rm -rf /var/lib/apt/lists/*

# Copy theme
COPY --chown=www-data:www-data wp-theme/ /var/www/html/wp-content/themes/virtud-y-victoria/

# Copy DB init script
COPY .devcontainer/init.sql /docker-entrypoint-initdb.d/init.sql

# PHP config
RUN { \
        echo 'upload_max_filesize = 64M'; \
        echo 'post_max_size = 64M'; \
        echo 'max_execution_time = 300'; \
        echo 'memory_limit = 256M'; \
    } > /usr/local/etc/php/conf.d/uploads.ini

# Apache mods
RUN a2enmod rewrite headers

# Permissions
RUN chown -R www-data:www-data /var/www/html

# Entrypoint script
COPY .devcontainer/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["entrypoint.sh"]
CMD ["apache2-foreground"]