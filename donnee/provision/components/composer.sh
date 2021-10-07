# Mise à jour de la source liste
sudo apt-get update  

# Installation des dépendances à php
sudo apt-get install -y wget php-cli php-zip unzip

# Installation de l'installer de composer
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"

# Récupération du hash d'installation pour verifier l'intégrité de l'installer
HASH="$(wget -q -O - https://composer.github.io/installer.sig)"

# Vérification pour savoir si le script d'installaion est corrompu
php -r "if (hash_file('SHA384', 'composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"

# Lancement de l'insatllation de composer
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
