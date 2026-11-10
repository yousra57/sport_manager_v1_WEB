<h1>Équipes</h1>

<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Ville</th>
            <th>Stade</th>
            <th class="num">Budget</th>
            <th class="num">Joueurs</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($equipes as $equipe): ?>
            <tr>
                <td><a href="<?= url('equipe', ['id' => $equipe['id']]) ?>"><?= e($equipe['nom']) ?></a></td>
                <td><?= e($equipe['ville']) ?></td>
                <td><?= e($equipe['stade']) ?></td>
                <td class="num"><?= argent($equipe['budget']) ?></td>
                <td class="num"><?= (int) $equipe['nb_joueurs'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
