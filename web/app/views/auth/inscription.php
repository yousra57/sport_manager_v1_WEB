<nav class="cnx-inscr-nav">
    <a href="<?= url('public') ?>">accueil</a>
    <i class="fa-solid fa-greater-than"></i>
    <a href="<?= url('inscription') ?>">inscription</a>
</nav>

<form method="post" action="<?= url('home') ?>" class="auth-form">
    <label for="name">nom</label>
    <input type="text" name="name" id="name">
    <label for="identifiant">identifiant</label>
    <input type="text" name="identifiant" id="identifiant">
    <label for="password">mot de passe</label>
    <input type="password" name="password" id="password">
    <label for="confirm_password">confirmer mot de passe</label>
    <input type="password" name="confirm_password" id="confirm_password">
    <div class="auth-link-container">
        <a href="<?= url('connexion') ?>" class="auth-link">vous avez deja un compte?</a>
    </div>
    <button type="submit">inscription</button>
</form>
