## Accèder à Jenkins sur une VM depuis une machine hôte

- Configurer dans VirtualBox le bind des ports : (de la machine hôte vers la VM)

![[virtualbox-binding-ports.png]]

|   | Hôte : 127.0.0.1       | VM : 10.0.2.15|
| :--------------- |:---------------:| :-----:|
| Web  |   :8080        |  :80 |
| Jenkins  | :8081             |   :8080 |

- Lancer l'URL [127.0.0.1:8081](127.0.0.1:8081) pour accèder à Jenkins sur votre VM 
- Lancer Jenkins si besoin 

```shell
sudo systemctl start jenkins
```


- Récupérer le mot de passe admin avec : 

```shell
cat /var/lib/jenkins/secrets/initialAdminPassword
```

- Installer les plugin suggérés 
- Installer un reverse proxy sur votre machine hote pour accèder à [127.0.0.1:8081](127.0.0.1:8081) 
- Avec Ngrok : https://dashboard.ngrok.com/get-started/setup
- Lancer le reverse proxy 

```shell
./ngrok http 8081
```
- Rapport http://127.0.0.1:4040/
- Récupérer l'adresse du reverse proxy 
![[reverse-proxy.png]]

- Aller dans Settings-> webhooks -> Ajouter un webhook, puis sersair l'url du proxy + /github-webhook/

![[github-webhook.png]]
- Ajouter le webhook

- Créer une connexion ssh entre le serveur jenkins et le dépôt distant github 
- Génération d'une paire de clé ssh sur la machine hote 
```shell
    ssh-keygen
```

- Récupération de la clé public : id_rsa.pub puis ajout dans github 
```shell
    cat ~/.ssh/id_rsa.pub
```

- Settings -> Deploy keys -> Add deploy key 
![[github-ssh-key.png]]
- Retourner sur Jenkins [127.0.0.1:8081](127.0.0.1:8081) et lancer un Nouvelle item -> Construire un projet free-style 

- Ajouter l'url ssh de votre dépôt distant 
![[jenkins-configuration.png]]


- Ajouter le lien vers les test unitaires 
https://devops4solutions.medium.com/jenkins-setup-for-php-unit-testing-on-aws-c39baad7a99e

```shell
/usr/local/bin/phpunit — log-junit test.xml -c phpunit.xml .
```