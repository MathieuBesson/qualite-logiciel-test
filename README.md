# Qualité logiciel & tests

## Introduction

Ce projet a été créer dans le cadre de notre formation à MDS (MyDigitalSchool Rennes), plus particulièrement dans le cours de **Qualité logiciel & tests**.

## Objectifs

### Objectif 1 : Pipeline d'integration continue

L'objectif est de créer une pipeline d'intégration continue (CI/CD) à l'aide de :

-   [Jenkins](https://www.jenkins.io/) permettant le lancement d'une série d'instructions visant au contrôle du code source livré par l'équipe de développement (automatisation des tests unitaire)
-   [SonarQube](https://www.sonarqube.org/) logiciel de contrôle de qualité et de sécurité du code (Normes de style/codage)
-   [Github](https://github.com) plateforme en ligne permettant l'hébergement et le versionning du code source produit

### Objectif 2 : Création d'un mini site web (connexion) et des test associés

Lié au première objectif le deuxième est de créer un site web simple contenant :

-   Une page de connexion contenant
    -   des contrôles back et front sur le nombre de caractères ( >1 avec au moins un caractère spéciale, une majuscule et une minuscule)
    -   Le hashage du mot de passe se fait en Sha256
-   Une page d'authentification réussite
-   Une page d'authentification non-réussite en cas d'échec de l'authentification
-   Les technologies utilisées sont les suivantes :
    -   [Nginx](https://www.nginx.com/) pour le serveur web
    -   [MariaDB](https://mariadb.com/fr/) pour le serveur de base de donnée
    -   Le framework [Symfony](https://symfony.com/) pour la partie back-end
    -   Le langage [Javascript](https://developer.mozilla.org/fr/docs/Web/JavaScript) pour les contrôles côté front-end

L'objectif principal final étant qu'à chaque push sur le dépôt Github d'un des membres de l'équipe de développement Jenkins déclenche le lancement des tests ainsi que le contrôle de qualité de code par SonarQube.

### Procédure de mise en place de l'environnement de test

2 moyens sont possible pour cette mise en place :

#### 1 - L'installation de chaque logicielle en ligne de commande

Les fichiers de procédure sont à retrouver dans le dossier /procedures

-   **#1** Installation des logicielles utilisés php, git, composer, mariadb... -> installation/installations_mineurs
-   **#2** Procédure d'installation de Jenkins -> installation/jenkins_installation.md
-   **#3** Accèder à Jenkins sur une VM depuis une machine hôte -> configuration/jenkins_acces_depuis_VM
-   **#4** Configuration de Jenkins pour le lancement de test automatisés -> configuration/jenkins_configuration
-   **#5** Installation de SonarQube -> installation/sonarqube_installation
-   **#6** Configuration de SonarQube pour le lancement du scan du code -> configuration/sonarqube_configuration

#### 2 - L'utilisation d'un provider de VM ici [Vagrant](https://www.vagrantup.com) permettant le lancement de scripts d'installation automatique

-   **#1** Après l'[installation de Vagrant](https://www.vagrantup.com/downloads)

```shell
git clone "url_du_repository"
cd "url_du_repository"
vagrant up
```

-   **#2** Suivre la procédure d'accès à Jenkins sur une VM depuis une machine hôte -> jenkins_acces_depuis_VM
-   **#3** Configuration de Jenkins pour le lancement de test automatisés -> jenkins_configuration
-   **#4** Configuration de SonarQube pour le lancement du scan du code -> sonarqube_configuration

NB : 
- Il est possible de visualiser les images en ouvrant le dossier avec l'éditeur de Markdown [Obsidian](https://obsidian.md/) (avec le plugin comunautaire -> Ozan's Image in Editor Plugin)
- Le code source du projet de connexion est disponible ici : /donnee/sites/test-qualite/


### Les contributeurs

-   [Malo Gerard](https://github.com/MaloGerardMDS) B3 Développement Web MDS
-   [Mathieu Besson](https://github.com/MathieuBesson/) B3 Développement Web MDS
