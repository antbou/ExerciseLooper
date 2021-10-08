# ExerciseLopper
Il s'agit d'un site web de gestion d'exercice développé en PHP vanilla correspondant au projet MAW1.1
## Configuration du projet en local
### Liste des outils à installer :
- composer (https://getcomposer.org/)
- docker (https://www.docker.com/products/docker-desktop)

### Configuration des outils
Dans un premier temps, il faut se rendre à la racine du répértoire du projet
#### composer : 
Pour installer les dépendances ```composer i```
#### docker : 

Un fichier de configuration local concernant les informations de base de donnée (MYSQL) doit d'être créer dans le dossier "docker"
Le fichier se nommera ```db.env``` et devra contenir les informations suivantes :
- MYSQL_ROOT_PASSWORD=TO_CHANGE
- MYSQL_DATABASE=TO_CHANGE
- MYSQL_USER=TO_CHANGE
- MYSQL_PASSWORD=TO_CHANGE

Lors du premier lancement de l'application, il faut créer les images avec la commande suivante :
```docker-compose build```

Par la suite, un simple start ou stop suffira pour lancer ou arréter les conteneurs
```docker-compose start```, ```docker-compose stop```

### Configuration fichier local
Le fichier de configuration local doit être créer à la racine du projet ```.env.php``` et doit contenir les informations suivantes :
- ```define("DBHOST", "TO_CHANGE");``` Attention, l'adresse IP à indiquer doit correspondre à l'adresse IP du conteneur MYSQL
- ```define("DBNAME", "TO_CHANGE");```
- ```define("DBUSERNAME", "TO_CHANGE");```
- ```define("DBPASSWORD", "TO_CHANGE");```
