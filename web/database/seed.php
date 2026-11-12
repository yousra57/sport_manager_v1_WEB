<?php
function creerSchemaEtDonnees(PDO $pdo): void
{
    $pdo->exec('PRAGMA foreign_keys = OFF');
    foreach (['participer','blessure','affectation','joueurs','poste','matchs','equipe','coach'] as $table) $pdo->exec("DROP TABLE IF EXISTS $table");
    $pdo->exec('PRAGMA foreign_keys = ON');
    $pdo->exec("CREATE TABLE coach(id_coach INTEGER PRIMARY KEY,nom VARCHAR(100) NOT NULL,identifiant VARCHAR(50) NOT NULL UNIQUE,mot_de_passe_hash VARCHAR(255) NOT NULL);
CREATE TABLE equipe(id_equipe INTEGER PRIMARY KEY,nom_equipe VARCHAR(100) NOT NULL,date_creation DATE NOT NULL,couleur VARCHAR(7),couleur_secondaire VARCHAR(7),id_coach INTEGER NOT NULL REFERENCES coach(id_coach));
CREATE TABLE matchs(id_match INTEGER PRIMARY KEY,date_prevue DATETIME NOT NULL,date_match DATETIME,score_dom VARCHAR(50),score_ext VARCHAR(50),status VARCHAR(10) NOT NULL CHECK(status IN ('a_venir','en_cours','termine')),id_equipe INTEGER NOT NULL REFERENCES equipe(id_equipe),id_equipe_1 INTEGER NOT NULL REFERENCES equipe(id_equipe));
CREATE TABLE poste(id_post INTEGER PRIMARY KEY,nom_post VARCHAR(100) NOT NULL);
CREATE TABLE joueurs(id_joueur INTEGER PRIMARY KEY,prenom VARCHAR(100) NOT NULL,nom VARCHAR(100) NOT NULL,age INTEGER,vitesse INTEGER NOT NULL,endurance INTEGER NOT NULL,technique INTEGER NOT NULL,force INTEGER NOT NULL,numero INTEGER,variante_avatar INTEGER,id_post INTEGER NOT NULL REFERENCES poste(id_post));
CREATE TABLE affectation(id_affectation INTEGER PRIMARY KEY,date_debut DATETIME NOT NULL,date_fin DATETIME,id_equipe INTEGER NOT NULL REFERENCES equipe(id_equipe),id_joueur INTEGER NOT NULL REFERENCES joueurs(id_joueur));
CREATE TABLE blessure(id_blessure INTEGER PRIMARY KEY,date_debut DATETIME NOT NULL,date_fin DATETIME,id_joueur INTEGER NOT NULL REFERENCES joueurs(id_joueur));
CREATE TABLE participer(id_joueur INTEGER NOT NULL REFERENCES joueurs(id_joueur),id_match INTEGER NOT NULL REFERENCES matchs(id_match),PRIMARY KEY(id_joueur,id_match));");
    $pdo->beginTransaction();
    $pdo->exec("INSERT INTO coach VALUES(1,'Coach principal','coach','hash'); INSERT INTO equipe VALUES(1,'Paris FC','2024-01-01','#0055A4','#EF4135',1),(2,'Lyon United','2024-01-01','#1E3A8A','#F97316',1),(3,'Marseille City','2024-01-01','#00AEEF','#FFFFFF',1),(4,'Bordeaux FC','2024-01-01','#7F1734','#D4AF37',1); INSERT INTO poste VALUES(1,'Gardien'),(2,'Défenseur'),(3,'Milieu'),(4,'Attaquant');");
    $joueurs=[['Lucas','Dupont',28,90,57,67,51,1],['Hugo','Martin',25,65,64,56,58,2],['Théo','Bernard',27,93,84,87,55,2],['Enzo','Petit',23,77,52,55,51,3],['Kylian','Leroy',24,63,64,88,82,4],['Antoine','Moreau',26,51,85,91,62,4]];
    $st=$pdo->prepare('INSERT INTO joueurs(prenom,nom,age,vitesse,endurance,technique,force,numero,id_post) VALUES(?,?,?,?,?,?,?,?,?)'); $aff=$pdo->prepare('INSERT INTO affectation(date_debut,id_equipe,id_joueur) VALUES(?,?,?)');
    foreach($joueurs as $i=>$j){$st->execute([$j[0],$j[1],$j[2],$j[3],$j[4],$j[5],$j[6],$i+1,$j[7]]);$aff->execute(['2024-01-01',($i%4)+1,$pdo->lastInsertId()]);}
    $pdo->commit();
}
