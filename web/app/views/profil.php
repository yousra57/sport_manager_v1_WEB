<section class="profil-container">
    <div class="retour">
        <i class="fa-solid fa-chevron-left"></i>
        <a href="<?= url('home') ?>" class="retour-link">retour à l'accueil</a>
    </div>
    <section class="profil-entete">
        <p class="discrep">Espace personnel</p>
        <h1>Mon profil</h1>
        <p class="chapo">Consultez vos informations de compte.</p>
    </section>
    <section class="profil-section">
        <div class="profil-titer-descrip">
            <div>
                <h2 class="profil-infos-titre">Informations personnelles</h2>
                <p class="profil-infos-description">Les informations du compte connecté apparaîtront ici.</p>
            </div>
            <span class="profil-badge">
                <i class="fa-solid fa-user-tie"></i>
                Coach
            </span>
        </div>
        <dl class="profil-infos">
            <div>
                <dt>Nom</dt>
                <dd>Coach Choac</dd>
            </div>
            <div>
                <dt>Identifient</dt>
                <dd>mr.coachman</dd>
            </div>
        </dl>
    </section>
    <section class="profil-section">
        <h2 class="profil-stats-titre">Résumé du club</h2>
        <p class="profil-stats-description">Effectifs enregistrés dans Sport Manager.</p>
        <dl class="profil-stats">
            <div>
                <dt>Équipes</dt>
                <dd><?= e($nombreEquipes) ?></dd>
            </div>
            <div>
                <dt>Joueurs</dt>
                <dd><?= e($nombreJoueurs) ?></dd>
            </div>
            <div>
                <dt>Joueurs blessés</dt>
                <dd><?= e($nombreBlesses) ?></dd>
            </div>
        </dl>
    </section>
    <section class="profil-section">
        <h2 class="profil-action-titre">Actions du compte</h2>
        <p class="profil-action-description">Gérez votre session et votre compte.</p>
        <div class="profil-action-link logout">
            <div>
                <h3>Déconnexion</h3>
                <p>Fermer votre session sur cet appareil.</p>
            </div>
            <a href="<?= url('public') ?>" class="profil-bouton">Se déconnecter</a>
        </div>
        <div class="profil-action-link update">
            <div>
                <h3>Modifier les informations du compte</h3>
                <p>Mettez à jour les informations personnelles de votre compte</p>
            </div>
            <button class="profil-bouton" type="button" disabled>Modifier</button>
        </div>
        <div class="profil-action-link restart">
            <div>
                <h3>Réinitialiser mon compte</h3>
                <p>Supprimez les données du compte pour repartir de zéro et recommencer une nouvelle partie.</p>
            </div>
            <button class="profil-bouton" type="button" disabled>Réinitialiser</button>
        </div>
        <div class="profil-action-link suppression">
            <div>
                <h3>Supprimer le compte</h3>
                <p>Si vous supprimez votre compte, il n'y a généralement pas de retour en arrière</p>
            </div>
            <button class="profil-bouton" type="button" disabled>Supprimer</button>
        </div>
    </section>
</section>