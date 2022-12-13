FROM php:8.1-fpm

RUN docker-php-ext-install pdo pdo_mysql sockets

COPY crontab /etc/crontabs/root

CMD ["cron", "-f"]