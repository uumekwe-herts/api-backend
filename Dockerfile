FROM php:8.0-apache
RUN docker-php-ext-install pdo pdo_mysql
RUN apt-get update && apt-get install sudo
RUN apt-get install -y sudo
RUN apt-get update
RUN sudo apt-get install -y mariadb-server
ADD configs/000-default.conf /etc/apache2/sites-available
CMD ["/bin/bash"]