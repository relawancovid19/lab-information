FROM ubuntu:latest

LABEL maintainer="Andi Siswanto <andisis92@gmail.com>"

ARG DEBIAN_FRONTEND=noninteractive
ARG WORKDIR=/var/www/html

RUN apt update && apt upgrade -y && apt install -y software-properties-common && \
    add-apt-repository ppa:ondrej/php && apt install -y nginx \
    php7.3-fpm \
    php7.3-mbstring \
    php7.3-gd \
    php7.3-xml \
    php7.3-mysql \
    php-xdebug \
    zip \
    unzip \
    nano \
    curl \
    git \
    make

# Copy nginx config
ADD ./docker/nginx-default.conf /etc/nginx/sites-available/default

# Copy project to workdir
ADD . ${WORKDIR}

# Set default working directory
WORKDIR ${WORKDIR}

RUN rm index.nginx-debian.html && \
    # Install composer
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer && \
    # Clone project
    git clone git@github.com:relawancovid19/lab-information.git && \
    # Change workdir permission
    chown -R www-data.www-data ${WORKDIR} && \
    chmod -R 755 ${WORKDIR} && \
    chmod -R 777 ${WORKDIR}/storage && \
    # Install library using composer
    composer install && \
    # Copy environments (Alternatively you can create static .env files for environments)
    cp ${WORKDIR}/.env.example ${WORKDIR}/.env && \
    # Generate application key
    php artisan key:generate

# Expose port 80
EXPOSE 80     

# Replace fpm sock with listening port 9000
CMD sed -i 's/\/run\/php\/php7.3-fpm.sock/127.0.0.1:9000/g' /etc/php/7.3/fpm/pool.d/www.conf && \
    # Start php7.3-FPM
    service php7.3-fpm start && \
    # Start Nginx
    nginx -g "daemon off;"