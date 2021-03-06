# Mise à jour de la source liste
sudo apt-get update  

# Installation de nginx
sudo apt-get install -y nginx

# Redémarrage de nginx
sudo service nginx restart

# On supprime la configuartion par défaut
sudo rm -f /etc/nginx/sites-available/default

# et on la remplace par la notre 
sudo cp /var/www/provision/config/nginx/vhosts/default /etc/nginx/sites-available/default

sudo apt-get install php7.4-fpm -y

sudo systemctl start php7.4-fpm
sudo systemctl enable php7.4-fpm

# On redémarre le serveur web 
sudo service nginx restart



