<?php
// Contrôleur frontal : toutes les pages passent par ici (index.php?p=...).

require __DIR__ . '/../app/bootstrap.php';

$page = $_GET['p'] ?? 'public';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) ?: null;

switch ($page) {
    case 'public':
        render('public', ['titre' => 'Accueil']);
        break;
    case 'home':
        render('home', ['titre' => 'Accueil']);
        break;
    case 'profil':
        render('profil', ['titre' => 'Profil']);
        break;
    case 'match':
        render('match', ['titre' => 'Matchs']);
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
    case 'inscription':
        render('auth/inscription', ['titre' => 'inscription']);
        break;
    case 'connexion':
        render('auth/connexion', ['titre' => 'connexion']);
        break;
    default:
        notFound();
}
