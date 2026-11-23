<?php
// Variables disponibles : $titre, $contenu
$courante = $_GET['p'] ?? 'public';
$menu = [
    'home' => ['Accueil', ['home']],
    'match' => ['Match', ['match']],
    'equipes' => ['Équipes', ['equipes', 'equipe']],
    'joueurs' => ['Joueurs', ['joueurs', 'joueur']],
    'profil' => ['Profil', ['profil']],
];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($titre) ?> – Sport Manager</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<?php if (!in_array($courante, ['connexion', 'inscription', 'public'], true)): ?>
<header class="site-header">
    <div class="wrap">
        <a class="logo" href="<?= url('home') ?>">Sport Manager</a>
        <nav>
            <?php foreach ($menu as $page => [$libelle, $pages]): ?>
                <a href="<?= url($page) ?>" class="<?= in_array($courante, $pages, true) ? 'actif' : '' ?>"><?= e($libelle) ?></a>
            <?php endforeach; ?>
            <div class="bouton-deconnexion">
                <a href="<?= url('public') ?>">Déconnexion</a>
            </div>
        </nav>
    </div>
</header>
<?php endif; ?>

<main class="wrap">
    <?= $contenu ?>
</main>
</body>
</html>
