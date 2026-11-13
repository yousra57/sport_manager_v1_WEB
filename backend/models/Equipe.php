<?php
// Requêtes SQL sur les équipes
class Equipe
{
    /** Récupère toutes les équipes, avec leur nombre de joueurs. */
    public static function all(): array
    {
        $sql = 'SELECT e.*, e.id_equipe AS id, e.nom_equipe AS nom, c.nom AS coach_nom,
                       (SELECT COUNT(DISTINCT a.id_joueur) FROM affectation a
                        WHERE a.id_equipe = e.id_equipe AND a.date_fin IS NULL) AS nb_joueurs
                FROM equipe e
                LEFT JOIN coach c ON c.id_coach = e.id_coach
                ORDER BY e.nom_equipe';

        return Database::pdo()->query($sql)->fetchAll();
    }

    // fonction pour récupérer une équipe précise
    public static function find(int $id): ?array
    {
        $st = Database::pdo()->prepare('SELECT e.*, e.id_equipe AS id, e.nom_equipe AS nom, c.nom AS coach_nom FROM equipe e JOIN coach c ON c.id_coach = e.id_coach WHERE e.id_equipe = ?');
        $st->execute([$id]);

        return $st->fetch() ?: null;
    }
}
