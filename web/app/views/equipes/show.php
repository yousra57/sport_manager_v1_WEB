<p class="retour"><a href="<?= url('equipes') ?>">← Toutes les équipes</a></p>
<h1><?= e($equipe['nom']) ?></h1>

<dl class="infos">
    <dt>Créée le</dt><dd><?= e($equipe['date_creation']) ?></dd>
    <dt>Coach</dt><dd><?= e($equipe['coach_nom']) ?></dd>
    <dt>Effectif</dt><dd><?= count($joueurs) ?> joueur(s)</dd>
</dl>

<h2>Joueurs</h2>
<?php if (!$joueurs): ?>
    <p class="vide">Aucun joueur dans cette équipe.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th class="num">N°</th>
                <th>Nom</th>
                <th>Poste</th>
                <th class="num">Âge</th>
                <th>État</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($joueurs as $joueur): ?>
                <tr>
                    <td class="num"><?= (int) $joueur['numero'] ?></td>
                    <td><a href="<?= url('joueur', ['id' => $joueur['id']]) ?>"><?= e($joueur['prenom'] . ' ' . $joueur['nom']) ?></a></td>
                    <td><?= e($joueur['poste_nom']) ?></td>
                    <td class="num"><?= (int) $joueur['age'] ?></td>
                    <td><?= $joueur['est_blesse'] ? '<span class="tag rouge">Blessé</span>' : '<span class="tag vert">Apte</span>' ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
