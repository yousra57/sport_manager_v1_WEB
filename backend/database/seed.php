<?php

// Depuis la racine : php backend/database/seed.php
if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit;
}

require_once __DIR__ . '/../bootstrap.php';

$pdo = Database::pdo();

// Ne jamais effacer ni compléter implicitement une base déjà utilisée.
foreach (['coach', 'equipe', 'poste', 'joueur', 'affectation', 'blessure', 'matchs', 'participer'] as $table) {
    if ((int) $pdo->query("SELECT COUNT(*) FROM " . $table)->fetchColumn() > 0) {
        fwrite(STDERR, "Import annulé : la table $table contient déjà des données.\n");
        exit(1);
    }
}

$pdo->beginTransaction();
try {
    $coach = $pdo->prepare('INSERT INTO coach (nom, identifiant, mot_de_passe_hash) VALUES (?, ?, ?)');
    $coach->execute(['Coach principal', 'coach', password_hash(bin2hex(random_bytes(16)), PASSWORD_DEFAULT)]);
    $coachId = (int) $pdo->lastInsertId();

    $equipe = $pdo->prepare('INSERT INTO equipe (nom_equipe, date_creation, couleur, couleur_secondaire, id_coach) VALUES (?, ?, ?, ?, ?)');
    $equipes = [];
    foreach ([
        ['Paris FC', '#0055A4', '#EF4135'],
        ['Lyon United', '#1E3A8A', '#F97316'],
        ['Marseille City', '#00AEEF', '#FFFFFF'],
        ['Bordeaux FC', '#7F1734', '#D4AF37'],
    ] as [$nom, $couleur, $secondaire]) {
        $equipe->execute([$nom, '2024-01-01', $couleur, $secondaire, $coachId]);
        $equipes[] = (int) $pdo->lastInsertId();
    }

    $poste = $pdo->prepare('INSERT INTO poste (nom_post) VALUES (?)');
    $postes = [];
    foreach (['Gardien', 'Défenseur', 'Milieu', 'Attaquant'] as $nom) {
        $poste->execute([$nom]);
        $postes[] = (int) $pdo->lastInsertId();
    }

    $joueur = $pdo->prepare('INSERT INTO joueur (prenom, nom, age, vitesse, endurance, technique, force_physique, numero, id_post) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $affectation = $pdo->prepare('INSERT INTO affectation (date_debut, id_equipe, id_joueur) VALUES (?, ?, ?)');
    $donnees = [
        ['Lucas', 'Dupont', 28, 90, 57, 67, 51, 0],
        ['Hugo', 'Martin', 25, 65, 64, 56, 58, 1],
        ['Théo', 'Bernard', 27, 93, 84, 87, 55, 1],
        ['Enzo', 'Petit', 23, 77, 52, 55, 51, 2],
        ['Kylian', 'Leroy', 24, 63, 64, 88, 82, 3],
        ['Antoine', 'Moreau', 26, 51, 85, 91, 62, 3],
    ];
    foreach ($donnees as $i => $j) {
        $joueur->execute([$j[0], $j[1], $j[2], $j[3], $j[4], $j[5], $j[6], $i + 1, $postes[$j[7]]]);
        $joueurId = (int) $pdo->lastInsertId();
        $affectation->execute(['2024-01-01', $equipes[$i % count($equipes)], $joueurId]);
    }

    $pdo->commit();
    echo "Données de démonstration ajoutées : 4 équipes, 6 joueurs, 4 postes.\n";
} catch (Throwable $exception) {
    $pdo->rollBack();
    throw $exception;
}
