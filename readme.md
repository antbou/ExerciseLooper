# ExerciseLopper

Perform for WAW1.1

## Local project configuration

### List of tools to install :

- composer (https://getcomposer.org/)
- docker (https://www.docker.com/products/docker-desktop)

### Configuration of the tools

#### composer :

```
# Installing dependencies
composer i
# Generate autoload
composer dump-autoload
```

#### docker :

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

#### SASS

```sh
composer asset
```

### Local file configuration

The local configuration file `.env.php` must be created at the root of the project and must contain the following information:

```
<?php

define("DBHOST", "TO_CHANGE"); # The IP address to indicate must correspond to the IP address of the MYSQL container
define("DBNAME", "TO_CHANGE");
define("DBUSERNAME", "TO_CHANGE");
define("DBPASSWORD", "TO_CHANGE");
define('CHARSET', 'utf8');
define('APP_ENV', 'dev'); # choice between dev and prod
```
