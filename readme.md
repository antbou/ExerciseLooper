# ExerciseLopper

Perform for WAW1.1

## Requirements

| Tools                                         | Version |
| --------------------------------------------- | ------- |
| [Composer](https://getcomposer.org/download/) | 2.1.6   |
| [Sass](https://sass-lang.com/install)         | 1.43    |
| [NPM](https://www.npmjs.com/)                 | 7.20    |
| [Docker](https://www.docker.com/get-started)  | 20.10   |

| Images (Docker)                                | 
| ---------------------------------------------  | 
| [php:8.0-apache](https://hub.docker.com/_/php) | 
| [mysql](https://hub.docker.com/_/mysql)        | 


## Install

```bash
git clone https://github.com/antbou/ExerciseLooper.git
composer i
npm i
```

## Usage

The different local variables are found in the `.env.php` file which must be located at the root of the project.
An example file is available at the root of the project under .env-example.php.

### Database configuration
```
<?php

define("DBHOST", "TO_CHANGE:3306"); # The IP address to indicate must correspond to the IP address of the MYSQL container
define("DBNAME", "TO_CHANGE");
define("DBUSERNAME", "TO_CHANGE");
define("DBPASSWORD", "TO_CHANGE");
define('CHARSET', 'utf8');
define('APP_ENV', 'dev'); # choice between dev and prod
```

### docker :

We used docker to facilitate the installation and development of the project. This way we can abstract the host on which the project is developed.

Local docker configuration file for MYSQL.
An example file is available in docker/db-exemple.env

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

Start the containers (once the image are created)

```
docker-compose start
```

Stop the containers

```
docker-compose stop
```

## Generate Asset

The script will run sass command to generate style.css in public/resources/style/

```bash
composer asset
```

## Load database

The script will load the following sql file `database/looper.sql` through the docker container.

```bash
composer loadData
```

## Test

The script will automatically reload the database with fake data before running the tests through the docker container.

```bash
composer test
```
