ARG LARAVEL_PATH=/var/www/html

FROM php:8-apache AS local

# Update and install dependences
ARG LARAVEL_PATH
COPY src $LARAVEL_PATH

RUN apt-get update && apt-get upgrade -y && apt-get install -y --no-install-recommends \
    build-essential \
    git \
    libpng-dev \
    libxml2-dev \
    libzip-dev \
    mariadb-client \
    unzip \
    zip

RUN docker-php-ext-install \
        gd \
        opcache \
        pdo_mysql \
        zip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Apache Config
ENV APACHE_DOCUMENT_ROOT=$LARAVEL_PATH/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN a2enmod rewrite

# Composer
RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

RUN chown -R www-data $LARAVEL_PATH/storage

WORKDIR $LARAVEL_PATH

EXPOSE 80