# Configuration de Jenkins pour le lancement de test automatisés 
- Retourner sur Jenkins [127.0.0.1:8081](127.0.0.1:8081) et lancer un Nouvelle item -> Construire un projet free-style 

- Ajouter l'url ssh de votre dépôt distant 
![[jenkins-configuration.png]]


- Ajouter le lien vers les test unitaires 
https://devops4solutions.medium.com/jenkins-setup-for-php-unit-testing-on-aws-c39baad7a99e

```shell
/usr/local/bin/phpunit — log-junit test.xml -c phpunit.xml .
```