# Procédure d'installation de Jenkins 

## Prérequis 
- Installation d'une VM Ubuntu à l'aide de VirtualBox
- Lancement de l'installation de  l'iso disponible ici : https://ubuntu.com/download/desktop
- Jenkins nécéssite l' [installation de Java](https://ubuntu.com/download/desktop) :
```shell
apt install openjdk-11-jdk
```

## Installation de [Jenkins](https://www.jenkins.io/doc/book/installing/linux/) sous Ubuntu 

- Ajout de la clé du référentiel au système : 
```shell
wget -q -O - https://pkg.jenkins.io/debian-stable/jenkins.io.key | sudo apt-key add -
```
  
   - Ajout de l'adresse du référentiel Debian sur la sources.list du serveur : 
```shell
sudo sh -c 'echo deb http://pkg.jenkins.io/debian-stable binary/ > /etc/apt/sources.list.d/jenkins.list'
```

   - Une fois les deux commandes saisies, nous exécuterons la update afin que apt utilise le nouveau référentiel.
```shell
sudo apt update
```

   - Installation de Jenkins et ses dépendances.
```bash
sudo apt install jenkins
```

   - Démarrrage de Jenkins
```shell
sudo systemctl start jenkins
```
		
   - On vérifie que Jenkins est bien démarré
```shell
sudo systemctl status jenkins
```
		
		
## Configuration du par feu
   - On ouvre le par-feu sur le port que va utiliser Jenkins :8080
```shell
sudo ufw allow 8080
```
		
   - Si le par feu est inactif : (autorisation de OpenSSH + activation du par feu)
```shell
sudo ufw allow OpenSSH
sudo ufw enable
```

   - Vérification des nouvelles règles du par feu 
```shell
sudo ufw status
```
		
## Authentification sur Jenkins 
   - Aller à l'adresse suivante pour utiliser Jenkins  : 
```shell
http://your_server_ip_or_domain:8080
## 127.0.0.1:8080 ou localhost:8080
```
		
   - Récupérer le mot de passe admin généré par Jenkins : 
```shell
sudo cat /var/lib/jenkins/secrets/initialAdminPassword
```
		
   - Copier le mdp dans le champs de formulaire de l'adresse suivante, puis cliquer sur installer les plugins par défaut. 
```shell
http://your_server_ip_or_domain:8080
```
		
   - Suivre le reste des indications sur l'interface web 


