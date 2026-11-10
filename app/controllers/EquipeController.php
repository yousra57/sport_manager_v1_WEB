<?php

class EquipeController
{
    public function index(): void
    {
        render('equipes/index', [
            'titre' => 'Équipes',
            'equipes' => Equipe::all(),
        ]);
    }

    public function show(?int $id): void
    {
        $equipe = $id ? Equipe::find($id) : null;
        if (!$equipe) {
            notFound("Cette équipe n'existe pas.");
            return;
        }

        render('equipes/show', [
            'titre' => $equipe['nom'],
            'equipe' => $equipe,
            'joueurs' => Joueur::byEquipe($equipe['id']),
        ]);
    }
}
