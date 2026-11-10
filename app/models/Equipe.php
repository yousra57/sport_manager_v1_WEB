<?php

class Equipe
{
    /** Toutes les équipes, avec leur nombre de joueurs. */
    public static function all(): array
    {
        $sql = 'SELECT e.*, COUNT(j.id) AS nb_joueurs
                FROM equipes e
                LEFT JOIN joueurs j ON j.equipe_id = e.id
                GROUP BY e.id
                ORDER BY e.nom';

        return Database::pdo()->query($sql)->fetchAll();
    }

    public static function find(int $id): ?array
    {
        $st = Database::pdo()->prepare('SELECT * FROM equipes WHERE id = ?');
        $st->execute([$id]);

        return $st->fetch() ?: null;
    }
}
