<?php
$competences = [
    'Vitesse' => $joueur['vitesse'],
    'Endurance' => $joueur['endurance'],
    'Force' => $joueur['force'],
    'Technique' => $joueur['technique'],
];
?>
<p class="retour"><a href="<?= url('joueurs') ?>">← Tous les joueurs</a></p>
<h1><?= e($joueur['prenom'] . ' ' . $joueur['nom']) ?></h1>

<dl class="infos">
    <dt>Numéro</dt><dd><?= (int) $joueur['numero'] ?></dd>
    <dt>Âge</dt><dd><?= (int) $joueur['age'] ?> ans</dd>
    <dt>Poste</dt><dd><?= e($joueur['poste_nom']) ?></dd>
    <dt>État</dt><dd><?= $joueur['est_blesse'] ? '<span class="tag rouge">Blessé</span>' : '<span class="tag vert">Apte</span>' ?></dd>
    <dt>Équipe</dt>
    <dd>
        <?php if ($equipe): ?>
            <a href="<?= url('equipe', ['id' => $equipe['id']]) ?>"><?= e($equipe['nom']) ?></a>
        <?php else: ?>
            Sans équipe
        <?php endif; ?>
    </dd>
</dl>

<h2>Caractéristiques</h2>
<?php if ($joueur['vitesse'] === null): ?>
    <p class="vide">Aucune compétence renseignée.</p>
<?php else: ?>
    <table class="competences">
        <?php foreach ($competences as $nom => $valeur): ?>
            <tr>
                <th><?= e($nom) ?></th>
                <td><progress max="100" value="<?= (int) $valeur ?>"></progress></td>
                <td class="num"><?= (int) $valeur ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
