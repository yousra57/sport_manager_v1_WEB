<?php

class Matchs
{
    public static function tousLesMatchs(): array
    {
        $sql = "SELECT m.*, dom.nom_equipe AS equipe_domicile, ext.nom_equipe AS equipe_exterieure
                FROM matchs m
                JOIN equipe dom ON dom.id_equipe = m.id_equipe
                JOIN equipe ext ON ext.id_equipe = m.id_equipe_1
                WHERE m.status = 'termine'
                ORDER BY m.date_match DESC, m.id_match DESC";
        return Database::pdo()->query($sql)->fetchAll();
    }

    public static function reinitialiserMatchs(): void
    {
        $pdo = Database::pdo();
        $pdo->beginTransaction();
        try {
            $pdo->exec('DELETE FROM participer');
            $pdo->exec('DELETE FROM matchs');
            $pdo->commit();
        } catch (Throwable $erreur) {
            $pdo->rollBack();
            throw $erreur;
        }
    }

    public static function supprimerMatchsSelectionnes(array $ids): void
    {
        $ids = array_values(array_unique(array_filter(array_map('intval', $ids), static fn(int $id): bool => $id > 0)));
        if ($ids === []) {
            return;
        }

        $pdo = Database::pdo();
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("DELETE FROM participer WHERE id_match IN ($placeholders)");
            $stmt->execute($ids);
            $stmt = $pdo->prepare("DELETE FROM matchs WHERE id_match IN ($placeholders) AND status = 'termine'");
            $stmt->execute($ids);
            $pdo->commit();
        } catch (Throwable $erreur) {
            $pdo->rollBack();
            throw $erreur;
        }
    }

    // recupere le nombre des matchs joue
    public static function countMatch(): int
    {
        $sql = "SELECT COUNT(*) FROM matchs WHERE status = 'termine'";
        return (int) Database::pdo()->query($sql)->fetchColumn();
    }

    // recupere le nombre des matchs nuls
    public static function matchNuls(): int
    {
        $sql = "SELECT COUNT(*) FROM matchs WHERE status = 'termine' AND score_dom = score_ext";
        return (int) Database::pdo()->query($sql)->fetchColumn();
    }
    
    // recupere le nombre des matchs gagne
    public static function matchGagne(): int
    {
        $sql = "SELECT COUNT(*) FROM matchs WHERE status = 'termine' AND score_dom > score_ext";
        return (int) Database::pdo()->query($sql)->fetchColumn();
    }
    
    // recupere le nombre des matchs perdu
    public static function matchPerdu(): int
    {
        $sql = "SELECT COUNT(*) FROM matchs WHERE status = 'termine' AND score_dom < score_ext";
        return (int) Database::pdo()->query($sql)->fetchColumn();
    }

    // recupere les 4 dernier match joue
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

    // pour la simulation d'un match
    public static function matchSimul(int $idDomicile, int $idExterieur): array
    {
        if ($idDomicile === $idExterieur){
            throw new InvalidArgumentException('choisir deux equipes differente');
        }

        $scoreDomicile = random_int(0, 9);
        $scoreExterieur = random_int(0,9);
        $maintenant = date('Y-m-d H:i:s');

        $sql = 'INSERT INTO matchs 
        (date_prevue, date_match, score_dom, score_ext, status, id_equipe, id_equipe_1)
        VALUES (?,?,?,?,?,?,?)';

        $stmt = Database::pdo()->prepare($sql);
        $stmt->execute([
            $maintenant,
            $maintenant,
            $scoreDomicile,
            $scoreExterieur,
            'termine',
            $idDomicile,
            $idExterieur,
        ]);

        return [
            'score_dom' => $scoreDomicile,
            'score_ext' => $scoreExterieur,
        ];
    }

}
