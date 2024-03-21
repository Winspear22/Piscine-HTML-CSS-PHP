# Piscine PHP - Mon parcours d'apprentissage

Durant la Piscine PHP, j'ai accompli plusieurs exercices pour aiguiser mes compétences en développement web. Voici un aperçu de mes réalisations :

## PHP-00 - Introduction à HTML et CSS
Lors de cette première journée, j'ai exploré les bases de HTML, CSS et de Javascript les langages fondamentaux pour la création de pages web dynamiques. J'ai également créé un script shell pour résoudre les URLs raccourcies via bit.ly.

### ex00 - Fonctionnement de bit.ly
J'ai écrit un script shell qui résout les URLs raccourcies via bit.ly pour révéler leur adresse de redirection finale. L'utilisation des commandes `curl`, `grep`, et `cut` a été essentielle pour compléter cet exercice avec succès.

![Résolution d'URL bit.ly](images/PHP-00-ex00.png)

### ex01 - Création d'un CV en HTML/CSS
J'ai conçu un CV en HTML et CSS, mettant en pratique la sémantique des balises HTML et la séparation du contenu et de la présentation.

### ex02 - Formulaire HTML avec Validation JavaScript
Cet exercice est consacré à la création d'un formulaire HTML avec une validation JavaScript pour collecter des informations de contact.

### ex03 - Reproduction Fidèle d'une Page Web
Cet exercice est consacré à la reproduction la plus exacte possible d'une page web à partir d'une capture d'écran et d'un fichier CSS donné, sans modifier le CSS.

![Reproduction d'une page web](images/PHP-00-ex03.png)

### ex04 - Intégration de Scripts JavaScript
L'objectif était de créer une page HTML qui intègre correctement quatre scripts JavaScript afin d'afficher une pop-up sans erreurs.

![pop-up javascript](images/PHP-00-ex04.png)

### ex05 - Conformité avec les Normes W3C
Pour cet exercice, j'ai modifié le code HTML d'une page web existante pour assurer sa conformité avec les normes W3C, ce qui signifie qu'il ne devait y avoir aucune erreur ni avertissement.

![Norme W3C respectée](images/PHP-00-ex05.png)

### ex00 - Résultat :

![Note finale](images/PHP-00-Success.png)

## PHP-01 - Introduction à PHP
Lors de cette seconde journée, j'ai fait pour la première fois du PHP. Le but de cette journée était de découvrir la création et la manipulation de variables, de strings et de tableaux en PHP. On y apprend également la manipulation de file descriptors.

### ex00 - Var
Dans cet exercice, il faut initialiser 4 variables de types différents et créer un programme qui nous permette d'afficher dynamiquement leur valeur ainsi que leur type. Voici mon résultat : 

![Affichage de mon résultat résultat](images/PHP-01-ex00.png)

Voici le résultat attendu :

![Affichage de mon résultat résultat](images/PHP-01-ex00-result.png)


## PHP-04 - La base de Symfony
### ex00  Première page. 
Voici la commande utilisee pour installer la version LTS (Long Term Support) de Symfony via composer

```composer create-project symfony/skeleton d04 "6.4.*"```

Ensuite j'ai installe ca :
```sudo apt-get install php-xml```
Puis : 
```composer require symfony/framework-bundle```
Il ne faut surtout pas oublier d'installer les paquets avec ```composer install``` si on vient de clone le projet.
Ensuite, j'ai cree mon premier controller dans : 
```PHP03/Day-04/ex00/d04/src/E00Bundle/Controller```
J'ai ensuite crée mon premier bundle dans ```src``` et je l'ai déclaré dans ```bundles.php```
Pour vérifier que tout fonctionne, il on peut très bien utiliser les fonction suivantes :

```php bin/console debug:container | grep PopoBundle``` Pour obtenir le nom du bundle qui vient d'être déclaré. Et :
```php bin/console debug:router``` pour obtenir les routes disponibles.

Pour obtenir le résultat des routs, on peut utiliser : 
```curl http://127.0.0.1:8000/annotation```

Pour autoriser les annotations, il faut aller dans le fichier ```framework.yaml``` et mettre annotations à true. Puis installer ce paquet : ```composer require doctrine/annotations```

### ex01  Pages multiples.

Il faut installer ```composer require symfony/twig-bundle``` pour pouvoir obtenir le dossier template et avoir les outils pour créer des pages multiples.

On modifie ensuite le contenu de PopoController pour pouvoir afficher plusieurs pages.


