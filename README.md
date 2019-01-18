
# Find Your Home

JUPITER Nicolas, BRELAUD Pierre
## A Propos

Ce projet a été développé dans le cadre d'une semaine de travail sur le framework Symfony.
Sur cette semaine, 1 jour a été consacré à l'apprehension du framework ainsi que des révisions sur le PHP orienté objet, 3 jours pour la conception (UML) et le développemnt. Le dernier jour a lui été mis à profit pour le développent d'une application ionic utilisant une API REST pour se connecter à notre base de donnée. 


Ce projet consistait à création d'un site de réservation de logement entre particuliers


## Le projet

### Conception
Durant le premier jour, nous nous sommes occupé à deux de la conception de la base de donnée.

Voici la modélisation UML :

![alt text](https://raw.githubusercontent.com/PierreBrelaud/FindYourHome/master/uml.jpg)

### Outils

* Symfony 4
* Wamp Server
* Phpstorm
* Umlet (Conception UML)

### Prérequis
* Avoir une base de donnée mysql version 8 sous peine de bug

### Développement

#### Organisation
Pour le développement, nous nous sommes rapidement mis d'accord pour diviser les tâches en deux. 

 * Je me suis occupé de la partie front avec principalement l'affichage de tous les biens, la visualisation d'un bien, la page d'accueil
 
 * Nicolas c'est occupé de la partie admin et notamment de la gestion des utilisateurs, de la connection, et des formulaires
 
 #### Structure

Voici les éléments de la structure de Symfony que nous avons principalement utilisés : 

*  Config - 
    Nous permet notamment la gestion des routes via le fichier "routes.yaml"
    
* Public - Utilisé pour stocker nos fichier statiques (ex : images, feuilles de style css, javascript...)

* Src
  * Controller - Dossier où sont situés les controllers qui nous permettent d'afficher une vue avec des paramètres
  ```
    public function index() {
        return $this->render('back/home.html.twig', [
  
        ]);
    }
  ```
  * Entity - Dossier contenant les différents tables de la base de données sous forme d'entité, composé par exemple de getter et setter

  ```
    public function getId(): ?int {
        return $this->id;
    }

    public function getName(): ?string {
        return $this->name;
    }
  ```
  
  * Form - Contient les fichiers nous permettant de définir des formulaires réutilisables dans le controller qui le passera à la vue
  
  ```
   $builder->add('title', TextType::class, [
        'attr'      => ['class' => 'form-control'],
        'required'   => false
   ])
  ```
  * Migrations - Contient les différents fichiers de migration de la base de donénes
  * Repository - Les Repository permettent d'accéder aux contenu de la base de données, c'est ici que toutes nos requetes vers la BDD seront effectuées
  ```
    public function getAccomodationAverageMarks($accomodationId)
    {
        $qb = $this->createQueryBuilder('a');
        $qb->join('a.reviews', 'r');
        $qb->where('a.id = ' . $accomodationId);
        $qb->select($qb->expr()->avg('r.mark'));
        return $qb->getQuery()->getOneOrNullResult();
    }
  ```
* Templates - Dossier contenant toutes nos vues. Nous avons décidé de découpez ce dossier en 4 parties :
    *  Front - les pages visibles par tous les visiteurs
    * Back - les pages contenant la partie administration d'un utilisateur (création de logement, modification du profil...)
    * Registration - Création d'un compte
    * Security - Login
    *   Nous avons également créé des templates twig (ex: menu de navigation) qui sont réutilisables dans tous les fichiers grâce à un extend. 
  ```
    {% extends 'front/layout.html.twig' %}
  ```

    Pour les vues, symfony utilise des fichiers twig. Ces fichiers permettent d'avoir du contenu HTML mais également d'utiliser des variables (qui nous seront envoyées par le controller) et de les traiter.
    
  ```
    {% set difference = date("now").diff(date(review.date)) %}
    {% set leftDays = difference.days %}
    {% if leftDays == 0 %}
        Today,
    {% elseif leftDays == 1 %}
        1 day ago,
    {% else %}
        {{ leftDays }} days ago,
    {% endif %}
  ```
 
 ### Avancement
 
 ##### Front
 Pour le moment, la page d'accueil est présente avec la possibilité d'effectuer une recherche de logement (nm, ville, pays) + la liste des biens sous forme de card
 
 Le détail d'un bien est visible 
* Caratéristiques
* Description
* Equipements
* Images
* Avis (possibilité d'ajouter un avis si connecté)
* Propriétaire

Une page de recherche est créée avec le bien sous forme de card
 
  ##### Admin
  * Création de compte
  * Modification compte
  * Connection
  * Ajout d'un bien
  * Modification/Suppresion d'un avis
  
 
 ### Evolution
 
  ##### Front
  * Affichage des disponibilités (calendar)
  * Map
  
   ##### Back
 * Gestion des photos (upload)
 * Gestion des réservation
 * Gestion deds disponibilités
 * Gestion factures
 * Gestion favoris
 
 ##### Dernière mise à jour le 18/01/2019
 