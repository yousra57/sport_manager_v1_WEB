<h1>Joueurs</h1>

<table>
    <thead>
        <tr>
            <th class="num">N°</th>
            <th>Nom</th>
            <th>Équipe</th>
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
                <td><a href="<?= url('equipe', ['id' => $joueur['equipe_id']]) ?>"><?= e($joueur['equipe_nom']) ?></a></td>
                <td><?= e($joueur['poste_nom']) ?></td>
                <td class="num"><?= (int) $joueur['age'] ?></td>
                <td><?= $joueur['est_blesse'] ? '<span class="tag rouge">Blessé</span>' : '<span class="tag vert">Apte</span>' ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
