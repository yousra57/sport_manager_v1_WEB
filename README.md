# Sport Manager – PHP / MVC et backend partagé

Le site affiche les équipes et les joueurs (listes et détails), sans authentification.
Il utilise MariaDB via un backend commun que la future API pourra également charger.

## Structure

    backend/
        bootstrap.php        Chargement commun de la connexion et des modèles
        Database.php         Connexion PDO MariaDB
        config.php           Configuration locale ignorée par Git
        config.exemple.php   Modèle de configuration à partager
        models/              Requêtes SQL : Equipe et Joueur
        database/
            schema.sql       Schéma MariaDB pour une installation neuve
            seed.php         Import explicite des données de démonstration
        data/                Archive de l'ancienne base SQLite, inutilisée
    web/
        app/
            bootstrap.php    Charge le backend puis les éléments web
            controllers/     Contrôleurs du site web
            helpers.php      Fonctions d'affichage HTML et URL du site
            views/           Vues HTML
        public/
            index.php        Point d'entrée du site
            css/             Styles
    .gitignore
    README.md

Les contrôleurs web restent dans web/app/controllers.
Les futurs contrôleurs destinés au mobile seront dans une API distincte.
Cette API n'est pas encore implémentée : elle pourra charger backend/bootstrap.php
pour utiliser les mêmes modèles et la même connexion, sans charger les vues ni
les contrôleurs du site web.

## Configuration

Prérequis : PHP 8.1 ou plus avec pdo_mysql, et MariaDB démarré (XAMPP convient).
Depuis la racine du projet, pour une nouvelle installation :

    Copy-Item backend/config.exemple.php backend/config.php

Adapter backend/config.php à son installation. Configuration locale prévue :
127.0.0.1:3306, base sm_crossplateforme, utilisateur root, mot de passe vide.
backend/config.php est exclu de Git ; backend/config.exemple.php est le modèle à partager.

## Base de données

Si la base et les huit tables existent déjà, aucune importation du schéma n'est nécessaire.
Pour une nouvelle installation, importer backend/database/schema.sql via phpMyAdmin.
Ce script crée la base et les tables manquantes ; il ne modifie pas les tables existantes.
Il reprend le schéma MariaDB local : joueur au singulier, force_physique,
nom_post en texte, identifiants auto-incrémentés et clés étrangères.

Pour ajouter volontairement des données de démonstration sur une base vide,
depuis la racine :

    php backend/database/seed.php

Ce script ajoute 4 équipes, 6 joueurs et 4 postes. Il refuse de s'exécuter si une
table contient déjà des données et ne supprime rien. Le site ne crée aucune table
et n'importe aucune donnée lors des requêtes web.

L'ancien fichier SQLite est conservé dans backend/data s'il était présent.
Il n'est plus utilisé ; ses données ne sont pas migrées automatiquement.
Les règles .gitignore ne retirent pas de Git un fichier déjà suivi.

## Lancer le site

Depuis la racine du projet :

    php -S localhost:8000 -t web/public

Ouvrir http://localhost:8000.
Les routes web restent : ?p=equipes, ?p=equipe&id=1, ?p=joueurs, ?p=joueur&id=1.
Servir uniquement web/public afin que le backend et sa configuration restent hors
du dossier public.