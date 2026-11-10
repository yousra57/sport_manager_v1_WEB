<?php

class JoueurController
{
    public function index(): void
    {
        render('joueurs/index', [
            'titre' => 'Joueurs',
            'joueurs' => Joueur::all(),
        ]);
    }

    public function show(?int $id): void
    {
        $joueur = $id ? Joueur::find($id) : null;
        if (!$joueur) {
            notFound("Ce joueur n'existe pas.");
            return;
        }

        render('joueurs/show', [
            'titre' => $joueur['prenom'] . ' ' . $joueur['nom'],
            'joueur' => $joueur,
            'equipe' => Equipe::find($joueur['equipe_id']),
        ]);
    }
}
