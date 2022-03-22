# Portefeuille de Compétence

## Sommaire

* [Description du projet](#desc)
* [Configuration du projet](#config)
    * [Modification et Importation de fichier](#modif-import)
    * [Installation des library](#install)
    * [Lancement du Projet en local](#lancement)

<br><br>

## Description du projet <a class="anchor" id="desc"></a>
Ce projet consiste à présenter les différentes compétences devant être acquise par un étudiant en BTS SIO.

Après s'être connecté, on a :

Une navbar à gauche pour naviguer dans les différentes types de compétences et les blocs concernés : 

![image](https://user-images.githubusercontent.com/84462178/159585374-bd31b61d-3aec-41a7-8fb0-9c3aa5e87875.png)


Les différentes compétences se présentent sous forme de tableau : 

![image](https://user-images.githubusercontent.com/84462178/159585098-c4158158-ce3a-44d0-a09d-49f8dbea2413.png)

Il est possible de voir ses informations de compte et de pouvoir modifier son mot de passe de connexion : 

![image](https://user-images.githubusercontent.com/84462178/159585519-9e95e19c-63a7-4843-8ef0-34de8379d50d.png)



<br>

## Configuration du projet <a class="anchor" id="config"></a>
### Modification et Importation de fichier <a class="anchor" id="modif-import"></a>

Renommez le fichier **.env.example** en **.env** et modifier ses informations.

Installez la Base de donnée avec **BDD-SIO2.sql** dans le dossier "MLD - MCD - SQL".


<br>

### Installation des library <a class="anchor" id="install"></a>

Lancez la commande : `php composer install`

Cela permettra d'installer toutes les library utilisées dans le projet :
- PHPMailer      (Pour la gestion d'envoi de mail)
- Dotenv         (Pour la récupération des valeurs du fichier **.env**)
- AltoRouter     (Pour la gestion du Router PHP)


<br>

### Lancement du Projet en local <a class="anchor" id="lancement"></a>
Utilisez la commande : `php -S localhost:8000`
