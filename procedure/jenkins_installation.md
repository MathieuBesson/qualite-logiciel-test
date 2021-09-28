
# Procédure Jenkins

- Installation d'une VM Ubuntu à l'aide de VirtualBox
- Lancement de l'installation de  l'iso disponible ici : https://ubuntu.com/download/desktop

- Jenkins nécéssite l' [installation de Java](https://ubuntu.com/download/desktop) :
```bash
	apt install openjdk-11-jdk
```

- [Installation de Jenkins](https://www.jenkins.io/doc/book/installing/linux/) sous Ubuntu :
	- Ajout de la clé du référentiel au système : 
```bash
	wget -q -O - https://pkg.jenkins.io/debian-stable/jenkins.io.key | sudo apt-key add -
```
  
   - Ajout de l'adresse du référentiel Debian sur la sources.list du serveur : 
```bash
	sudo sh -c 'echo deb http://pkg.jenkins.io/debian-stable binary/ > /etc/apt/sources.list.d/jenkins.list'
```

   - Une fois les deux commandes saisies, nous exécuterons la update afin que apt utilise le nouveau référentiel.
```bash
	sudo apt update
```

   - Installation de Jenkins et ses dépendances.
```bash
	sudo apt install jenkins
```

   - Démarrrage de Jenkins
```bash
	sudo systemctl start jenkins
```
		
   - On vérifie que Jenkins est bien démarré
```bash
	sudo systemctl status jenkins
```
		
   - On ouvre le par-feu sur le port que va utiliser Jenkins :8080
```bash
	sudo ufw allow 8080
```
		
		
   - Si le par feu est inactif : (autorisation de OpenSSH + activation du par feu)
```bash
	sudo ufw allow OpenSSH
	sudo ufw enable
```
		
   - Vérification des nouvelles règles du par feu 
```bash
	sudo ufw status
```
		
   - Aller à l'adresse suivante pour utiliser Jenkins  : 
```
	http://your_server_ip_or_domain:8080
```
   normalement :  
```
	127.0.0.1:8080 ou localhost:8080
```
		
   - Récupérer le mot de passe admin généré par Jenkins : 
```bash
	sudo cat /var/lib/jenkins/secrets/initialAdminPassword
```
		
   - Copier le mdp dans le champs de formulaire de l'adresse suivante, puis cliquer sur installer els plugins par défaut. 
```
	http://your_server_ip_or_domain:8080
```
		
   - Suivre le reste des indications sur l'interface web 



Jenkins : 

https://www.youtube.com/watch?v=AXlN-f6Uk64&list=PLzvRQMJ9HDiSaisKr7OnM4Fl7JXCDDcmt&index=2
https://medium.com/dev-blogs/configuring-jenkins-with-github-eef13a5cc9e9
https://www.youtube.com/watch?v=8IYtL8TDVL0

SonarQube : 

https://directdevops.blog/2021/07/30/installing-sonarqube-8-9-lts-on-ubuntu/

https://developerinsider.co/install-sonarqube-on-ubuntu/
https://doc.ubuntu-fr.org/sonar
https://www.vultr.com/docs/install-sonarqube-on-ubuntu-20-04-lts

Ngininx

https://serverfault.com/questions/424452/nginx-enable-site-command
