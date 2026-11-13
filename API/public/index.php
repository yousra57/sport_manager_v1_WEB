<?php
declare(strict_types=1);


// les réponses de notre API seront au format JSON
header('Content-Type: application/json; charset=utf-8');

// Autorisations utiles pour les tests et les futurs échanges avec Flutter
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Fonction qui renvoie une réponse JSON avec son code HTTP
function reponseJson(int $code, array $donnees): void
{
    http_response_code($code);

    echo json_encode(
        $donnees,
        JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
    );

    exit;
}

// Gestion des requêtes OPTIONS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

// Récupère la méthode HTTP (GET, POST...)
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    header('Allow: GET, OPTIONS');
    reponseJson(405, [
        'success' => false,
        'message' => 'Méthode non autorisée'
    ]);
}

// Récupération de l'URL demandée
$chemin = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$chemin = rtrim($chemin, '/') ?: '/';

try {

    // chargement de la connexion et des modèles existants
    require_once dirname(__DIR__, 2) . '/backend/bootstrap.php';

    // 1. Récupérer toutes les équipes
    if ($chemin === '/api/equipes') {

        $equipes = Equipe::all();

        reponseJson(200, [
            'success' => true,
            'data' => $equipes
        ]);
    }

    // 2. Récupérer tous les joueurs
    if ($chemin === '/api/joueurs') {

        $joueurs = Joueur::all();

        reponseJson(200, [
            'success' => true,
            'data' => $joueurs
        ]);
    }

    // 3. Récupérer une équipe avec ses joueurs
    if (preg_match('#^/api/equipe/([1-9][0-9]*)$#', $chemin, $matches)) {

        $id = (int) $matches[1];

        $equipe = Equipe::find($id);

        if ($equipe === null) {
            reponseJson(404, [
                'success' => false,
                'message' => 'Équipe introuvable'
            ]);
        }

        $equipe['joueurs'] = Joueur::byEquipe($id);

        reponseJson(200, [
            'success' => true,
            'data' => $equipe
        ]);
    }

    // 4. Récupérer un joueur précis
    if (preg_match('#^/api/joueur/([1-9][0-9]*)$#', $chemin, $matches)) {

        $id = (int) $matches[1];

        $joueur = Joueur::find($id);

        if ($joueur === null) {
            reponseJson(404, [
                'success' => false,
                'message' => 'Joueur introuvable'
            ]);
        }

        reponseJson(200, [
            'success' => true,
            'data' => $joueur
        ]);
    }

    // Aucune route correspondante
    reponseJson(404, [
        'success' => false,
        'message' => 'Endpoint introuvable'
    ]);

} catch (Throwable $erreur) {

    // On conserve le détail technique dans les logs du serveur
    error_log($erreur->getMessage());

    reponseJson(500, [
        'success' => false,
        'message' => 'Erreur interne du serveur'
    ]);
}
