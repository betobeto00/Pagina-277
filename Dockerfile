FROM wordpress:6.6-php8.3-apache

# Install required system tools for DB import
RUN apt-get update && apt-get install -y --no-install-recommends \
        default-mysql-client \
        unzip \
    && rm -rf /var/lib/apt/lists/*

# Copy our custom theme
COPY --chown=www-data:www-data wp-theme/ /var/www/html/wp-content/themes/virtud-y-victoria/

# Copy DB init script and custom entrypoint
COPY --chown=www-data:www-data init/ /docker-entrypoint-initdb.d/
COPY docker-entrypoint-custom.sh /usr/local/bin/docker-entrypoint-custom.sh
RUN chmod +x /usr/local/bin/docker-entrypoint-custom.sh

# Increase upload size and execution time
RUN { \
        echo 'upload_max_filesize = 64M'; \
        echo 'post_max_size = 64M'; \
        echo 'max_execution_time = 300'; \
        echo 'memory_limit = 256M'; \
    } > /usr/local/etc/php/conf.d/uploads.ini

# Allow .htaccess overrides and mod_rewrite
RUN a2enmod rewrite headers

# Ensure permissions
RUN chown -R www-data:www-data /var/www/html

# Use custom entrypoint that imports DB on first boot
ENTRYPOINT ["docker-entrypoint-custom.sh"]
CMD ["apache2-foreground"]
