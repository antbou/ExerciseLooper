# Documentation technique du projet (xxx)

Cette documentation a pour but de fournir toutes les informations techniques nécessaires à un-e développeur-se qui rejoindrait l'équipe.  
Il se présente donc en bonne partie sous forme de questions: les questions que poserait un-e nouvel-le arrivant-e.

### A quoi sert le site ? A qui est-il destiné et dans quel but ?

### Dans quel contexte (technique) ce site est-il destiné à fonctionner ?

>_Hébergement, reseau, serveurs, clients, passerelles, ..._

### Quelles sont les données / informations que ce site manipule ?

#### MCD

![alt text](https://raw.githubusercontent.com/antbou/ExerciseLooper/develop/docs/models/MCD.png "MCD")

#### MLD
![alt text](https://raw.githubusercontent.com/antbou/ExerciseLooper/develop/docs/models/MLD.png "MLD")

#### Diagramme de classe
![alt text](https://raw.githubusercontent.com/antbou/ExerciseLooper/develop/docs/diagrams/models.png "Models")

### De quels composants le site est-il fait ? Comment interagissent-ils ?

Le site utilise une architecture MVC inspiré du frameworks [symfony](https://symfony.com/)

### Quelles technologies est-ce que je dois connaître pour pouvoir développer ce site ? 

- PHP
- SQL
- JAVASCRIPT
- HTML
- CSS
- DOCKER

### Qu'est-ce que je dois installer sur mon poste de travail pour pouvoir commencer à bosser sur ce site ?

- DOCKER
- COMPOSER
- NODEJS (NPM)
- SASS

Se référer un readme pour avoir plus de détails.

## Quelles astuces avez-vous employés ?

### Astuce #1:
La classe HTML "ajax" contenu dans les éléments HTML déclenche un event (click) Javascript (script js) au moment où l'utilisateur clique sur l'élément. 

L'event va déclencher une requête HTTP asynchrone qui sera définie en fonction des attributs de données suivantes :
- data-href : correspond au l'URL à laquel l'appelle AJAX doit avoir lieux
- data-method : correspond à la methode http associé

La réponse à la requête AJAX retourna une URI au format JSON que le script utilisera afin de rediriger l'utilisateur dessus.

### Astuce #2:
La classe PHP formvalidator permet de vérifier que le contenu des requêtes HTTP POST est bien valide.

Pour chaque champ d'un formulaire, il suffit d'appeler la methode addField en lui présisant un nom pour accéder à Field (first).
Ensuite, il faut préciser le nom de l'input, sont type de valeur attendu et précidier si le champs pour être vide.

```
form->addField(['first' => new Field('title', 'string', true)]);
```

Pour terminer, la method process est valide lorsque le formulaire a bien été envoyé et que les données ont bien été vérifié.

Il est donc possible de faire de faire ce type de condition au niveau du controller

```
if ($form->process() ) {
    appeler le model ...
}
```

### Astuce #3:

