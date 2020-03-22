# LAB INFORMATION TRACKER

This is the repository for the lab information tracker app.

![CI](https://github.com/relawancovid19/lab-information/workflows/CI/badge.svg)

## Demo

Please visit [WEB UJI SWAB COVID-19](http://35.185.181.25)

```bash
# Staff Registrasi
username: registrasi
password: relawancovid19id

# Kepala Lab
username: kepala_lab
password: relawancovid19id

# Staff Lab
username: petugas_lab
password: relawancovid19id
```

## Prerequisites

**Install NGINX**

```bash
sudo apt install -y nginx
```

**Install PHP and required service**

```bash
sudo apt install -y php-fpm php-mbstring php-gd php-xml php-cli php-zip php-mysql unzip curl openssl pkg-config git autoconf automake libxml2-dev libcurl4-openssl-dev libssl-dev openssl gettext libicu-dev libmcrypt-dev libmcrypt4 libbz2-dev libreadline-dev gettext build-essential libmhash-dev libmhash2 libicu-dev libxslt-dev zlib1g-dev libzip-dev make
```

**Install PHPBrew**

Please check the [Official PHPBrew Documentation](https://github.com/phpbrew/phpbrew) for installation.

**Install PHP 7.3 on PHPBrew**

```bash
phpbrew install 7.3 +default +fpm +pdo +mysql
# See installed php version with phpbrew list
phpbrew switch php-7.3.x
```

**Install Composer**

```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'a5c698ffe4b8e849a443b120cd5ba38043260d5c4023dbf93e1558871f1f07f58274fc6f4c93bcfd858c6bd0775cd8d1') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
php -r "unlink('composer-setup.php');"
```

## Installation

Please check the official laravel installation guide for server requirements before you start. [Laravel Official Documentation](https://laravel.com/docs/7.x)

**Clone this repository**

```bash
git clone git@github.com:relawancovid19/lab-information.git
# Switch to the repository folder
cd lab-information
chmod +x artisan
git fetch origin develop:develop && git checkout develop

```

**Install Dependencies**

```bash
composer install
```

**Copy the `.env.example` file to `.env`**

```bash
cp .env.example .env
```

**Database Migration**

Create new database and setup the `.env` file

```bash
php artisan migrate
```

**Database Seeder**

```bash
composer dump-autoload

php artisan db:seed
```

## Install on Docker

**Prerequisites**

* Install Docker
* Clone this repository
* Create docker network `docker network create covid19id`
* Install mysql with docker and connect to network `covid19id`

**Create project image**

```bash
docker build -t covid19id_lab .
```

**Create project container**

```bash
docker run -d --name <container_name> -p <the_port_you_want>:80 covid19id_lab:latest
```

**Note** :

* Make sure mysql and project container are in 1 docker network, so they can communicate with each other

## Testing

**Run Testing**

```bash
# Check code metric
vendor/bin/phpmd app text phpmd_rulesets.xml
vendor/bin/phpmd tests text phpmd_rulesets.xml
# Check code standard
vendor/bin/phpcs app --standard=PSR2 -n
vendor/bin/phpcs tests --standard=PSR2 -n
# Unit testing
vendor/bin/phpunit --debug --stop-on-failure --stop-on-error
```

or you can run all of these commands with the `make` command

```bash
make test
```

## Directory Structure

We use Laravel 7, please visit [Laravel Directory Structure](https://laravel.com/docs/7.x/structure) for a description of the directory structure.

## Contributing

When contributing to this repository, please note we have a code standards, please follow it in all your interactions with the project.

#### Steps to contribute

1. Clone this repository.
2. Create your feature branch (`git checkout -b my-new-feature`)
3. Commit your changes (`git commit -am 'Add some feature'`)
4. Push to the branch (`git push origin my-new-feature`)
5. Submit pull request.

**Note** :
* Please make sure to update tests as appropriate.
* It's recommended to run **Testing** command before submit a pull request.

## Contributors

Thanks goes to these wonderful people:

* [Relawan COVID-19 Indonesia](https://relawancovid19.id)
* Septian Hari [@LIQRGV](https://github.com/LIQRGV)
* Andi Siswanto [@andisis](https://github.com/andisis)

## Deployment

Coming soon

## Reference

* [Admin LTE v3](https://adminlte.io/themes/v3/)
* [Install Docker on Ubuntu](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-on-ubuntu-18-04)
* [Laravel Documentation](https://laravel.com/docs/7.x)
* [PHP CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer)
* [PHPMD](https://github.com/phpmd/phpmd)