<?php
// Requêtes SQL sur les joueurs
class Joueur
{
    private const SELECT = 'SELECT j.*, j.id_joueur AS id,
                                   e.id_equipe AS equipe_id,
                                   e.nom_equipe AS equipe_nom,
                                   p.nom_post AS poste_nom,
                                   NULL AS poste_description,
                                   j.force_physique AS `force`,
                                   EXISTS (SELECT 1 FROM blessure b
                                           WHERE b.id_joueur = j.id_joueur AND b.date_fin IS NULL) AS est_blesse
                            FROM joueur j
                            JOIN poste p ON p.id_post = j.id_post
                            LEFT JOIN affectation a ON a.id_joueur = j.id_joueur AND a.date_fin IS NULL
                            LEFT JOIN equipe e ON e.id_equipe = a.id_equipe';

    /** Récupère tous les joueurs (avec équipe et poste). */
    public static function all(): array
    {
        return Database::pdo()
            ->query(self::SELECT . ' ORDER BY e.nom_equipe, j.numero')
            ->fetchAll();
    }

    /** Récupère les joueurs d'une équipe. */
    public static function byEquipe(int $equipeId): array
    {
        $st = Database::pdo()->prepare(self::SELECT . ' WHERE e.id_equipe = ? ORDER BY j.numero');
        $st->execute([$equipeId]);

        return $st->fetchAll();
    }

    /** Récupère un joueur avec son équipe, son poste et ses compétences. */
    public static function find(int $id): ?array
    {
        $st = Database::pdo()->prepare(self::SELECT . ' WHERE j.id_joueur = ?');
        $st->execute([$id]);

        return $st->fetch() ?: null;
    }
}
