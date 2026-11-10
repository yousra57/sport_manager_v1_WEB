<?php
/** Affiche une capture si le fichier existe dans public/img/preuves/, sinon un emplacement vide. */
function capture(string $fichier, string $legende): void
{
    $chemin = ROOT_PATH . '/public/img/preuves/' . $fichier;
    echo '<figure>';
    if (is_file($chemin)) {
        echo '<img src="img/preuves/' . e($fichier) . '" alt="' . e($legende) . '">';
    } else {
        echo '<div class="emplacement">Capture à ajouter :<br><code>public/img/preuves/' . e($fichier) . '</code></div>';
    }
    echo '<figcaption>' . e($legende) . '</figcaption></figure>';
}
?>
<h1>Débrief de fin de journée</h1>
<p class="chapo">Sport Manager – passage du bloc 2 (application de bureau) vers une application web + mobile.</p>

<!-- ============================ 1. ARCHITECTURE ============================ -->
<section>
    <h2>1. Choix d'architecture (web + mobile)</h2>

    <div class="schema">
        <div class="ligne">
            <div class="boite">Navigateur<small>site web</small></div>
            <div class="boite">Application mobile<small>crossplatform (.NET MAUI)</small></div>
        </div>
        <div class="fleche">↓ pages HTML &nbsp;&nbsp;|&nbsp;&nbsp; ↓ JSON</div>
        <div class="ligne">
            <div class="boite fort">Serveur PHP
                <small>Site MVC (V1) + API REST JSON (à venir)</small>
            </div>
        </div>
        <div class="fleche">↓ PDO</div>
        <div class="ligne">
            <div class="boite">Base de données unique<small>SQLite pour la V1, MySQL envisageable</small></div>
        </div>
    </div>

    <ul>
        <li><strong>Web :</strong> site PHP organisé en <strong>MVC</strong> – un routeur unique (<code>public/index.php</code>),
            des <em>modèles</em> qui interrogent la base (<code>app/models</code>), des <em>contrôleurs</em> (<code>app/controllers</code>)
            et des <em>vues</em> HTML (<code>app/views</code>).</li>
        <li><strong>Données :</strong> une seule base partagée, accédée par PDO avec des requêtes préparées. Le jeu de données du bloc 2
            est repris (<?= (int) $nbEquipes ?> équipes, <?= (int) $nbJoueurs ?> joueurs, 4 postes).</li>
        <li><strong>Mobile :</strong> l'application mobile ne touche jamais la base. Elle appelle une <strong>API REST (JSON)</strong>
            exposée par le même serveur que le site.</li>
        <li><strong>Pourquoi ce choix :</strong> une source unique de vérité pour le web et le mobile. Cela rend possibles le multijoueur
            sur une même instance, l'export / import des données et des règles de gestion écrites une seule fois, côté serveur.</li>
    </ul>

    <h3>Points d'attention</h3>
    <ul>
        <li>La simulation de match du bloc 2 est écrite en C# : elle devra être réécrite côté serveur PHP.</li>
        <li>L'API et l'application mobile restent à réaliser ; pas d'authentification pour le moment.</li>
    </ul>
</section>

<!-- ============================ 2. PREUVES BLOC 2 ============================ -->
<section>
    <h2>2. Preuves de fonctionnement – application du bloc 2</h2>
    <p>Application de bureau WPF (C#) avec Entity Framework Core et SQLite, organisée en couches (modèles, services, vues).</p>

    <div class="captures">
        <?php
        capture('equipes.png', 'Gestion des équipes : ajout, modification, suppression, effectif.');
        capture('joueurs.png', 'Gestion des joueurs : équipe, poste, compétences, recherche.');
        capture('postes.png', 'Gestion des postes : suppression bloquée si des joueurs y sont rattachés.');
        capture('match.png', 'Matchs : planification, simulation du score selon les compétences, blessures aléatoires.');
        ?>
    </div>
</section>

<!-- ============================ 3. VERSION 1 WEB ============================ -->
<section>
    <h2>3. Version 1 de l'application web (MVC)</h2>
    <p>Affichage uniquement, sans authentification.</p>

    <ul class="livrables">
        <li><span class="ok">✔</span> <a href="<?= url('equipes') ?>">Liste des équipes</a></li>
        <li><span class="ok">✔</span> <a href="<?= url('joueurs') ?>">Liste des joueurs</a></li>
        <li><span class="ok">✔</span> <?php if ($exempleEquipeId): ?><a href="<?= url('equipe', ['id' => $exempleEquipeId]) ?>">Détail d'une équipe</a><?php else: ?>Détail d'une équipe<?php endif; ?>
            <span class="discret">– informations de l'équipe et ses joueurs</span></li>
        <li><span class="ok">✔</span> <?php if ($exempleJoueurId): ?><a href="<?= url('joueur', ['id' => $exempleJoueurId]) ?>">Détail d'un joueur</a><?php else: ?>Détail d'un joueur<?php endif; ?>
            <span class="discret">– informations, caractéristiques et équipe de rattachement</span></li>
    </ul>
</section>
