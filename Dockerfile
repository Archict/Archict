FROM php:8.2-fpm-alpine

# Install php-fpm
RUN apk update && apk add nginx

# Optional, force UTC as server time
RUN echo "UTC" > /etc/timezone

# Copy files
COPY --chown=www-data:www-data . /var/www/archict
COPY nginx.conf /etc/nginx/http.d/default.conf
WORKDIR /var/www/archict
EXPOSE 80 443

VOLUME /var/www/archict/cache
VOLUME /var/log

COPY entrypoint.sh /etc/entrypoint.sh

ENTRYPOINT ["/etc/entrypoint.sh"]