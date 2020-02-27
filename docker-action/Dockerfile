FROM ubuntu:latest

RUN apt-get update

RUN apt-get -y install apache2 && apt-get clean
RUN a2dismod npm_event && sudo a2enmod mpm_prefork && sudo a2enmod php7.0

COPY apache2.conf /etc/apache2
COPY ports.conf /etc/apache2
COPY 000-default.conf /etc/apache2/sites-enabled

COPY . /var/www/html

EXPOSE 8005
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]