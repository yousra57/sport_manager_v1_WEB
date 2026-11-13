# Sport Manager – PHP / MVC et backend partagé

Le site affiche les équipes et les joueurs (listes et détails), sans authentification.
Le site et l'API utilisent MariaDB via un backend commun.

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
Les requêtes destinées au mobile passent par l'API distincte dans api/.
L'API est implémentée dans api/public/index.php. Elle charge backend/bootstrap.php
pour utiliser les mêmes modèles et la même connexion, sans charger les vues ni
les contrôleurs du site web. Elle renvoie {"success": true, "data": ...} en cas de succès.

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

## Lancer Flutter dans Chrome sur ce PC

1. Démarrer MariaDB (MySQL dans le panneau XAMPP).
2. Dans un terminal à la racine, démarrer l'API et laisser ce terminal ouvert :

       php -S localhost:8001 -t api/public api/public/index.php

3. Dans un deuxième terminal :

       cd mobile
       flutter pub get
       flutter run -d chrome

Chrome affiche l'application Flutter, qui appelle l'API sur http://localhost:8001.
L'adresse de l'application Flutter est différente de celle de l'API.
Les réponses de l'API autorisent ces appels depuis le navigateur (CORS).

Dans VS Code, ouvrir le dossier racine du projet, choisir la configuration
« Flutter - Chrome » dans Exécuter et déboguer, puis appuyer sur F5.
Le serveur PHP et MariaDB doivent rester démarrés indépendamment.

Si l'import package:flutter/material.dart est introuvable, lancer flutter pub get
depuis mobile. Cette commande génère notamment .dart_tool/package_config.json,
qui permet à Dart de retrouver les dépendances. Si les erreurs restent affichées
après une installation réussie, utiliser « Dart: Restart Analysis Server » dans
la palette de commandes de VS Code. Le SDK Flutter doit être installé et détecté ;
l'extension VS Code seule ne remplace pas le SDK.

## Branchement des écrans à l'API

- Les anciennes listes fictives _teams et _players ont été remplacées par
  ApiService.getEquipes() et ApiService.getJoueurs().
- Les détails appellent getEquipe(id_equipe) et getJoueur(id_joueur).
- mobile/lib/models/sport.dart transforme les champs JSON en objets Dart ;
  les numéros et âges absents sont gérés sans erreur.
- mobile/lib/widgets/api_builder.dart gère l'attente, les erreurs et le bouton
  Réessayer. Les écrans gèrent les listes vides et la recherche locale des joueurs.
- Le service API utilise un délai de 10 secondes et permet de changer le serveur :

       flutter run -d chrome --dart-define=API_BASE_URL=http://localhost:8001

Pour vérifier le code et les parcours avec une API simulée, depuis mobile :

    flutter analyze
    flutter test

## Routes API (GET)

    /api/equipes       data = liste des équipes
    /api/joueurs       data = liste des joueurs
    /api/equipe/{id}   data = équipe avec sa liste joueurs
    /api/joueur/{id}   data = joueur avec poste, caractéristiques et équipe_nom

En cas d'erreur, la réponse contient success=false et message.
Un identifiant inexistant renvoie 404, une méthode interdite 405,
et une erreur serveur 500.
