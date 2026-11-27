<section class="all-container dashboard-container">
    <section class="dashboard-hero">
        <div>
            <p class="eyebrow">
                <i class="fa-solid fa-chart-line"></i>
                Espace coach
            </p>
            <h1 class="dashboard-title">Bonjour, coach&nbsp;!</h1>
            <p class="dashboard-description">Voici le résumé de votre club. Retrouvez rapidement vos équipes et votre effectif.</p>
        </div>

        <div class="dashboard-ball animate__animated animate__lightSpeedInRight">
            <i class="fa-solid fa-futbol"></i>
        </div>

        <section class="dashboard-actions">
            <a href="<?= url('joueurs')?>" class="dashboard-action first">
                <i class="fa-solid fa-user-plus"></i>
                Ajouter un joueur
            </a>
            <a href="<?= url('equipes')?>" class="dashboard-action second">
                <i class="fa-solid fa-shield-halved"></i>
                Créer une équipe
            </a>
            <a href="<?= e(url('match')) ?>#simuler-match" class="dashboard-action therd">
                <i class="fa-solid fa-dice"></i>
                Simuler un match
            </a>
        </section>
    </section>
    <section class="dashboard-stats">
        <article class="dashboard-stat">
            <spam class="dashboard-icon red">
                <i class="fa-solid fa-shield-halved"></i>
            </spam>
            <div class="dashboard-stat-content">
                <p class="dashboard-stat-value"><?= e($nombreEquipes) ?></p>
                <p class="dashboard-stat-title">equipe</p>
            </div>
        </article>
        <article class="dashboard-stat">
            <spam class="dashboard-icon blue">
                <i class="fa-solid fa-people-group"></i>
            </spam>
            <div class="dashboard-stat-content">
                <p class="dashboard-stat-value"><?= e($nombreJoueurs) ?></p>
                <p class="dashboard-stat-title">joueurs</p>
            </div>
        </article>
        <article class="dashboard-stat">
            <spam class="dashboard-icon yellow">
                <i class="fa-solid fa-kit-medical"></i>
            </spam>
            <div class="dashboard-stat-content">
                <p class="dashboard-stat-value"><?= e($nombreBlesses) ?></p>
                <p class="dashboard-stat-title">Blessés</p>
            </div>
        </article>
        <article class="dashboard-stat">
            <spam class="dashboard-icon orange">
                <i class="fa-solid fa-chess-rook"></i>
            </spam>
            <div class="dashboard-stat-content">
                <p class="dashboard-stat-value"><?= e($nombreMatchs) ?></p>
                <p class="dashboard-stat-title">match joue</p>
            </div>
        </article>
    </section>
    <section class="dashboard-resume">
        <section class="dashboard-equipes">
            <div class="dashboard-equipes-header">
                <i class="fa-solid fa-chevron-right"></i>   
                <h2>
                    <a class="dashboard-title-link" href="<?= url('equipes') ?>">mes equipes</a>
                </h2>
            </div>
            <?php foreach ($dernieresEquipes as $equipe): ?>
            <article class="dashboard-equipe">
                <i class="fa-solid fa-shield-halved"></i>
                <div class="dashboard-equipe-content">
                    <p class="dashboard-equipe-title"><?= e($equipe['nom_equipe']) ?></p>
                    <p class="dashboard-equipe-valeu"><?= e($equipe['nb_joueurs']) ?> joueur(s)</p>
                </div>
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
            </article>
            <?php endforeach ?>
        </section>
        <!-- une autre section avec le titre historique des match,
             une list des matche jouer avec just les nom des deux equipe A vs B et un mesage gange ou perdu -->
        <!-- une autre section avec la liste des derniers joueurs blesses, le nom le prenom le post lequipe et la date de blesseur-->
    </section>
</section>