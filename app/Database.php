<?php

class Database
{
    private static ?PDO $pdo = null;

    public static function pdo(): PDO
    {
        if (self::$pdo === null) {
            if (!is_dir(dirname(DB_PATH))) {
                mkdir(dirname(DB_PATH), 0775, true);
            }

            $pdo = new PDO('sqlite:' . DB_PATH);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $pdo->exec('PRAGMA foreign_keys = ON');

            // Première exécution : on crée les tables et on charge le jeu de données.
            $existe = $pdo->query("SELECT name FROM sqlite_master WHERE type = 'table' AND name = 'equipes'")->fetch();
            if (!$existe) {
                require_once ROOT_PATH . '/database/seed.php';
                creerSchemaEtDonnees($pdo);
            }

            self::$pdo = $pdo;
        }

        return self::$pdo;
    }
}
