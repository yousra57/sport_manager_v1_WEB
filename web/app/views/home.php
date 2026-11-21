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

        <div class="dashboard-ball">
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
            <a href="#" class="dashboard-action therd">
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
                <p class="dashboard-stat-value">4</p>
                <p class="dashboard-stat-title">equipe</p>
            </div>
        </article>
        <article class="dashboard-stat">
            <spam class="dashboard-icon blue">
                <i class="fa-solid fa-people-group"></i>
            </spam>
            <div class="dashboard-stat-content">
                <p class="dashboard-stat-value">32</p>
                <p class="dashboard-stat-title">joueurs</p>
            </div>
        </article>
        <article class="dashboard-stat">
            <spam class="dashboard-icon yellow">
                <i class="fa-solid fa-kit-medical"></i>
            </spam>
            <div class="dashboard-stat-content">
                <p class="dashboard-stat-value">5</p>
                <p class="dashboard-stat-title">Blessés</p>
            </div>
        </article>
        <article class="dashboard-stat">
            <spam class="dashboard-icon orange">
                <i class="fa-solid fa-chess-rook"></i>
            </spam>
            <div class="dashboard-stat-content">
                <p class="dashboard-stat-value">3</p>
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
            <article class="dashboard-equipe">
                <i class="fa-solid fa-shield-halved"></i>
                <div class="dashboard-equipe-content">
                    <p class="dashboard-equipe-title">JSK:Jeunes Kabyle</p>
                    <p class="dashboard-equipe-valeu">13 joueur(s)</p>
                </div>
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
            </article>
        </section>
    </section>
</section>