-- Installation neuve : ne migre pas les tables existantes.
CREATE DATABASE IF NOT EXISTS sm_crossplateforme CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE sm_crossplateforme;

CREATE TABLE IF NOT EXISTS coach (
    id_coach INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    identifiant VARCHAR(50) NOT NULL UNIQUE,
    mot_de_passe_hash VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS equipe (
    id_equipe INT AUTO_INCREMENT PRIMARY KEY,
    nom_equipe VARCHAR(100) NOT NULL,
    date_creation DATE NOT NULL,
    couleur VARCHAR(7),
    couleur_secondaire VARCHAR(7),
    id_coach INT NOT NULL,
    FOREIGN KEY (id_coach) REFERENCES coach(id_coach)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS matchs (
    id_match INT AUTO_INCREMENT PRIMARY KEY,
    date_prevue DATETIME NOT NULL,
    date_match DATETIME,
    score_dom TINYINT UNSIGNED,
    score_ext TINYINT UNSIGNED,
    status ENUM('a_venir', 'en_cours', 'termine') NOT NULL,
    id_equipe INT NOT NULL,
    id_equipe_1 INT NOT NULL,
    FOREIGN KEY (id_equipe) REFERENCES equipe(id_equipe),
    FOREIGN KEY (id_equipe_1) REFERENCES equipe(id_equipe)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS poste (
    id_post INT AUTO_INCREMENT PRIMARY KEY,
    nom_post VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS joueur (
    id_joueur INT AUTO_INCREMENT PRIMARY KEY,
    prenom VARCHAR(100) NOT NULL,
    nom VARCHAR(100) NOT NULL,
    age TINYINT UNSIGNED,
    vitesse TINYINT UNSIGNED NOT NULL,
    endurance TINYINT UNSIGNED NOT NULL,
    technique TINYINT UNSIGNED NOT NULL,
    force_physique TINYINT UNSIGNED NOT NULL,
    numero TINYINT UNSIGNED,
    variante_avatar TINYINT UNSIGNED,
    id_post INT NOT NULL,
    FOREIGN KEY (id_post) REFERENCES poste(id_post)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS affectation (
    id_affectation INT AUTO_INCREMENT PRIMARY KEY,
    date_debut DATETIME NOT NULL,
    date_fin DATETIME,
    id_equipe INT NOT NULL,
    id_joueur INT NOT NULL,
    FOREIGN KEY (id_equipe) REFERENCES equipe(id_equipe),
    FOREIGN KEY (id_joueur) REFERENCES joueur(id_joueur)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS blessure (
    id_blessure INT AUTO_INCREMENT PRIMARY KEY,
    date_debut DATETIME NOT NULL,
    date_fin DATETIME,
    id_joueur INT NOT NULL,
    FOREIGN KEY (id_joueur) REFERENCES joueur(id_joueur)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS participer (
    id_joueur INT NOT NULL,
    id_match INT NOT NULL,
    PRIMARY KEY (id_joueur, id_match),
    FOREIGN KEY (id_joueur) REFERENCES joueur(id_joueur),
    FOREIGN KEY (id_match) REFERENCES matchs(id_match)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
