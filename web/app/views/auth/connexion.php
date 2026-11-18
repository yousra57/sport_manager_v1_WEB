<h1>connexion</h1>

<form action="" class="auth-form">
    <label for="identifiant">identifiant</label>
    <input type="text" name="identifiant" id="identifiant">
    <label for="password">mot de passe</label>
    <input type="password" name="password" id="password">
    <div class="auth-link-container">
        <a href="<?= url('inscription') ?>" class="auth-link">vous avez pas de compte?</a>
    </div>
    <button type="submit">connexion</button>
</form>