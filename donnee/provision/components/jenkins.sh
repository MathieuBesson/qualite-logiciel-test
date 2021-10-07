# Mise à jour de la source liste
sudo apt-get update  

# Installation de Java 
sudo apt-get install -y openjdk-11-jdk

# Ajout de la clé du référentiel au système 
wget -q -O - https://pkg.jenkins.io/debian-stable/jenkins.io.key | sudo apt-key add -

# Ajout de l'adresse du référentiel Debian sur la sources.list du serveur :
sudo sh -c 'echo deb http://pkg.jenkins.io/debian-stable binary/ > /etc/apt/sources.list.d/jenkins.list'

# Mise à jour de la source liste
sudo apt-get update  

# Installation de Jenkins et ses dépendances.
sudo apt-get install -y jenkins

# Démarrrage de Jenkins
sudo systemctl start jenkins

# On ouvre le par-feu sur le port que va utiliser Jenkins :8080
sudo ufw allow 8080

Vérification des nouvelles règles du par feu
sudo ufw allow OpenSSH
sudo ufw enable

echo 'Entrer le mot de passe suivant ici http://your_server_ip_or_domain:8080' 
sudo cat /var/lib/jenkins/secrets/initialAdminPassword

# Génération d'un clé ssh entre jenkins et le service d'hébergement du code versionné 
sudo -su jenkins
ssh-keygen -t rsa -N "" -f ~/.ssh/id_rsa

echo 'Voici la clé publique à insérer sur votre service hébergement du code' 
cat ~/.ssh/id_rsa.pub
