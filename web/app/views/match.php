<section class="match-container">
    <section class="match-head">
        <p class="eyebrow">
            <i class="fa-solid fa-futbol"></i>
            Saison
        </p>
        <h1>Mes matchs</h1>
        <p class="match-intro">Retrouve les résultats du club et lance une simulation entre deux équipes.</p>
    </section>
    <section class="match-stats">
        <article class="match-stat">
            <span class="match-stat-icon total">
                <i class="fa-solid fa-list-check"></i>
            </span>
            <div>
                <p class="match-stat-valeu">04</p>
                <p class="match-stat-title">Matchs joués</p>
            </div>
        </article>
        <article class="match-stat">
            <span class="match-stat-icon win">
                <i class="fa-solid fa-trophy"></i>
            </span>
            <div>
                <p class="match-stat-valeu">14</p>
                <p class="match-stat-title">Victoires</p>
            </div>
        </article>
        <article class="match-stat">
            <span class="match-stat-icon defeat">
                <i class="fa-solid fa-arrow-trend-down"></i>
            </span>
            <div>
                <p class="match-stat-valeu">09</p>
                <p class="match-stat-title">Défaites</p>
            </div>
        </article>
        <article class="match-stat">
            <span class="match-stat-icon null">
                <i class="fa-solid fa-handshake"></i>
            </span>
            <div>
                <p class="match-stat-valeu">00</p>
                <p class="match-stat-title">Matchs nuls</p>
            </div>
        </article>
    </section>
    <section class="match-panel simulator-panel">
        <div class="match-panel-head">
            <span class="match-panel-icon">
                <i class="fa-solid fa-dice"></i>
            </span>
            <div>
                <h2>Simuler un match</h2>
                <p>Choisis les deux équipes pour générer un résultat aléatoire.</p>
            </div>
        </div>
        <form action="#" class="match-form">
            <!-- <div> -->
                <label for="equipe_domicile">
                    Équipe à domicile
                    <select name="equipe_domicile" id="equipe_domicile">
                        <option value="">Sélectionner une équipe</option>
                    </select>
                </label>
            <!-- </div> -->
            <span class="match-versus">VS</span>
            <!-- <div> -->
                <label for="equipe_exterieure">
                    Équipe à l’extérieur
                    <select name="equipe_exterieure" id="equipe_exterieure">
                        <option value="">Sélectionner une équipe</option>
                    </select>
                </label>
            <!-- </div> -->
            <button type="submit" class="match-submit">
                <i class="fa-solid fa-play"></i>
                Lancer la simulation
            </button>
        </form>
        <!-- <?php if ($simulation): ?>
            <div class="match-result" role="status">
                <span><?= e($simulation['domicile']) ?></span>
                <strong><?= (int) $simulation['score_dom'] ?> – <?= (int) $simulation['score_ext'] ?></strong>
                <span><?= e($simulation['exterieur']) ?></span>
                <small>Résultat enregistré dans les derniers matchs.</small>
            </div>
        <?php endif; ?> -->
    </section>
    <section class="match-panel">
        <div class="match-panel-head">
            <span class="match-panel-icon history">
                <i class="fa-solid fa-clock-rotate-left"></i>
            </span>
            <div>
                <h2>Derniers matchs joués</h2>
                <p>Les 8 résultats les plus récents.</p>
            </div>
        </div>
        <div class="match-list">
            <article class="match-row">
                <div class="match-team">
                    <span>JS Kabylee</span>
                    <span>3 - 1</span>
                    <span>US Akbou</span>
                </div>
                <time datetime="#">32/04/105</time>
                <span class="match-badge">Victoire</span>
            </article>
        </div>
    </section>
</section>