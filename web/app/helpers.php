<?php

/** Échappe une valeur avant de l'afficher (protection XSS). */
function e(mixed $valeur): string
{
    return htmlspecialchars((string) $valeur, ENT_QUOTES, 'UTF-8');
}

/** Construit une URL du site : url('equipe', ['id' => 3]) => index.php?p=equipe&id=3 */
function url(string $page, array $params = []): string
{
    return 'index.php?' . http_build_query(['p' => $page] + $params);
}

function argent(int|float $montant): string
{
    return number_format($montant, 0, ',', ' ') . ' €';
}

/**
 * Affiche une vue dans le layout commun.
 * $vue : chemin relatif dans app/views (ex: 'equipes/index')
 * $donnees : variables rendues disponibles dans la vue
 */
function render(string $vue, array $donnees = []): void
{
    extract($donnees);

    ob_start();
    require WEB_PATH . '/app/views/' . $vue . '.php';
    $contenu = ob_get_clean();

    require WEB_PATH . '/app/views/layout.php';
}

function notFound(string $message = 'Page introuvable.'): void
{
    http_response_code(404);
    render('404', ['titre' => 'Introuvable', 'message' => $message]);
}
