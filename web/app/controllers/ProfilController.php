<?php
class ProfilController{
    public function index(): void
    {
        render('profil',[
            'titre' => 'Profil',
            'nombreEquipes' => Equipe::equipeTotal(),
            'nombreJoueurs' => Joueur::countPlayers(),
            'nombreBlesses' => Joueur::countInjured(),
        ]);
    }
}