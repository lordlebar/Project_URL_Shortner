# Project_URL_Shortner

#### Groupe 1 Xavier, Quentin, Adrienne, Théo, Corentin, test

---

### Notation des projets

Code 10 pts, le code devra être fait avec soin et commenté
Ergonomie 5 pts
Charte graphique 5 pts
Allez plus loin que le cahier des charges : 10 pts
Notation par élèves 10 pts

- #### Obligatoire :

        $ Avoir un nom d’équipe
        $ Utilisation de boostrap
        $ Utilisation du https
        $ Utilisation d’un git pour le travail d’équipe
        $ Le mail sera la référence unique de l’inscrit

Toutes les erreurs doivent être traitées : pas de doublons de mails d’inscrits, recouvrement de mot de passe oublié par mail, validation d’inscription par mail…

---

### Projet 1 : raccourcisseur d’URL

Créer un raccourcisseur d’URL de la forme xxx.13h37.io/{alphaNum} a-zA-Z0-9

Un champ de saisie pour un internaute non inscrit va créer une URL raccourcie. Faire en sorte que l’URL soit toujours la plus petite possible. Mémoriser les URL raccourcies.

mettre en place les dorks suivants :

    $ ajouter un + à la fin de l’url raccourcie permet de montrer l’url finale
    $ ajouter un * à la fin de l’url raccourcie donne ses statistiques de clics
    $ ajouter un - à la fin de l’url raccourcie supprime le raccourci (avec validation)

Un internaute peut s’inscrire, avec validation du de son mail, et avoir des fonctionnalités supplémentaires :

    $ choisir sa propre chaîne de caractère pour son raccourcisseur
    $ avoir les stats de clics
    $ peut effacer une url raccourcie
    $ peut modifier une chaine de caractère de son url raccourcie

Créer un panel d'administration pour modérer les liens raccourcis et les comptes

## For htaccess in folder html :

        Options -Indexes
        RewriteEngine on
        RewriteCond %{HTTPS} off
        RewriteRule .* https://%{HTTP_HOST}%{REQUEST_URI}/ [R=301,L]

        Header set Content-Security-Policy "upgrade-insecure-requests"
        Header set Strict-Transport-Security "max-age=31536000; includeSubDomains"
        Header set X-Xss-Protection "1; mode=block"
        Header set X-Frame-Options "SAMEORIGIN"
        Header set X-Content-Type-Options "nosniff"
        Header set Referrer-Policy "strict-origin-when-cross-origin"
        Header set Permissions-Policy "geolocation=self"

        RewriteEngine on
        RewriteBase /

        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteCond %{REQUEST_FILENAME} !-l
        RewriteRule ^ https://%{HTTP_HOST}/Project_URL_Shortner/src/pages/configuration/redirection_page.php?short_url=%{REQUEST_URI} [L,R]

## for htaccess in folder of Project :

        RewriteEngine on
        RewriteBase /

        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteCond %{REQUEST_FILENAME} !-l
        RewriteRule ^ https://%{HTTP_HOST}/Project_URL_Shortner [L,R]

## DEVOPS

### Docker

Build Project

     docker build -t php_url_shortner ./docker

Run The container

    docker run -d --rm -p 8080:80 --name php_url_shortner -v "$PWD":/var/www/Project_URL_Shortner php_url_shortner

Interact with Container

     docker exec -it php_url_shortner bash
