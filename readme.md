# ExerciseLopper

Perform for WAW1.1

## Local project configuration

### List of tools to install :

| Tools                                         | Version |
| --------------------------------------------- | ------- |
| [Composer](https://getcomposer.org/download/) | 2.1.6   |
| [Php](https://www.php.net/downloads.php)      | 8.0.9   |
| [Sass](https://sass-lang.com/install)         | 1.43    |
| [NPM](https://www.npmjs.com/)                 | 7.20    |

## Install

```bash
git clone https://github.com/antbou/ExerciseLooper.git
composer install
npm i
```

## Usage

The different local variables are found in the `.env.php` file which must be located at the root of the project.
The sample file is named `.env-exemple.php`

### docker :

Local docker configuration file for MYSQL

```
# docker/db.env
MYSQL_ROOT_PASSWORD=TO_CHANGE
MYSQL_DATABASE=TO_CHANGE
MYSQL_USER=TO_CHANGE
MYSQL_PASSWORD=TO_CHANGE
```

```
# To be done at the first launch :
docker-compose up
```

Start the containers (once the images are created)

```
docker-compose start
```

Stop the containers

```
docker-compose stop
```

### Local file configuration

The local configuration file `.env.php` must be created at the root of the project and must contain the following information:

```sh
# To get the IP of MYSQL container
docker inspect -f '{{range.NetworkSettings.Networks}}{{.IPAddress}}{{end}}' db-ExerciseLooper)
```

```
<?php

define("DBHOST", "TO_CHANGE:3306"); # The IP address to indicate must correspond to the IP address of the MYSQL container
define("DBNAME", "TO_CHANGE");
define("DBUSERNAME", "TO_CHANGE");
define("DBPASSWORD", "TO_CHANGE");
define('CHARSET', 'utf8');
define('APP_ENV', 'dev'); # choice between dev and prod
```

## Generate Asset

The script will run sass command

```bash
composer asset
```

## Load database

The script will load the following sql file `database/looper.sql` through the docker container

```bash
composer loadData
```

## Test

The script will automatically reload the database with fake data before running the tests through the docker container

```bash
composer test
```
