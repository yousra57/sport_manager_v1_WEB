<?php
// Contrôleur frontal : toutes les pages passent par ici (index.php?p=...).

require __DIR__ . '/../app/bootstrap.php';

$page = $_GET['p'] ?? 'debrief';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) ?: null;

switch ($page) {
    case 'debrief':
        (new HomeController())->index();
        break;
    case 'equipes':
        (new EquipeController())->index();
        break;
    case 'equipe':
        (new EquipeController())->show($id);
        break;
    case 'joueurs':
        (new JoueurController())->index();
        break;
    case 'joueur':
        (new JoueurController())->show($id);
        break;
    default:
        notFound();
}
