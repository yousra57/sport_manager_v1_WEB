<?php

class Matchs
{
    public static function countMatch(): int
    {
        $sql = "SELECT COUNT(*) FROM matchs WHERE status = 'termine'";
        return (int) Database::pdo()->query($sql)->fetchColumn();
    }

    public static function matchNuls(): int
    {
        $sql = "SELECT COUNT(*) FROM matchs WHERE status = 'termine' AND score_dom = score_ext";
        return (int) Database::pdo()->query($sql)->fetchColumn();
    }
    
    public static function matchGagne(): int
    {
        $sql = "SELECT COUNT(*) FROM matchs WHERE status = 'termine' AND score_dom > score_ext";
        return (int) Database::pdo()->query($sql)->fetchColumn();
    }
    
    public static function matchPerdu(): int
    {
        $sql = "SELECT COUNT(*) FROM matchs WHERE status = 'termine' AND score_dom < score_ext";
        return (int) Database::pdo()->query($sql)->fetchColumn();
    }

    public static function latestMatchs(): array
    {
        $sql = "SELECT m.*, dom.nom_equipe AS equipe_domicile, ext.nom_equipe AS equipe_exterieure 
                FROM matchs m 
                JOIN equipe dom ON dom.id_equipe = m.id_equipe
                JOIN equipe ext ON ext.id_equipe = m.id_equipe_1
                WHERE status = 'termine' 
                ORDER BY date_match DESC, id_match DESC 
                LIMIT 4";
        return Database::pdo()->query($sql)->fetchAll();
    }



}