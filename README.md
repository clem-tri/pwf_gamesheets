# pwf_gamesheets
Projet fiches ePub (LPW/Flux numérique)
* require PHP ^7.1.3
Commandes à effectuer avant de lancer l'application :
* run `composer update` pour télécharger le dossier vendor
* run `npm install` pour installer les dépendences

## BDD MySQL 
* name : pwf_gamesheets
* Créer les tables => à la racine du projet: `php artisan migrate`

## fichier .env
* copier le fichier ".env.example" se trouvant à la racine et coller la copie en la renommant ".env"
* configurer les paramètres suivant:  `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
* lancer la commande `php artisan key:generate` pour génerer la valeur de la clé unique du paramètre `APP_KEY`

## Virtualhost (conseillé)

Sur WAMP (Vos VirtualHosts -> Gestion VirtualHost) ou autre, créer un virtualhost pointant vers votre le dossier public/ du projet

Ne pas oublier de redémarrer les services une fois effectué
