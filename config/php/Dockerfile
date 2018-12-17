FROM php:fpm
MAINTAINER Your Name <your_email@domain.com>

ENV REFRESHED_AT 2017-01-17
ENV composer_hash 55d6ead61b29c7bdee5cccfb50076874187bd9f21f65d8991d46ec5cc90518f447387fb9f76ebae1fbbacf329e583e30

RUN apt-get update && apt-get install -y \
		git \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng12-dev && \
    docker-php-ext-install -j$(nproc) iconv mcrypt pdo_mysql mbstring && \
    docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ && \
    docker-php-ext-install -j$(nproc) gd && \
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php -r "if (hash_file('SHA384', 'composer-setup.php') === '${composer_hash}') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    php composer-setup.php --install-dir=/usr/bin --filename=composer && \
    php -r "unlink('composer-setup.php');"

# Xdebug
RUN pecl install xdebug-beta

COPY ./xdebug.ini /usr/local/etc/php/conf.d/

RUN usermod -u 1000 www-data

WORKDIR /var/www

CMD ["php-fpm"]
