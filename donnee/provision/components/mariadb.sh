# Mise à jour de la source liste
sudo apt-get update  

# Installation de mariadb 
sudo apt-get install -y mariadb-server

# Connexion à mariadb

DBHOST=localhost
DBNAME='test_qualite'
DBUSER=admin
DBPASSWD=admin


debconf-set-selections <<< "mysql-server mysql-server/root_password password $DBPASSWD"
debconf-set-selections <<< "mysql-server mysql-server/root_password_again password $DBPASSWD"

CMD="mysql -uroot -p$DBPASSWD -e"

$CMD "CREATE DATABASE IF NOT EXISTS $DBNAME"
$CMD "GRANT ALL PRIVILEGES ON $DBNAME.* TO '$DBUSER'@'%' IDENTIFIED BY '$DBPASSWD';"
$CMD "FLUSH PRIVILEGES;"

#sudo sed -i "s/.*bind-address.*/bind-address = 0.0.0.0/" /etc/mysql/mysql.conf.d/mysqld.cnf

sudo service mysql restart






