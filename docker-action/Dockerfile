FROM centos:latest

MAINTAINER Group08

RUN yum -y install httpd

COPY . /var/www/

CMD ["/usr/sbin/httpd","-D","FOREGROUND"]

EXPOSE 8005