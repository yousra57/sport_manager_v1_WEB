<?php

// Charge la connexion MariaDB et les modèles Equipe/Joueur partagés avec le site.
require_once __DIR__ . '/../../backend/bootstrap.php';

// L'API renvoie des données JSON, pas une page HTML.
header('Content-Type: application/json; charset=utf-8');

// Exemple : /api/joueur/1?test=oui donne uniquement /api/joueur/1.
$chemin = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Le routeur choisit le traitement en fonction de l'adresse demandée.
switch ($chemin) {
    case '/api/equipes':
        // all() exécute la requête SQL qui récupère toutes les équipes.
        $donnees = Equipe::all();
        break;

    case '/api/joueurs':
        // Même principe pour la liste complète des joueurs.
        $donnees = Joueur::all();
        break;

    default:
        // Les détails ont une adresse variable : on reconnaît le chemin et son nombre.
        // Les parenthèses ([0-9]+) placent ce nombre dans $correspondances[1].
        if (preg_match('#^/api/equipe/([0-9]+)$#', $chemin, $correspondances)) {
            // L'identifiant doit être un entier supérieur à zéro.
            $id = filter_var($correspondances[1], FILTER_VALIDATE_INT, [
                'options' => ['min_range' => 1],
            ]);

            if ($id === false) {
                // 400 = la valeur fournie dans la demande est invalide.
                http_response_code(400);
                $donnees = ['erreur' => 'Identifiant équipe invalide'];
                break;
            }

            // find() cherche en BDD avec id_equipe = $id.
            $equipe = Equipe::find($id);

            if ($equipe === null) {
                // 404 = l'identifiant est valide, mais aucune équipe ne correspond.
                http_response_code(404);
                $donnees = ['erreur' => 'Équipe introuvable'];
                break;
            }

            // Le mobile reçoit les informations de l'équipe ET son effectif.
            $donnees = [
                'equipe' => $equipe,
                'joueurs' => Joueur::byEquipe($id),
            ];
        } elseif (preg_match('#^/api/joueur/([0-9]+)$#', $chemin, $correspondances)) {
            // Exemple : /api/joueur/1 utilise la clé id_joueur = 1.
            $id = filter_var($correspondances[1], FILTER_VALIDATE_INT, [
                'options' => ['min_range' => 1],
            ]);

            if ($id === false) {
                http_response_code(400);
                $donnees = ['erreur' => 'Identifiant joueur invalide'];
                break;
            }

            // Le modèle récupère aussi le poste, les caractéristiques et l'état de blessure.
            $joueur = Joueur::find($id);

            if ($joueur === null) {
                http_response_code(404);
                $donnees = ['erreur' => 'Joueur introuvable'];
                break;
            }

            // Un joueur peut ne pas avoir d'équipe : dans ce cas, on renvoie null.
            $equipe = $joueur['equipe_id'] !== null
                ? Equipe::find((int) $joueur['equipe_id'])
                : null;

            $donnees = [
                'joueur' => $joueur,
                'equipe' => $equipe,
            ];
        } else {
            // Aucune des quatre routes ne correspond à l'adresse demandée.
            http_response_code(404);
            $donnees = ['erreur' => 'Adresse inconnue'];
        }
        break;
}

// Transforme le tableau PHP en JSON. Les accents restent directement lisibles.
// Sans erreur, PHP conserve le code HTTP 200 (succès).
echo json_encode($donnees, JSON_UNESCAPED_UNICODE);
