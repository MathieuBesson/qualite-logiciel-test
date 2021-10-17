sudo apt-get update

# Augmenter le temps d'execution pour la session
sudo sysctl -w vm.max_map_count=262144
sudo sysctl -w fs.file-max=65536
ulimit -n 65536
ulimit -u 4096

sudo touch /etc/security/limits.conf

echo -e "sonarqube   -   nofile   65536\nsonarqube   -   nproc    4096" > /opt/sonarqube/conf/sonar.properties

# Mise à jour des listes de paquets 
sudo apt-get update -y
sudo apt-get upgrade -y

# Installation de wget et unzip
sudo apt-get install wget unzip -y

sudo apt-get install openjdk-11-jdk -y
# Ajout du repo de postgres à la liste 
# sudo sh -c 'echo "deb http://apt.postgresql.org/pub/repos/apt/ `lsb_release -cs`-pgdg main" >> /etc/apt/sources.list.d/pgdg.list'

# Télecharegement du repo 
# wget -q https://www.postgresql.org/media/keys/ACCC4CF8.asc -O - | sudo apt-key add -

# Installation de postgres 
sudo apt-get -y install postgresql postgresql-contrib

# Démarrage de postrges
sudo systemctl start postgresql

# Démarrage de postgres au démarrage de la machine 
sudo systemctl enable postgresql
 
# Chnagement du mot de passe de l'utilisateur unix postgres
echo postgres:postgres | sudo /usr/sbin/chpasswd

# Connexion en tant qu'utilisateur postgres
sudo -u postgres -H -- psql -d postgres -c "CREATE USER sonar WITH ENCRYPTED password 'sonar';"
sudo -u postgres -H -- psql -d postgres -c "CREATE DATABASE sonarqube OWNER sonar;"
sudo -u postgres -H -- psql -d postgres -c "GRANT ALL privileges on DATABASE sonarqube to sonar;"

# Téléchargement de sornarqube
cd /tmp 
echo 'Téléchargement de sornarqube'

 sudo wget --no-verbose https://binaries.sonarsource.com/Distribution/sonarqube/sonarqube-8.9.1.44547.zip


# Dezip sonarqube
sudo unzip sonarqube-8.9.1.44547.zip -d /opt
 
# Changement du nom pour "sonarqube"
sudo mv /opt/sonarqube-8.9.1.44547 /opt/sonarqube

# Création du groupe et de l'utilisateur 
sudo groupadd sonar
 
sudo useradd -c "user to run SonarQube" -d /opt/sonarqube -g sonar sonar 
sudo chown sonar:sonar /opt/sonarqube -R

# Ajout de la configuration pour la base de donnée 
echo -e "sonar.jdbc.username=sonar\nsonar.jdbc.password=sonar\nsonar.jdbc.url=jdbc:postgresql://localhost:5432/sonarqube" > sudo /opt/sonarqube/conf/sonar.properties

sudo sed -i "3i\RUN_AS_USER=sonar" /opt/sonarqube/bin/linux-x86-64/sonar.sh


# Lancement du script de démarrage de Sonarqube 
sudo su sonar -c "/opt/sonarqube/bin/linux-x86-64/sonar.sh start"














