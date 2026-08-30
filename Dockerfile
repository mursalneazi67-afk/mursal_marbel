FROM php:8.2-apache

WORKDIR /var/www/html

COPY . /var/www/html/

RUN a2enmod rewrite

# Remove all existing Apache MPM modules
RUN rm -f /etc/apache2/mods-enabled/mpm_*.load \
    && rm -f /etc/apache2/mods-enabled/mpm_*.conf

# Enable only the prefork MPM
RUN a2enmod mpm_prefork

RUN chown -R www-data:www-data /var/www/html

# Railway supplies PORT when the container starts
CMD ["sh", "-c", "sed -i 's/Listen .*/Listen ${PORT}/' /etc/apache2/ports.conf && sed -i 's/<VirtualHost \\*:[0-9]*>/<VirtualHost *:${PORT}>/' /etc/apache2/sites-available/000-default.conf && apache2-foreground"]