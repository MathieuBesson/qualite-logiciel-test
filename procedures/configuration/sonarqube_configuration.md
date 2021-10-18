<<<<<<< HEAD
# Installation de Sonarqube Scanner sur Jenkins
- Se connecter sur Sonarqube [192.168.88.188:9000](192.168.88.188:9000) avec le compte par défaut :

```shell
Login : admin
Password : admin
```
- Aller dans "My account", dans l'onglet Security, on génére un token et on le récupère.
- Aller dans administration -> Security -> Force user authentication (décocher) -> ne pas faire ça en prod 

- Retourner sur Jenkins, aller dans le menu "Manage Jenkins" puis dans "Manage plugins"

- Dans l'onglet "Available", rechercher "SonarQube Scanner For Jenkins" et installer le plugin

- Une fois installé, redémarrer Jenkins.
 

# Configurer Jenkins pour utiliser Sonarqube

- Administrer Jenkins -> Configurer le système -> SonarQube servers
	- Nom : Sonarqube
	- URL du serveur : http://192.168.88.188:9000

- Ajouter le : Server authentication token
	- Avec le token d'authentification de Sonarqube 


# Paramètrage de Sonarqube Scanner

- Sur Jenkins, aller dans le projet et dans le menu "Configure"

- Dans la section "Build", chercher dans le menu déroulant "Execute SonarQube Scanner"

- Chemin vers les propriétés du projet 

```shell
donnee/sites/test-qualite/sonar-project.properties
```

- Propriétés de l'analyse : "Analysis Properties"
```
sonar.projectKey=tests-qualite
sonar.sources=/var/lib/jenkins/workspace/
sonar.login=admin
sonar.password=root
```

- Lancer un build pour vérifier le fonctionnement 
=======
# Installation de Sonarqube Scanner sur Jenkins
- Se connecter sur Sonarqube [127.0.0.1:9000](127.0.0.1:9000) avec le compte par défaut :

```shell
Login : admin
Password : admin
```

- Aller dans "My account", dans l'onglet Security, on génére un token et on le récupère.

- Retourner sur Jenkins, aller dans le menu "Manage Jenkins" puis dans "Manage plugins"

- Dans l'onglet "Available", rechercher "SonarQube Scanner For Jenkins" et installer le plugin

- Une fois installé, redémarrer Jenkins.

# Paramètrage de Sonarqube

- Sur Jenkins, aller dans "Manage Jenkins" et dans "Configure System"

- Dans l'onglet SonarQube Server, appuyer sur le bouton "Add Sonarqube"

- Renseignez un nom, l'adresse de SonarQube (Par défaut http://localhost:9000)

- Créez un nouveau token Jenkins, choissisez l'option "Secret Text" et insérez le token dans "Secret".


# Paramètrage de Sonarqube Scanner

- Sur Jenkins, aller dans le projet et dans le menu "Configure"

- Dans la section "Build", chercher dans le menu déroulant "Execute SonarQube Scanner"

- Dans le champ "Analysis Properties", ajouter et complétez les lignes suivantes :

```shell
sonar.projectKey= "Nom du projet"
sonar.sources=/var/lib/jenkins/workspace
sonar.login= "Token géneré"
```

- Sauvegardez les changements, retournez dans le projet et faites "Build"

- Le résultat du scan est accessible a la fin du build dans la console
>>>>>>> bc47ba779d10860d583f73cc5a5ac70dfc231950
