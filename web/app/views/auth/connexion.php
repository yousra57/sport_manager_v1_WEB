<nav class="cnx-inscr-nav">
    <a href="<?= url('public') ?>">accueil</a>
    <i class="fa-solid fa-greater-than"></i>
    <a href="<?= url('connexion') ?>">connexion</a>
</nav>

<form method="post" action="<?= url('home') ?>" class="auth-form">
    <label for="identifiant">identifiant</label>
    <input type="text" name="identifiant" id="identifiant">
    <label for="password">mot de passe</label>
    <input type="password" name="password" id="password">
    <div class="auth-link-container">
        <a href="<?= url('inscription') ?>" class="auth-link">vous avez pas de compte?</a>
    </div>
    <button type="submit">connexion</button>
</form>