# Authentification_JWT_Symfony_6
Une implémentation simple du JSON WEB TOKEN avec le bundle lexik/jwt-authentication-bundle

La version 6 de Symfony apporte quelques changements dans la configuration de ce bundle

Deux champs vont s'y ajouter (username_path et password_path).

Il faudra la version 8 de PHP pour lancer le projet.

Vous vous rendez à la racine du projet dans la console puis 

- composer install 
- php bin/console doctrine:database:create

Autres

Générer les SSH keys:
$ mkdir config/jwt
$ openssl genrsa -out config/jwt/private.pem -aes256 4096
$ openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem