<h1>Équipes</h1>

<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Création</th>
            <th>Coach</th>
            <th class="num">Joueurs</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($equipes as $equipe): ?>
            <tr>
                <td><a href="<?= url('equipe', ['id' => $equipe['id']]) ?>"><?= e($equipe['nom']) ?></a></td>
                <td><?= e($equipe['date_creation']) ?></td>
                <td><?= e($equipe['coach_nom']) ?></td>
                <td class="num"><?= (int) $equipe['nb_joueurs'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
