FROM php:7.2.10-fpm

RUN apt-get update && apt-get install -y --no-install-recommends \
    libzip-dev \
    libxml2-dev \
    libz-dev \
    libpq-dev \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    libssl-dev \
    libmcrypt-dev \
    libjpeg62-turbo-dev \
    zlib1g-dev \
    libicu-dev \
    zip \
    git \
    unzip \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) iconv soap intl gd pdo pdo_pgsql zip
    
# Opcache enable
ARG INSTALL_OPCACHE=false
RUN if [ ${INSTALL_OPCACHE} = true ]; then \
    docker-php-ext-install opcache && \
    { \
    echo 'opcache.enable=1'; \
    echo 'opcache.memory_consumption=256'; \
    echo 'opcache.interned_strings_buffer=8'; \
    echo 'opcache.max_accelerated_files=4000'; \
    echo 'opcache.revalidate_freq=60'; \
    echo 'opcache.fast_shutdown=1'; \
    echo 'opcache.enable_cli=1'; \
    echo 'opcache.max_file_size=0'; \
    echo 'opcache.validate_timestamps=0'; \
    echo 'opcache.use_cwd=0'; \
    echo 'opcache.memory_limit=128M'; \
    } > /usr/local/etc/php/conf.d/opcache-recommended.ini \
    ;fi

COPY ./php.ini $PHP_INI_DIR


ARG INSTALL_XDEBUG=false;
RUN if [ ${INSTALL_XDEBUG} = true ]; then \
    pecl install xdebug && docker-php-ext-enable xdebug \
    ;fi

RUN rm -r /var/lib/apt/lists/*

ARG UID=1000
ARG GID

RUN usermod -u ${UID} www-data

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version
