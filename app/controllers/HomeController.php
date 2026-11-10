<?php

class HomeController
{
    /** Page de débrief (accueil). */
    public function index(): void
    {
        $equipes = Equipe::all();
        $joueurs = Joueur::all();

        render('home', [
            'titre' => 'Débrief',
            'exempleEquipeId' => $equipes[0]['id'] ?? null,
            'exempleJoueurId' => $joueurs[0]['id'] ?? null,
            'nbEquipes' => count($equipes),
            'nbJoueurs' => count($joueurs),
        ]);
    }
}
