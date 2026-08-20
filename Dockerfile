FROM php:8.4-apache

# Arg to avoid interactive prompts
ARG DEBIAN_FRONTEND=noninteractive

# Env vars used in container
ENV COMPOSER_PLATFORM_PHP=8.4
ENV COMPOSER_MEMORY_LIMIT=-1

# 1. Install dependencies, NodeJs and Composer
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
    cron \
    acl \
    p7zip-full \
    ca-certificates \
    zip \
    unzip \
    mariadb-client \
    locales \
    apt-utils \
    git \
    openssh-client \
    libicu-dev \
    g++ \
    libpng-dev \
    libxml2-dev \
    libzip-dev \
    libonig-dev \
    libxslt-dev \
    libfreetype6-dev \
    vim-tiny \
    zlib1g-dev \
    libjpeg-dev \
    # Install NodeJs 22 for PHP 8.4
    && curl -sL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs \
    # Install Composer
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    # Cleanup to reduce layer size
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 2. Setting langs
RUN echo "en_US.UTF-8 UTF-8" > /etc/locale.gen \
    && echo "fr_FR.UTF-8 UTF-8" >> /etc/locale.gen \
    && locale-gen

# 3. Install and setup php ext
RUN docker-php-ext-configure intl \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install -j$(nproc) \
        pdo pdo_mysql mysqli opcache intl zip soap calendar dom mbstring gd xsl exif pcntl

# 4. Enable Apache modules
RUN a2enmod rewrite

# 5. Install xDebug
RUN pecl install xdebug

# 6. User configuration
RUN if id -u 1000 >/dev/null 2>&1; then \
        usermod -u 1001 www-data; \
        groupmod -g 1001 www-data; \
    fi; \
    usermod -u 1000 www-data; \
    groupmod -g 1000 www-data; \
    mkdir -p /home/www-data && chown -R 1000:1000 /home/www-data

# 7. PHP configuration
RUN echo "file_uploads = On" >> /usr/local/etc/php/conf.d/99-local-dev.ini && \
    echo "memory_limit = 1024M" >> /usr/local/etc/php/conf.d/99-local-dev.ini && \
    echo "upload_max_filesize = 128M" >> /usr/local/etc/php/conf.d/99-local-dev.ini && \
    echo "post_max_size = 128M" >> /usr/local/etc/php/conf.d/99-local-dev.ini && \
    echo "display_errors = On" >> /usr/local/etc/php/conf.d/99-local-dev.ini && \
    echo "display_startup_errors = On" >> /usr/local/etc/php/conf.d/99-local-dev.ini

# 8. Alias shell
RUN echo "alias ll='ls -alF'" >> /etc/bash.bashrc

# Application workdir
WORKDIR /var/www/html

# Expose port 80
EXPOSE 80
