<?php
// Chargement du backend partagé, puis des éléments propres au site web.

define('WEB_PATH', dirname(__DIR__));

require_once dirname(__DIR__, 2) . '/backend/bootstrap.php';
require_once __DIR__ . '/helpers.php';

require_once __DIR__ . '/controllers/EquipeController.php';
require_once __DIR__ . '/controllers/JoueurController.php';
