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