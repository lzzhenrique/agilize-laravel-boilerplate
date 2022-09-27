FROM amazonlinux:2

RUN yum -y update; \
    yum clean all; \
    amazon-linux-extras install epel php8.0; \
    yum install -y \
        wget \
        php \
        git \
        php-{pear,pecl,cgi,common,curl,mbstring,gd,gettext,bcmath,json,xml,fpm,intl,zip,pgsql,pdo,soap} \
        postgresql-devel \
        httpd \
        supervisor; \
    yum clean all; \
    yum autoremove; \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer;

ADD . /var/www
ADD .docker/entrypoint.local /usr/sbin/entrypoint.local
ADD .docker/update-application /usr/sbin/update-application
COPY .docker/etc /etc

RUN chmod -v +x /usr/sbin/entrypoint.local; \
    chmod -v +x /usr/sbin/update-application; \
#    mkdir /var/www/storage/proxies; \
    chmod 777 /var/www/bootstrap -Rf; \
    chmod 777 /var/www/storage -Rf; \
    chown apache.apache /var/www -Rf;

WORKDIR /var/www

CMD [ "/usr/sbin/entrypoint" ]
