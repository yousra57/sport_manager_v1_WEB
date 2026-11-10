<?php
// Variables disponibles : $titre, $contenu
$courante = $_GET['p'] ?? 'debrief';
$menu = [
    'debrief' => ['Débrief', ['debrief']],
    'equipes' => ['Équipes', ['equipes', 'equipe']],
    'joueurs' => ['Joueurs', ['joueurs', 'joueur']],
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($titre) ?> – Sport Manager</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="site-header">
    <div class="wrap">
        <a class="logo" href="<?= url('debrief') ?>">Sport Manager</a>
        <nav>
            <?php foreach ($menu as $page => [$libelle, $pages]): ?>
                <a href="<?= url($page) ?>" class="<?= in_array($courante, $pages, true) ? 'actif' : '' ?>"><?= e($libelle) ?></a>
            <?php endforeach; ?>
        </nav>
    </div>
</header>

<main class="wrap">
    <?= $contenu ?>
</main>
</body>
</html>
