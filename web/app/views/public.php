<header class="public-header">
    <a href="<?= url('public') ?>" class="logo">Sp<i class="fa-solid fa-futbol"></i>rt<span>Manager<span></a>
    <nav class="nav-links">
        <a href="#feature" class="nav-link">Fonctionnalités</a>
        <a href="#web-mobile" class="nav-link">Web & mobile</a>
    </nav>
    <div class="auth-links">
        <a href="<?= url('connexion') ?>" class="public-auth-link cnx">Connexion</a>
        <a href="<?= url('inscription') ?>" class="public-auth-link public-button">inscription</a>
    </div>
</header>

<main class="main-content public-main">
    <section class="hero">
        <section class="hero-content">
            <p class="eyebrow">Le jeu commence dans les coulisses</p>
            <h1>Votre club. <br> <span>Vos choix.</span> Votre saison.</h1>
            <p class="hero-description description">Organisez votre équipe, suivez vos joueurs et gardez les informations de votre club à portée de main.</p>
            <div class="hero-buttons">
                <a href="<?= url('inscription') ?>" class="hero-button public-button">Créer mon compte</a>
                <a href="<?= url('connexion') ?>" class="hero-button sgn-link">J’ai déjà un compte</a>
            </div>
            <div class="proof">
                <i class="fa-solid fa-check"></i>
                <p>Une expérience pensée pour les clubs et leurs entraîneurs</p>
            </div>
        </section>
    </section>
    <section class="feature" id="feature">
        <section class="feature-content">
            <p class="eyebrow">Tout pour votre équipe</p>
            <h2>Le club avance mieux quand tout est organisé.</h2>
            <p class="description">Retrouvez l’essentiel pour gérer votre effectif au quotidien.</p>
        </section>
        <section class="feature-cards">
            <section class="feature-card">
                <h3>Gérez vos équipes</h3>
                <p>Consultez les équipes, leur identité et les informations utiles pour les suivre.</p>
            </section>
            <section class="feature-card">
                <h3>Suivez vos joueurs</h3>
                <p>Retrouvez les profils, les postes et les caractéristiques de chaque joueur.</p>
            </section>
            <section class="feature-card">
                <h3>Organisez vos matchs</h3>
                <p>Créez vos matchs et suivez les résultats</p>
            </section>
            <section class="feature-card">
                <h3>Restez dans le jeu</h3>
                <p>Accédez à Sport Manager depuis le site web ou l’application mobile.</p>
            </section>
        </section>        
    </section>
    <section class="cta" id="web-mobile">
        <p class="eyebrow">Le club vous suit</p>
        <h2>Sur le web.<br>Sur le terrain.</h2>
        <p class="description">Sport Manager réunit le site et l’application mobile autour des mêmes données de club.</p>
        <a href="<?= url('inscription') ?>" class="cta-link">Commencer maintanant!</a>
        <article class="cta-card">
            <div>
                <p class="eyebrow">Prêt à prendre les commandes ?</p>
                <h2>La prochaine saison se prépare maintenant.</h2>
            </div>
            <a href="<?= url('inscription')?>">Rejoindre Sport Manager</a>
        </article>
    </section>
</main>

<footer class="public-footer">
    <p class="ft-logo">Spr<i class="fa-solid fa-futbol"></i>t<span>Manager</span></p>
    <p>Un projet collaboratif de gestion d’équipe sportive.</p>
    <p>© Sport Manager</p>
</footer>