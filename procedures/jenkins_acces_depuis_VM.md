# Accèder à Jenkins sur une VM depuis une machine hôte

## Configuration de VirtualBox 
- Configurer dans VirtualBox le bind des ports : (de la machine hôte vers la VM) de manière à ce que celle-ci soit accessible depuis la machine hote. 

![[virtualbox-binding-ports.png]]

|   | Hôte : 127.0.0.1       | VM : 10.0.2.15|
| :--------------- |:---------------:| :-----:|
| Web  |   :8080        |  :80 |
| Jenkins  | :8081             |   :8080 |


## Lancement de Jenkins 
- Après avoi effectué l'installation de Jenkins sur la VM (cf procedure/jenkins_installation.md)
- Lancer l'URL [127.0.0.1:8081](127.0.0.1:8081) pour accèder à Jenkins sur votre VM 

```shell
# Lancer Jenkins si besoin 
sudo systemctl start jenkins
```

```shell
# Récupérer le mot de passe admin puis copier le dans le champs de formulaire Jenkins
cat /var/lib/jenkins/secrets/initialAdminPassword
```

- Installer les plugins suggérés par Jenkins 

## Installation d'un reverse proxy pour accèder à la machine hôte depuis l'extérieur
L'objectif est de pourvoir accèder à [127.0.0.1:8081](127.0.0.1:8081) de manière à pouvoir atteindre la machine hôte depuis l'extérieur (ici avec [socketxp.com](https://www.socketxp.com) => url fix pendant 30 jours)
- Créer un compte sur [socketxp.com](https://www.socketxp.com) 
- Téléchargement et installation du proxy 

```shell
curl -O https://portal.socketxp.com/download/linux32/socketxp 
&& chmod +wx socketxp && sudo mv socketxp /usr/local/bin
```

- Authentification de la machine hôte
```shell
socketxp login "your_token"
```
- Le token d'authentification est trouvable dans le dashboard de SocketXP : [socketxp.com -> Dashboard -> authtoken](https://portal.socketxp.com/#/authtoken)

![[socketXP-authentification.png]]

-  Création du tunnel sécurisé  pour binder l'url https://xxxxxxx.socketxp.com sur -> http://127.0.0.1:8081
```shell
socketxp connect http://127.0.0.1:8081

# Output: 
Connected to SocketXP Cloud Gateway.  
Public URL -> https://test-user-a29dfe42e3.socketxp.com
```


## Création du Webhook github 
- Ajout du webhook sur github : Aller dans Settings-> webhooks -> Ajouter un webhook, puis saisir l'url du proxy + /github-webhook/

![[github-webhook.png]]

## Création de la connexion ssh entre jenkins et github 
- Changement d'utilisateur unix 

```shell
sudo -su jenkins
```

```shell
# Génération d'une paire de clé ssh sur la machine hote 
ssh-keygen
```

- Récupération de la clé public : id_rsa.pub 
```shell
cat ~/.ssh/id_rsa.pub
```

- Ajout de la clé dans Github : Settings -> Deploy keys -> Add deploy key 
![[github-ssh-key.png]]