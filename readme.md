# ExerciseLopper
Il s'agit d'un site web de gestion d'exercice développé en PHP vanilla correspondant au projet MAW1.1
## Configuration du projet en local
### Liste des outils à installer :
- composer (https://getcomposer.org/)
- docker (https://www.docker.com/products/docker-desktop)

### Configuration des outils

#### composer : 

```
# Installer les dépendances 
composer i
# Gener l'autoload
composer dump-autoload
```
#### docker : 

Un fichier de configuration local docker pour MYSQL
```
# docker/db.env
MYSQL_ROOT_PASSWORD=TO_CHANGE
MYSQL_DATABASE=TO_CHANGE
MYSQL_USER=TO_CHANGE
MYSQL_PASSWORD=TO_CHANGE
```

```
# A effectuer au premier lancement de l'application afain de créer les images :
docker-compose up
```

```
# Démarrer les containers (une fois les images créées)
docker-compose start
# Arreter les containers
docker-compose stop
```

### Configuration fichier local
Le fichier de configuration local ```.env.php``` doit être créer à la racine du projet  et doit contenir les informations suivantes :
```
# Attention, l'adresse IP à indiquer doit correspondre à l'adresse IP du conteneur MYSQL
define("DBHOST", "TO_CHANGE"); 
define("DBNAME", "TO_CHANGE");
define("DBUSERNAME", "TO_CHANGE");
define("DBPASSWORD", "TO_CHANGE");
```
