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