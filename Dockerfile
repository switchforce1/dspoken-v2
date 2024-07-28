FROM dunglas/frankenphp as php

COPY . /app

RUN install-php-extensions \
 pdo_mysql \
 pdo_pgsql \
 gd \
 intl \
 zip \
 opcache

 RUN set -eux; \
	install-php-extensions \
		@composer