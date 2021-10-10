# Projet symfony installation

// Se rendre à la racine du projet Symfony

```shell
cd /var/www/sites/test-qualite
```

// Lancer l'instalation des dépendances du projet

```shell
composer install -y
```

// Lancer la création de la bdd

```shell
php bin/console doctrine:database:create -y
```

// Lancer la création des fixtures

```shell
php bin/console doctrine:fixtures:load -y
```