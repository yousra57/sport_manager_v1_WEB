<?php
class MatchController
{
    public function index(): void
    {
        render('matchs', [
            'titre' => 'matchs',
            'nombreMatchs' => Matchs::countMatch(),
            'nombreMatchsNuls' => Matchs::matchNuls(),
            'nombreMatchsGagne' => Matchs::matchGagne(),
            'nombreMatchsPerdu' => Matchs::matchPerdu(),
            'derniersMatchs' => Matchs::latestMatchs(),
        ]);
    }
}