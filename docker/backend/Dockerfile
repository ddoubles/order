FROM unit:1.32.1-php8.2@sha256:bc6ac9ffe15d7d84cf645902ae08cc689fd1edc3e85942ea2cbe001f9c634a5f

ARG user
ARG uid

# linux
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    unzip \
    wget \
    openssh-client \
    openssh-server \
    libaio1 \
    libldap2-dev \
    libzip-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libpq-dev \
    libssh2-1-dev \
    libssh2-1 \
    libicu-dev \
    libmagickwand-dev \
    && curl -fsSL https://deb.nodesource.com/setup_current.x | bash - && \
    apt-get install -y nodejs \
    && service ssh start \
    && npm install -g redis-dump  \
    terser \
    uglifycss \
    && ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

#PHP extentions
RUN docker-php-ext-install pdo\
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo_pgsql pdo_mysql pgsql ldap zip\
    && rm -rf /tmp/pear \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl

RUN git clone https://github.com/phpredis/phpredis.git \
    && cd phpredis \
    && phpize \
    && ./configure \
    && make  \
    && make install \
    && docker-php-ext-enable redis

RUN docker-php-ext-configure bcmath \
    && docker-php-ext-install bcmath  \
    && docker-php-ext-install opcache \
    && docker-php-ext-install bz2 \
    && docker-php-ext-configure pcntl --enable-pcntl \
    && docker-php-ext-install pcntl

# Create system user to run Composer and Artisan Commands
 RUN useradd -G unit,root -u $uid -d /home/$user $user \
    && mkdir -p /home/$user/.composer \
    && chown -R $user:$user /home/$user

COPY unit-config.json /docker-entrypoint.d/

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

WORKDIR /var/www/html
EXPOSE 9000