<?php
class HomeController{
    public function index(): void
    {
        render('home',[
            'titre' => 'Acceuil',
            'nombreEquipes' => Equipe::equipeTotal(),
            'dernieresEquipes' => Equipe::latestEquipe(),
            'nombreJoueurs' => Joueur::countPlayers(),
            'nombreBlesses' => Joueur::countInjured(),
            'nombreMatchs' => Matchs::countMatch(),
        ]);
    }
}