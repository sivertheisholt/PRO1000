FROM ubuntu:latest

RUN apt-get update

RUN apt-get -y install apache2 && apt-get clean

COPY ports.conf /etc/apache2
COPY 000-default.conf /etc/apache2/sites-enabled

COPY . /var/www/

EXPOSE 8005
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]