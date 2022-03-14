FROM php:8.0-fpm

# Copy composer.lock and composer.json
COPY composer.lock composer.json /var/www/fleet/

# Set working directory
WORKDIR /var/www/fleet

# Install dependencies
RUN apt-get update \
    	&& apt-get install -y --no-install-recommends \
    		libmemcached-dev  \
    		libfreetype6-dev \
    		libxml2-dev \
    		libjpeg62-turbo-dev \
    		libpng-dev \
    		zlib1g-dev \
    		libzip-dev \
    		libz-dev \
    		libpq-dev  \
    		libsqlite3-dev  \
    		libicu-dev \
    		g++ \
    		git \
    		zip \
    		libmcrypt-dev \
    		libvpx-dev \
    		libjpeg-dev \
    		libpng-dev \
    		bzip2 \
    		wget \
    		libexpat1-dev \
    		libbz2-dev \
    		libgmp3-dev \
    		libldap2-dev \
    		unixodbc-dev \
    		libsnmp-dev \
    		libpcre3-dev \
    		libtidy-dev \
    		libaspell-dev \
    		tar \
    		less \
    		nano \
    		libcurl4-gnutls-dev \
    		apt-utils \
    		libxrender1 \
    		unzip \
    		libonig-dev \
    		libldap2-dev \
    		libxslt-dev \
    		libwebp-dev \
    		libc-client-dev \
    		libkrb5-dev \
    		libpspell-dev \
    		librabbitmq-dev \
    		librabbitmq4 \
    		ssh \
        && phpModules=" \
                    bcmath \
                    bz2 \
                    calendar \
                    exif \
                    gd \
                    gettext \
                    gmp \
                    imap \
                    intl \
                    ldap \
                    mysqli \
                    opcache \
                    pcntl \
                    pdo_mysql \
                    pdo_pgsql \
                    pgsql \
                    pspell \
                    shmop \
                    snmp \
                    soap \
                    sockets \
                    sysvmsg \
                    sysvsem \
                    sysvshm \
                    tidy \
                    xsl \
                    zip \
                " \
    	&& docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg --with-webp \
    	&& docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ \
    	&& docker-php-ext-configure imap --with-kerberos --with-imap-ssl \
    	&& docker-php-ext-install -j$(nproc) $phpModules \
    	&& pecl install memcached-3.1.5 \
    	&& pecl install redis-5.3.2 \
    	&& pecl install apcu-5.1.19 \
    	&& pecl install igbinary-3.1.6 \
    	&& docker-php-ext-enable memcached redis apcu igbinary \
    	&& apt-get clean \
    	&& rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Xdebug
RUN pecl install xdebug && docker-php-ext-enable xdebug \
&& echo "xdebug.mode=develop,debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
&& echo "xdebug.start_with_request=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
&& echo "xdebug.discover_client_host=0" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
&& echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini


# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
COPY . /var/www/fleet

# Copy existing application directory permissions
COPY --chown=www:www . /var/www/fleet

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
