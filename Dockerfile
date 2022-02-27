FROM php:8.0-apache
RUN docker-php-ext-install mysqli



#COPY . /usr/src/gossamer
#WORKDIR /usr/src/gossamer
#CMD ["php", "./index.php"]

