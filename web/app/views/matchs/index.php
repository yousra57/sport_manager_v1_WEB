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
                <p class="match-stat-valeu"><?= e($nombreMatchs) ?></p>
                <p class="match-stat-title">Matchs joués</p>
            </div>
        </article>
        <article class="match-stat">
            <span class="match-stat-icon win">
                <i class="fa-solid fa-trophy"></i>
            </span>
            <div>
                <p class="match-stat-valeu"><?= e($nombreMatchsGagne) ?></p>
                <p class="match-stat-title">Victoires</p>
            </div>
        </article>
        <article class="match-stat">
            <span class="match-stat-icon defeat">
                <i class="fa-solid fa-arrow-trend-down"></i>
            </span>
            <div>
                <p class="match-stat-valeu"><?= e($nombreMatchsPerdu) ?></p>
                <p class="match-stat-title">Défaites</p>
            </div>
        </article>
        <article class="match-stat">
            <span class="match-stat-icon null">
                <i class="fa-solid fa-handshake"></i>
            </span>
            <div>
                <p class="match-stat-valeu"><?= e($nombreMatchsNuls) ?></p>
                <p class="match-stat-title">Matchs nuls</p>
            </div>
        </article>
    </section>
    <section class="match-panel simulator-panel">
        <div class="match-panel-head">
            <span class="match-panel-icon">
                <i class="fa-solid fa-dice animate__animated animate__jello"></i>
            </span>
            <div>
                <h2>Simuler un match</h2>
                <p>Choisis les deux équipes pour générer un résultat aléatoire.</p>
            </div>
        </div>
        <form action="" method="POST" class="match-form">
            <!-- <div> -->
                <label for="equipe_domicile">
                    Équipe à domicile
                    <select name="equipe_domicile" id="equipe_domicile">
                        <option value="">Sélectionner une équipe domc</option>
                        <?php foreach($listDesEquipe as $equipe): ?>
                            <option value="<?= e($equipe['id_equipe']) ?>"><?= e($equipe['nom_equipe']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
            <!-- </div> -->
            <span class="match-versus">VS</span>
            <!-- <div> -->
                <label for="equipe_exterieure">
                    Équipe à l’extérieur
                    <select name="equipe_exterieure" id="equipe_exterieure">
                        <option value="">Sélectionner une équipe extr</option>
                        <?php foreach($listDesEquipe as $equipe): ?>
                            <option value="<?= e($equipe['id_equipe']) ?>"><?= e($equipe['nom_equipe']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
            <!-- </div> -->
            <button type="submit" class="match-submit">
                <i class="fa-solid fa-play"></i>
                Lancer la simulation
            </button>
        </form>
        <?php if (isset($matchSimulature)): ?>
            <div class="match-result animate__animated animate__bounce">
                <span class="match-result-team"><?= e($matchSimulature['equipe_domicile']) ?></span>
                <strong class="match-result-score">
                    <?= e($matchSimulature['score_dom']) ?>
                    –
                    <?= e($matchSimulature['score_ext']) ?>
                </strong>
                <span class="match-result-team"><?= e($matchSimulature['equipe_exterieure']) ?></span>
            </div>
        <?php endif; ?>
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
            <div class="match-panel-head-button">
                <a href="<?= e(url('listMatch')) ?>">Voir tout</a>
                <i class="fa-solid fa-arrow-right-long"></i>
            </div>
        </div>
        <div class="match-list">
            <?php foreach ($derniersMatchs as $match): ?>
                <article class="match-row">
                    <div class="match-team">
                        <span><?= e($match['equipe_domicile']) ?></span>
                        <span><?= e($match['score_dom']) ?> - <?= e($match['score_ext']) ?></span>
                        <span><?= e($match['equipe_exterieure']) ?></span>
                    </div>
                    <time datetime="#"><?= e($match['date_match']) ?></time>
                    <?php if ($match['score_dom'] > $match['score_ext']): ?>
                        <span class="match-badge win">Victoire</span>
                    <?php elseif ($match['score_dom'] < $match['score_ext']): ?>
                        <span class="match-badge losse">Défaite</span>
                    <?php else: ?>
                        <span class="match-badge tie">Match nul</span>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
</section>
