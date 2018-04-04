FROM php:7.2-apache

MAINTAINER lucasbozek@gmail.com

ENV PROJECTS_PATH /var/www/client

COPY ./docker/apache/default.conf /etc/apache2/sites-enabled/000-default.conf

RUN a2enmod rewrite

RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

RUN apt-get update && apt-get install -y \
    git \
    libicu-dev \
    libxml2-dev \
    nano \
    zlib1g-dev \
    curl

RUN docker-php-ext-install \
    bcmath \
    mbstring \
    zip

RUN mkdir -p $PROJECTS_PATH

WORKDIR $PROJECTS_PATH

#ssh
RUN apt-get install -y openssh-client