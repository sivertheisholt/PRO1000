FROM ubuntu:latest

RUN apt-get update

RUN DEBIAN_FRONTEND=noninteractive apt-get -y install apache2 php-mysql libapache2-mod-php mysql-server

RUN apt-get clean

RUN a2dismod mpm_event
RUN a2enmod mpm_prefork 
RUN a2enmod php7.2

COPY ./docker-action/apache2.conf /etc/apache2
COPY ./docker-action/ports.conf /etc/apache2
COPY ./docker-action/000-default.conf /etc/apache2/sites-enabled

COPY . /var/www/html

EXPOSE 8005
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]