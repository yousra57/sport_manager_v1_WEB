<?php

class Joueur
{
    private const SELECT = 'SELECT j.*,
                                   e.nom AS equipe_nom,
                                   p.nom AS poste_nom,
                                   p.description AS poste_description,
                                   c.vitesse, c.endurance, c.force, c.technique
                            FROM joueurs j
                            JOIN equipes e ON e.id = j.equipe_id
                            JOIN postes p ON p.id = j.poste_id
                            LEFT JOIN competences c ON c.joueur_id = j.id';

    /** Tous les joueurs (avec équipe et poste). */
    public static function all(): array
    {
        return Database::pdo()
            ->query(self::SELECT . ' ORDER BY e.nom, j.numero')
            ->fetchAll();
    }

    /** Les joueurs d'une équipe. */
    public static function byEquipe(int $equipeId): array
    {
        $st = Database::pdo()->prepare(self::SELECT . ' WHERE j.equipe_id = ? ORDER BY j.numero');
        $st->execute([$equipeId]);

        return $st->fetchAll();
    }

    /** Un joueur avec son équipe, son poste et ses compétences. */
    public static function find(int $id): ?array
    {
        $st = Database::pdo()->prepare(self::SELECT . ' WHERE j.id = ?');
        $st->execute([$id]);

        return $st->fetch() ?: null;
    }
}
