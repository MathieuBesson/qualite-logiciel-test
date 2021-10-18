# Procédure d'installation de Sonarqube



## Installation de [Sonarqube](https://docs.sonarqube.org/latest/) sous Ubuntu 

- Mise a jour des paquets :
```shell
sudo apt-get update
```

- Installation du service de base de données PostgreSQL : 
```shell
sudo apt-get install postgresql postgresql-contrib
```
  
   - Accès a la ligne de commande de Postgres : 
```shell
sudo su - postgres
psql
```

   - Création d'un utilisateur sonarqube avec le mot de passe admin.
```sql
CREATE USER sonarqube WITH PASSWORD 'admin';
```

   - Création d'une base de données sonarqube 
```sql
CREATE DATABASE sonarqube OWNER sonarqube;
GRANT ALL PRIVILEGES ON DATABASE sonarqube TO sonarqube;
\q
exit;
```


   - Téléchargement du package Sonarqube, qui est déplacé dans l'annuaire OPT.
```bash
sudo mkdir /downloads/sonarqube -p
cd /downloads/sonarqube
sudo wget https://binaries.sonarsource.com/Distribution/sonarqube/sonarqube-7.9.1.zip
sudo unzip sonarqube-7.9.1.zip
sudo mv sonarqube-7.9.1 /opt/sonarqube
```

   - Création de l'utilisateur unix sonarqube
```shell
sudo adduser --system --no-create-home --group --disabled-login sonarqube
sudo chown -R sonarqube:sonarqube /opt/sonarqube
```
		
   - Modification du fichier de config sonar.sh
```shell
sudo vi /opt/sonarqube/bin/linux-x86-64/sonar.sh
```

   - Configuration de l'option RUN_AS_USER
```shell
RUN_AS_USER=sonarqube
```

   - Modification du fichier de config sonar.properties
```shell
sudo vi /opt/sonarqube/conf/sonar.properties
```

   - Configuration des options de connection
```shell
sonar.jdbc.username=sonarqube
sonar.jdbc.password=admin
sonar.jdbc.url=jdbc:postgresql://localhost/sonarqube
sonar.web.javaAdditionalOpts=-server
sonar.web.host=0.0.0.0
```
   - Augmenter la capacite d'execution des scipts 
```shell
sudo sysctl -w vm.max_map_count=400000
sudo sysctl -w fs.file-max=120000
ulimit -n 120000
ulimit -u 8200
```
   - Création d'un fichier de configuration 99-sonarqube.conf
```shell
sudo nano /etc/security/limits.conf
```

   - Contenu du fichier limits.conf
```shell
sonarqube   -   nofile   120000
sonarqube   -   nproc    8200
```

   - Modification du fichier sysctl.conf
```shell
sudo vi /etc/sysctl.conf
```

   - Ajout de lignes a la fin du fichier sysctl.conf
```shell
vm.max_map_count=400000
fs.file-max=120000
```

   - Redémarrage de la machine virtuelle pour appliquer les changements
```shell
reboot
```

  - Démarrage de Sonarqube
```shell
/opt/sonarqube/bin/linux-x86-64/sonar.sh start
```

		
## Accès a l'interface Web
   - On accède a l'interface en localhost par le port 9000
```shell
http://localhost:9000
```
   - On se connecte au panel grâce aux identifiants par défaut :
```shell
Login : admin
Password : admin
```	





En cas de problème de mémoire lors de l'execution du script sonar.sh 

```shell
sudo sysctl -w vm.max_map_count=524288
sudo sysctl -w fs.file-max=131072
ulimit -n 131072
ulimit -u 8192
```

```shell
sonarqube   -   nofile   131072
sonarqube   -   nproc    8192
```