FROM php:8.2-apache

WORKDIR /var/www/html

COPY . /var/www/html/

RUN a2enmod rewrite

# Remove Apache MPM modules that may conflict
RUN a2dismod mpm_event mpm_worker mpm_event 2>/dev/null || true

RUN chown -R www-data:www-data /var/www/html

# Railway provides PORT when the container starts
CMD ["sh", "-c", "sed -i \"s/Listen 80/Listen ${PORT}/\" /etc/apache2/ports.conf && sed -i \"s/<VirtualHost \\*:80>/<VirtualHost *:${PORT}>/\" /etc/apache2/sites-available/000-default.conf && apache2-foreground"]
