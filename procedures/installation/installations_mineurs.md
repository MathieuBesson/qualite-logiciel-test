# Installations mineurs

## Installation de php

- Mise à jour des sources des paquets

```shell
sudo apt-get update
```

- Ajout d'une surcouche de logicielles

```shell
sudo apt -y install software-properties-common
```

- Récupération de toutes les versions de php

```shell
sudo add-apt-repository ppa:ondrej/php
```

- Installation de php

```shell
sudo apt -y install php7.4
```

- Installation des librairies php utiles

```shell
sudo apt-get install -y php7.4-cli php7.4-json php7.4-common php7.4-mysql php7.4-zip php7.4-gd php7.4-mbstring php7.4-curl php7.4-xml php7.4-bcmath
```

- Vérification de l'installation

```shell
php -v
```

## Installation de composer

- Mise à jour de l'index des paquets

```shell
sudo apt update
```

- Installation des dépendances à php

```shell
sudo apt install wget php-cli php-zip unzip
```

- Installation de l'installer de composer

```shell
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
```

- Récupération du hash d'installation pour verifier l'intégrité de l'installer

```shell
HASH="$(wget -q -O - https://composer.github.io/installer.sig)"
```

- Vérification pour savoir si le script d'installaion est corrompu

```shell
php -r "if (hash_file('SHA384', 'composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
```

- Lancement de l'insatllation de composer

```shell
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
```

- Vérification de l'insstallation de composer

```shell
composer
```

```shell
## output
 ______
/ ____/___  ____ ___  ____  ____  ________  _____
/ /   / __ \/ __ `__ \/ __ \/ __ \/ ___/ _ \/ ___/
/ /___/ /_/ / / / / / / /_/ / /_/ (__  )  __/ /
\____/\____/_/ /_/ /_/ .___/\____/____/\___/_/
                    /_/
Composer version 1.8.5 2019-04-09 17:46:47

Usage:
    command [options] [arguments]
```

## Installation de git

- Installation

```shell
sudo apt install git
```

- Configuration de git

```shell
git config --global user.email «test@example.com »
git config --global user.name «nomUtilisateur»
```

- Verification de l'installation de git

```shell
git --version
```

```shell
## output
git version xxxxx
```

## Installation de Nginx

- Installation de Nginx

```shell
sudo apt-get update
sudo apt-get install nginx
```

- Restart de Nginx et vérification de l'état actuel

```shell
sudo service nginx restart
sudo service nginx status
```

- Modification de la configuration par défaut pour pointer sur notre site

```nginx
server {
    server_name _;
    root /var/www/sites/test-qualite/public;

    location / {

        try_files $uri /index.php$is_args$args;
    }

    location ~ ^/(index_dev|config)\.php(/|$) {
        fastcgi_pass unix:/var/run/php7.4-fpm.sock;
        fastcgi_split_path_info ^(.+\.php)(/.*)$;
        include fastcgi_params;

        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        fastcgi_param DOCUMENT_ROOT $realpath_root;
    }
    # PROD
    location ~ ^/index\.php(/|$) {
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
        fastcgi_split_path_info ^(.+\.php)(/.*)$;
        include fastcgi_params;

       fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
       fastcgi_param DOCUMENT_ROOT $realpath_root;

       internal;
   }

   # return 404 for all other php files not matching the front controller
   # this prevents access to other php files you don't want to be accessible.
   location ~ \.php$ {
     return 404;
   }

   error_log /var/log/nginx/project_error.log;
   access_log /var/log/nginx/project_access.log;
}
```

- Installation de php pour nginx

```shell
sudo apt-get install php7.4-fpm -y
```

- Restart de nginx + lancement au démarrage

```shell
sudo systemctl start php7.4-fpm
sudo systemctl enable php7.4-fpm
```

- Restart de Nginx

```shell
sudo service nginx restart
```

- Test de la configuartion par défaut

```shell
nginx -t
```

- Test sur le naviguateur (après détournemennt de DNS dans virtual box 127.0.0.1:8080 -> 10.0.2.15:80) : [127.0.0.1:8080](127.0.0.1:8080)

## Installation de Mariadb

- Mise à jour de la liste des paquets et on installe mariadb

```shell
sudo apt update
sudo apt install mariadb-server
```

- Vérification de l'installation

```shell
sudo systemctl status mariadb
```

- Sécurisation la bdd par mot de passe

```bash
sudo mysql_secure_installation
```

- Connexion à la BDD en ligne de commande

```shell
sudo mariadb
```

- Création d'un utilisateur pour la future base de donnée

```sql
GRANT ALL ON *.* TO 'admin'@'localhost' IDENTIFIED BY 'admin' WITH GRANT OPTION;
```


## Installer PHPUnit