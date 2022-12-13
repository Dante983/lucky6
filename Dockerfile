FROM php:8.1-fpm
ENV COMPOSER_ALLOW_SUPERUSER 1
RUN docker-php-ext-install pdo pdo_mysql sockets
#RUN #curl -sS https://getcomposer.org/installer | php -- \
#     --install-dir=/usr/local/bin --filename=composer

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
#MKDIR etc/crontabs/root/
COPY crontab etc/crontabs/root


RUN #apt-get update && apt-get install -y cron
#COPY example-crontab /etc/cron.d/example-crontab
#RUN chmod 0644 /etc/cron.d/example-crontab && \
#    crontab /etc/cron.d/example-crontab
WORKDIR /var/www/html
COPY . .
RUN composer install

