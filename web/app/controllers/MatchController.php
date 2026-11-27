<?php
class MatchController
{
    public function liste(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';
            if ($action === 'reinitialiser') {
                Matchs::reinitialiserMatchs();
            } elseif ($action === 'supprimer_selection') {
                $ids = $_POST['matchs'] ?? [];
                Matchs::supprimerMatchsSelectionnes(is_array($ids) ? $ids : []);
            }

            header('Location: ' . url('listMatch'));
            exit;
        }

        render('matchs/listMatchs', [
            'titre' => 'Liste des matchs',
            'matchs' => Matchs::tousLesMatchs(),
        ]);
    }

    public function index(): void
    {
        $matchSimulature = null;
        $listDesEquipe = Equipe::all();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idDomicile = (int) ($_POST['equipe_domicile'] ?? 0);
            $idExterieur = (int) ($_POST['equipe_exterieure'] ?? 0);

            if ($idDomicile > 0 && $idExterieur > 0) {
                $matchSimulature = Matchs::matchSimul($idDomicile, $idExterieur);
                
                foreach ($listDesEquipe as $equipe) {
                    if ((int) $equipe['id_equipe'] === $idDomicile) {
                        $matchSimulature['equipe_domicile'] = $equipe['nom_equipe'];
                    }
                    if ((int) $equipe['id_equipe'] === $idExterieur) {
                        $matchSimulature['equipe_exterieure'] = $equipe['nom_equipe'];
                    }
                }
            }
        }
        render('matchs/index', [
            'titre' => 'matchs',
            'nombreMatchs' => Matchs::countMatch(),
            'nombreMatchsNuls' => Matchs::matchNuls(),
            'nombreMatchsGagne' => Matchs::matchGagne(),
            'nombreMatchsPerdu' => Matchs::matchPerdu(),
            'derniersMatchs' => Matchs::latestMatchs(),
            'listDesEquipe' => $listDesEquipe,
            'matchSimulature' => $matchSimulature,
        ]);
    }
}
