ARG POTTO_PHP_VERSION

FROM php:${POTTO_PHP_VERSION}-apache

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

ARG POTTO_PUID
ENV PUTTO_PUID ${POTTO_PUID}
RUN usermod -u ${POTTO_PUID} www-data

WORKDIR /var/www/
