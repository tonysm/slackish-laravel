FROM php:7.2-apache-stretch

COPY ./vendor /var/www/html/vendor
COPY . /var/www/html
COPY resources/docker/app/vhost.conf /etc/apache2/sites-available/000-default.conf
COPY resources/docker/app/start.sh /usr/local/bin/start

RUN docker-php-ext-install pdo pdo_mysql

RUN chown -R www-data:www-data /var/www/html \
    && chmod u+x /usr/local/bin/start \
    && a2enmod rewrite

CMD ["/usr/local/bin/start"]
