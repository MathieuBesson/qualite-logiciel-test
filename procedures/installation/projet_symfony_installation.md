# Projet Symfony installation

Pour accèder au projet Symfony lancer les commandes suivantes

- Se rendre à la racine du projet Symfony

```shell
cd /var/www/sites/test-qualite
```

- Lancer l'installation des dépendances du projet

```shell
composer install
```

- Lancer la création de la bdd

```shell
php bin/console doctrine:database:create
```

- Lancer les migrations de bdd

```shell
 php bin/console doctrine:migrations:migrate
```

- Lancer la création des fixtures

```shell
php bin/console doctrine:fixtures:load
```

Rendez vous ici pour découvrir le projet : 
```
192.168.88.188
```