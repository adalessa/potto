ARG PHP_VERSION=$PHP_VERSION
ARG USER_UID=$USER_UID

FROM php:${PHP_VERSION}-apache

RUN apt-get update && apt-get install -y \
	subversion \
	libmcrypt-dev \
	curl \
	git \
	zlib1g-dev \
	mysql-client \
	&& docker-php-ext-install mcrypt \
	&& docker-php-ext-install mbstring \
	&& docker-php-ext-install zip \
	&& docker-php-ext-install pcntl \
	&& docker-php-ext-install bcmath \
    && docker-php-ext-install pdo_mysql

RUN a2enmod rewrite
ADD site-default.conf /etc/apache2/sites-available
RUN a2dissite 000-default.conf
RUN a2ensite site-default.conf
RUN service apache2 restart

RUN usermod -u ${USER_UID} www-data

WORKDIR /var/www/
