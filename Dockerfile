FROM php:8.2-cli

WORKDIR /var/www/html

COPY . /var/www/html/

RUN docker-php-ext-install pdo pdo_mysql

RUN chmod -R 755 /var/www/html

CMD ["sh", "-c", "php -S 0.0.0.0:${PORT} -t public"]
