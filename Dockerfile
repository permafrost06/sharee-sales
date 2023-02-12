FROM php:8.2-apache
COPY . /var/www/html
RUN apt-get update && apt-get install -y \
		libfreetype6-dev \
		libjpeg62-turbo-dev \
		libpng-dev \
		zip \
		unzip \
		git \
	&& docker-php-ext-configure gd --with-freetype --with-jpeg \
	&& docker-php-ext-install pdo pdo_mysql \
	&& docker-php-ext-install -j$(nproc) gd


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install

RUN cp .env.docker .env