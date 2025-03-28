FROM php:8.2-apache

RUN apt update
RUN apt install vim -y

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

COPY scripts/working.php /working.php

CMD php -v | grep -i cli && php -i | grep -i 'Client API library version' && php /working.php