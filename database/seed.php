<?php
// Jeu de données de départ (repris du SeedData du projet bloc 2).

function creerSchemaEtDonnees(PDO $pdo): void
{
    $pdo->exec('
        CREATE TABLE postes (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nom TEXT NOT NULL,
            description TEXT NOT NULL
        );
        CREATE TABLE equipes (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nom TEXT NOT NULL,
            ville TEXT NOT NULL,
            stade TEXT NOT NULL,
            budget INTEGER NOT NULL
        );
        CREATE TABLE joueurs (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nom TEXT NOT NULL,
            prenom TEXT NOT NULL,
            age INTEGER NOT NULL,
            numero INTEGER NOT NULL,
            est_blesse INTEGER NOT NULL DEFAULT 0,
            equipe_id INTEGER NOT NULL REFERENCES equipes(id),
            poste_id INTEGER NOT NULL REFERENCES postes(id)
        );
        CREATE TABLE competences (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            joueur_id INTEGER NOT NULL UNIQUE REFERENCES joueurs(id),
            vitesse INTEGER NOT NULL,
            endurance INTEGER NOT NULL,
            force INTEGER NOT NULL,
            technique INTEGER NOT NULL
        );
    ');

    $pdo->beginTransaction();

    $postes = [
        ['Gardien', 'Gardien de but'],
        ['Défenseur', 'Défenseur central ou latéral'],
        ['Milieu', 'Milieu de terrain'],
        ['Attaquant', 'Attaquant ou ailier'],
    ];
    $st = $pdo->prepare('INSERT INTO postes (nom, description) VALUES (?, ?)');
    foreach ($postes as $p) { $st->execute($p); }

    $equipes = [
        ['Paris FC', 'Paris', 'Parc des Princes', 500000000],
        ['Lyon United', 'Lyon', 'Groupama Stadium', 300000000],
        ['Marseille City', 'Marseille', 'Vélodrome', 250000000],
        ['Bordeaux FC', 'Bordeaux', 'Matmut Atlantique', 150000000],
    ];
    $st = $pdo->prepare('INSERT INTO equipes (nom, ville, stade, budget) VALUES (?, ?, ?, ?)');
    foreach ($equipes as $e) { $st->execute($e); }

    // [equipe_id, nom, prenom, age, numero, poste_id, vitesse, endurance, force, technique]
    $joueurs = [
        [1, 'Dupont', 'Lucas', 28, 1, 1, 90, 57, 51, 67],
        [1, 'Martin', 'Hugo', 25, 4, 2, 65, 64, 58, 56],
        [1, 'Bernard', 'Théo', 27, 5, 2, 93, 84, 55, 87],
        [1, 'Petit', 'Enzo', 23, 8, 3, 77, 52, 51, 55],
        [1, 'Leroy', 'Kylian', 24, 10, 4, 63, 64, 82, 88],
        [1, 'Moreau', 'Antoine', 26, 9, 4, 51, 85, 62, 91],
        [2, 'Garcia', 'Maxime', 29, 1, 1, 94, 84, 76, 64],
        [2, 'Thomas', 'Romain', 24, 3, 2, 78, 87, 67, 50],
        [2, 'Robert', 'Julien', 26, 6, 2, 60, 94, 77, 71],
        [2, 'Richard', 'Nathan', 22, 8, 3, 67, 59, 63, 71],
        [2, 'Simon', 'Alexis', 25, 11, 4, 56, 55, 74, 56],
        [2, 'Laurent', 'Yanis', 23, 9, 4, 72, 72, 88, 66],
        [3, 'Michel', 'Kevin', 30, 1, 1, 52, 79, 84, 57],
        [3, 'Lefebvre', 'Dylan', 25, 2, 2, 74, 55, 85, 68],
        [3, 'Lefevre', 'Samir', 27, 5, 2, 90, 89, 73, 86],
        [3, 'Fontaine', 'Mehdi', 24, 7, 3, 62, 54, 52, 92],
        [3, 'Chevalier', 'Sofiane', 26, 10, 4, 64, 68, 55, 64],
        [3, 'Rousseau', 'Bilal', 22, 9, 4, 56, 74, 67, 79],
        [4, 'Blanc', 'Florian', 27, 1, 1, 90, 73, 60, 73],
        [4, 'Noir', 'Corentin', 23, 4, 2, 72, 63, 92, 67],
        [4, 'Brun', 'Timothe', 25, 5, 2, 94, 93, 91, 54],
        [4, 'Gris', 'Axel', 21, 8, 3, 88, 90, 60, 84],
        [4, 'Beige', 'Luca', 24, 11, 4, 65, 60, 79, 74],
        [4, 'Violet', 'Noa', 22, 9, 4, 67, 90, 94, 85],
    ];
    $stJ = $pdo->prepare('INSERT INTO joueurs (nom, prenom, age, numero, equipe_id, poste_id) VALUES (?, ?, ?, ?, ?, ?)');
    $stC = $pdo->prepare('INSERT INTO competences (joueur_id, vitesse, endurance, force, technique) VALUES (?, ?, ?, ?, ?)');
    foreach ($joueurs as [$eq, $nom, $prenom, $age, $num, $poste, $vit, $end, $for, $tec]) {
        $stJ->execute([$nom, $prenom, $age, $num, $eq, $poste]);
        $stC->execute([(int) $pdo->lastInsertId(), $vit, $end, $for, $tec]);
    }

    $pdo->commit();
}
