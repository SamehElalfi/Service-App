FROM php:7.4-apache
RUN apt-get update -y && apt-get upgrade -y

# activate 'RewriteEngine' mode
RUN a2enmod rewrite
RUN service apache2 restart

# Install mysqli, mysql for PDO and zip
RUN docker-php-ext-install mysqli pdo_mysql exif pcntl bcmath
RUN apt-get -y install zip unzip 

# Install Git
RUN apt-get update && \
  apt-get upgrade -y && \
  apt-get install -y git

# Install Composer Globally
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer require icanboogie/inflector
RUN composer dump-autoload

EXPOSE 80
