# Configuration de Jenkins pour le lancement de test automatisés

-   Retourner sur Jenkins [192.168.88.188:8081](192.168.88.188:8081) :

```
Nouvelle item -> Saisissez un nom -> Construire un projet free-style
```

Ajouter une méthode de gestion du code source :

```
Gestion de code source -> Git
```

-   Ajouter l'url ssh de votre dépôt distant

```
Gestion de code source -> Repositories -> Repository URL ->
```

```
git@github.com:usernameGithub/projectNameOnGitHub.git
```

-   Ajouter une action de déclenchement

```
Ce qui déclenche le build -> GitHub hook trigger for GITScm polling
```

-   Ajouter une étape au build : lancement des tests unitaires

```
Ajouter une étape au build -> Executer un script shell
```

```shell
# Installation des dépendances du projet nottemment celles de notre framwork de tests (PHPUnit)
composer install --working-dir=donnee/sites/test-qualite/

# Lancement des tests unitaires
donnee/sites/test-qualite/vendor/bin/phpunit -c donnee/sites/test-qualite/phpunit.xml.dist
```

-   Appliquer la configuration

```
Apply -> Sauver
```

-   Tester la nouvelle configuration

```
Lancer un build
```
