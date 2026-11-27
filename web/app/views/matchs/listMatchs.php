<main class="match-container">
    <section class="match-head">
        <p class="eyebrow"><i class="fa-solid fa-futbol"></i> Historique</p>
        <h1>Liste des matchs</h1>
        <p class="match-intro">Consulte les résultats et gère les matchs enregistrés.</p>
    </section>

    <section class="match-panel">
        <div class="match-panel-head list-match-actions">
            <div>
                <h2>Matchs joués</h2>
                <p><?= e(count($matchs)) ?> résultat(s)</p>
            </div>
            <form method="POST" action="<?= e(url('listMatch')) ?>" onsubmit="return confirm('Supprimer tous les matchs enregistrés ? Cette action est définitive.');">
                <input type="hidden" name="action" value="reinitialiser">
                <button class="match-delete-button" type="submit"><i class="fa-solid fa-rotate-left"></i> Réinitialiser</button>
            </form>
            <a class="match-back-button" href="<?= e(url('match')) ?>">Retour aux matchs</a>
        </div>

        <form method="POST" action="<?= e(url('listMatch')) ?>" onsubmit="return confirm('Supprimer les matchs sélectionnés ?');">
            <input type="hidden" name="action" value="supprimer_selection">
            <div class="match-table-wrap">
                <table class="match-history-table">
                    <thead>
                        <tr>
                            <th><span class="sr-only">Sélection</span></th>
                            <th>Équipe à domicile</th>
                            <th>Score</th>
                            <th>Équipe extérieure</th>
                            <th>Date</th>
                            <th>Résultat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($matchs === []): ?>
                            <tr><td colspan="6" class="match-empty">Aucun match joué pour le moment.</td></tr>
                        <?php else: ?>
                            <?php foreach ($matchs as $match): ?>
                                <tr>
                                    <td><input type="checkbox" name="matchs[]" value="<?= e($match['id_match']) ?>" aria-label="Sélectionner le match <?= e($match['equipe_domicile']) ?> contre <?= e($match['equipe_exterieure']) ?>"></td>
                                    <td><?= e($match['equipe_domicile']) ?></td>
                                    <td class="match-score-cell"><?= e($match['score_dom']) ?> - <?= e($match['score_ext']) ?></td>
                                    <td><?= e($match['equipe_exterieure']) ?></td>
                                    <td><?= e($match['date_match']) ?></td>
                                    <td>
                                        <?php if ($match['score_dom'] > $match['score_ext']): ?>
                                            <span class="match-outcome win">Victoire</span>
                                        <?php elseif ($match['score_dom'] < $match['score_ext']): ?>
                                            <span class="match-outcome loss">Défaite</span>
                                        <?php else: ?>
                                            <span class="match-outcome draw">Match nul</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="match-selection-actions">
                <button class="match-delete-button" type="submit" <?= $matchs === [] ? 'disabled' : '' ?>>
                    <i class="fa-solid fa-trash"></i> Supprimer la sélection
                </button>
            </div>
        </form>
    </section>
</main>
