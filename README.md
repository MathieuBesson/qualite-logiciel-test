#  Qualité logiciel & tests
## Introduction

Ce projet a été créer dans le cadre de notre formation à MDS (MyDigitalSchool Rennes), plus particulièrement dans le cours de **Qualité logiciel & tests**.

## Objectifs 
### Objectif 1
L'objectif est de créer une pipeline d'intégration continue (CI/CD) à l'aide de :

- [Jenkins](https://www.jenkins.io/) permettant le lancement d'une série d'instructions visant au contrôle du code source livré par l'équipe de développement (automatisation des tests unitaire)
- [SonarQube](https://www.sonarqube.org/) logiciel de contrôle de qualité et de sécurité du code (Normes de style/codage)
- [Github](https://github.com) plateforme en ligne permettant l'hébergement et le versionning du code source produit


### Objectif 2
Lié au première objectif le deuxième est de créer un site web simple contenant : 

- Une page de connexion contenant
	-  des contrôles back et front sur le nombre de caractères ( >1 avec au moins un caractère spéciale, une majuscule et une minuscule)
	-  Le hashage du mot de passe se fait en Sha256
- Une page d'authentification réussite 
- Une page d'authentification non-réussite en cas d'échec de l'authentification  
- Les technologies utilisées sont les suivantes : 
	- [Nginx](https://www.nginx.com/) pour le serveur web 
	- [MariaDB](https://mariadb.com/fr/) pour le serveur de base de donnée 
	- Le langage ... pour la partie back-end
	- Le langage [Javascript](https://developer.mozilla.org/fr/docs/Web/JavaScript) pour les contrôles côté front-end 


L'objectif principal final étant qu'à chaque commit sur le dépôt Github d'un des membres de l'équipe de développement Jenkins déclenche le lancement des tests ainsi que le contrôle de qualité de code par SonarQube.

### Les contributeurs 

- [Mathieu Besson](https://github.com/MathieuBesson/) B3 Développement Web MDS
- [Malo Gerard](https://github.com/MaloGerardMDS) B3 Développement Web MDS
