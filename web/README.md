# Sport Manager – V1 web (PHP / MVC)

Page de débrief + affichage des équipes et des joueurs (liste et détail). Sans authentification.

## Lancer
Il faut PHP 8.1 ou plus avec l'extension `pdo_sqlite` (activée par défaut dans XAMPP).

    php -S localhost:8000 -t public

Puis ouvrir http://localhost:8000
(avec XAMPP : copier le dossier dans `htdocs` et ouvrir `http://localhost/sportmanager-php/public/`).

La base `data/sportmanager.sqlite` est créée et remplie toute seule au premier chargement.
Pour repartir de zéro : supprimer ce fichier.

## Structure (MVC)
    public/index.php      routeur unique (index.php?p=equipes, equipe&id=1, joueurs, joueur&id=1)
    app/models/           accès aux données (SQL via PDO)
    app/controllers/      reçoivent la requête, appellent les modèles, choisissent la vue
    app/views/            pages HTML (layout.php + une vue par page)
    database/seed.php     schéma + jeu de données du bloc 2 (4 équipes, 24 joueurs, 4 postes)

## Captures du bloc 2
Déposer equipes.png, joueurs.png, postes.png, match.png dans `public/img/preuves/` :
elles s'affichent automatiquement dans la page de débrief.
