FROM php:8.2-fpm-alpine

ARG UID
ARG GID

ENV UID=${UID}
ENV GID=${GID}

# Create user to fix PHPs write permissions
RUN addgroup -g ${GID} --system permissionToWrite
RUN adduser -G permissionToWrite --system -D -s /bin/sh -u ${UID} permissionToWrite

# Replace user and group PHP runs as
RUN sed -i "s/user = www-data/user = permissionToWrite/g" /usr/local/etc/php-fpm.d/www.conf
RUN sed -i "s/group = www-data/group = permissionToWrite/g" /usr/local/etc/php-fpm.d/www.conf

RUN apk add --update linux-headers \
    && apk add --no-cache $PHPIZE_DEPS composer \
    && pecl install -o xdebug ds \
    && docker-php-ext-enable xdebug ds

RUN #composer install