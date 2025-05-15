FROM php:8.3-fpm

ENV TZ=Europe/Paris
ARG UID
ARG GID

RUN groupmod -g ${GID} www-data && usermod -u ${UID} www-data

# Configuration ssmtp pour mailhog
COPY ssmtp.conf /etc/ssmtp/ssmtp.conf

#PHP extensions
RUN apt update && apt install -y \
    git \
    libgmp-dev \
    libicu-dev \
    libpng-dev \
    libpq-dev \
    libxml2-dev \
    libxslt-dev \
    libzip-dev \
    mdbtools \
    ssmtp \
    wget \
    zip \
    zlib1g-dev

RUN docker-php-ext-install bcmath  \
    gd \
    gmp \
    intl \
    opcache \
    pdo \
    soap \
    xsl \
    zip \
    && pecl install apcu xdebug \
    && docker-php-ext-enable apcu xdebug \
    && docker-php-ext-configure zip

#Drivers postgresql
RUN docker-php-ext-configure pgsql --with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pgsql pdo_pgsql \
    && docker-php-ext-enable pgsql pdo_pgsql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt install -y nodejs && apt clean && rm -rf /var/lib/apt/lists/*

RUN chown -R www-data:www-data "/var/www/"

RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash && apt install symfony-cli

USER www-data
WORKDIR /var/www/cnamtech

RUN git config --global --add safe.directory /var/www/cnamtech

EXPOSE 9000
