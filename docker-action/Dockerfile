FROM centos:latest

MAINTAINER Group08

RUN yum -y install httpd

COPY . /var/www/

RUN ss -plnt sport eq :80
CMD ["/usr/sbin/httpd","-D","FOREGROUND"]

EXPOSE 80