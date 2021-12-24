## À propos du projet
Ce projet permet aux utilisateurs de créer des quiz, de répondre à des questions et de consulter les statistiques. Il existe 3 types de quiz : building, answering and closed.

Un quiz en status "building" est un quiz auquel on peut ajouter des questions et qui peut être supprimé. 

Un quiz en status "answering" peut être fermé et afficher des statistiques. C'est le seul état ou l'utilisateur peut répondre au question du quiz.

Enfin, un quiz en status "closed" peut être supprimé ou afficher des statistiques.

Il existe également 3 types de questions : texte à ligne unique, liste de lignes uniques et texte à lignes multiples. La seule différence entre eux est la taille des étiquettes des questions.

### Quelles sont les données / informations que ce site manipule ?

#### MCD
![MCD](/docs/models/MCD.png)

#### MLD
![MLD](/docs/models/MLD.png)

#### Diagramme de classes
![Models](/docs/diagrams/models.png)

### De quels composants le site est-il fait ? Comment interagissent-ils ?

Le site utilise une architecture MVC. 

Nous nous sommes inspiré du frameworks [symfony](https://symfony.com/) concernant l'architecture des dossiers.

Nous n'utilisons aucuns packages PHP mise à par phpunit afin d'effectuer les tests unitaires.

La liste des différentes dépendances utilisées côté frontend est disponible dans package.json :

- @fortawesome/fontawesome-free: 5.15.4
- milligram: 1.4.1

#### Structure du site
```
Exerciselooper
│   README.md
│   docker-compose.yml
│   ....
│
└───assets
│   └───scss
└───config
│   └───config.php
│   └───routeConfig.php
└───core
│   └───controllers
│   └───forms
│   └───router
│   └───services
│   └───traits
└───database
│   └───tests
│   └───loadData.php
│   └───looper.sql
└───docker
│   └───Dockerfile
│   └───db.env
│   └───looper.sql
└───docs
│   └───diagrams
│   └───models
│   └───specifications
│   │   └───documentation technique.md
│   │   └───ExerciseLooper-Features.md
└───public
│   └───js
│   │   └───script.js
│   └───style
│   │   └───style.css
│   └───.htaccess
│   └───index.php
└───src
│   └───controllers
│   └───models
└───templates
│   └───errors
│   └───exercise
│   └───...
└───tests
    └───models
```

Le dossier `assets` contient les fichiers non empaquetés par sass. Par défaut, le dossier dist est vide. Pour le remplir, il faut lancer sass.
Sass utilisera le point d'entrée suivante :
- main.scss

Le dossier `core` contient le squellette de l'application, c'est un peu la partie caché de l'iceberg. Aucune logique métiers ne se trouve dans se dossier.

Le dossier `database` contient tout ce qui touche à la base de données.
- un script Sql pour la production
- un script Sql pour générer les données de test

Le dossier `public` est le point d’entrée de l’application, chaque requête passe forcément par ce dossier et le fichier index.php.
C’est un dossier accessible par tous, il est généralement utilisé pour mettre à disposition des fichiers de ressources tel que les images.

Le dossier `src` est le cœur du projet. C’est le dossier qui contient la logique de l' application.
Les dossiers qui seront obligatoires à utiliser pour le fonctionnement de l’application sont :
- Controllers : Ce dossier contient les contrôleurs qui se chargent de rediriger vers les différents models.
- Models : Dans ce dossier nous allons définir la structure de votre base de donnée au travers de classes. Chaque Model représente généralement une table en Base de donnée.

Le dossier `templates` contient en d’autre terme nos views.

### Quelles technologies est-ce que je dois connaître pour pouvoir développer ce site ? 

- PHP
- SQL
- JAVASCRIPT
- HTML
- CSS / SCSS
- DOCKER

### Qu'est-ce que je dois installer sur mon poste de travail pour pouvoir commencer à bosser sur ce site ?

- DOCKER
- COMPOSER
- NODEJS (NPM)
- SASS

Se référer un readme pour avoir plus de détails.

## Quelles astuces avez-vous employés ?

### Astuce #1:
La classe HTML "Ajax" contenu dans les éléments HTML déclenche un event (click) Javascript (script js) afin d'effectuer une requête AJAX au serveur.

Par exemple, nous utilisons cette astuce sur le bouton "delete" pour la page "Exercise management".
```
<i class="fa fa-trash link ajax" ... data-href="/exercises/1/delete" ... data-method="delete"></i>
```

Lorsque l'utilisateur clique sur un élement HTML, l'event associé à la class ajaxt va effectuer une requête HTTP à l'application (controller).

L'élement HTML doit contenir les attributs de données suivantes :
- data-href : correspond au l'URL à laquel l'appelle AJAX doit avoir lieux
- data-method : correspond à la methode http associé

La réponse du controller retourna une URI au format JSON que le script utilisera afin de rediriger l'utilisateur dessus.

### Astuce #2:
La classe PHP formvalidator permet de vérifier que le contenu des requêtes HTTP POST est bien valide.

Pour chaque champ d'un formulaire, il suffit d'appeler la methode addField en lui présisant un nom pour accéder à Field (first).
Ensuite, il faut préciser le nom de l'input, sont type de valeur attendu et précidier si le champs pour être vide.

```
form->addField(['first' => new Field('title', 'string', true)]);
```

Pour terminer, la méthode process est valide lorsque le formulaire a bien été envoyé et que les données ont bien été vérifié.

Il est donc possible de faire de faire ce type de condition au niveau du controller

```
if ($form->process() ) {
    appeler le model ...
}
```

### Astuce #3:

La méthode csrfvalidator permet de vérifier si l'utilisateur est bien passé par le page du formulaire avant d'envoyer les données.

```
if ($this->csrfValidator() {
    appeler le model ...
}
```

Il suffit d'implémenter le token de la manière suivante pour le faire marcher.
```
<input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
```