<?php
// Point d'entrée commun : configuration, helpers, chargement des classes.

define('ROOT_PATH', dirname(__DIR__));
define('DB_PATH', ROOT_PATH . '/data/sportmanager.sqlite');

require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/Database.php';

require_once __DIR__ . '/models/Equipe.php';
require_once __DIR__ . '/models/Joueur.php';

require_once __DIR__ . '/controllers/EquipeController.php';
require_once __DIR__ . '/controllers/JoueurController.php';
