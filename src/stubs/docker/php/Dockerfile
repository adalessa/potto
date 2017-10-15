ARG POTTO_PHP_VERSION

FROM php:${POTTO_PHP_VERSION}-cli

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


RUN useradd user

ARG POTTO_PUID
ENV POTTO_PUID ${POTTO_PUID}
RUN usermod -u ${POTTO_PUID} user

RUN mkdir -p /home/user
RUN chown -R user:user /home/user
USER user

WORKDIR /var/www/

ENTRYPOINT [ "php", "artisan" ]

