FROM andisis/nginx-php-fpm:latest

LABEL maintainer="Andi Siswanto <andisis92@gmail.com> | https://andisiswanto.com"

# Config server root
ENV SERVER_ROOT=/var/www/html/public

# Clone project and change workdir permission
RUN git clone git@github.com:relawancovid19/lab-information.git && \
    chown -R www-data.www-data /var/www/html && \
    chmod -R 755 /var/www/html && \
    chmod -R 777 /var/www/html/storage && \
    # Install library using composer
    composer install && \
    # Copy environments (Alternatively you can create static .env files for environments)
    cp /var/www/html/.env.example /var/www/html/.env && \
    # Generate application key
    php artisan key:generate