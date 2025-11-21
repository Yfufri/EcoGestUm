<?php
require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

include "models/gererBaseDeDonnees.php";

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Définir les constantes de chemins
define('BASE_URL', '/EcoGestUm/');
define('ASSETS_URL', BASE_URL . 'assets/');

// Router
$action = $_GET['action'] ?? 'accueil';

switch($action){
    case 'evenements':
        // Page liste des événements
        include_once "controllers/Evenement.php";
        include "views/header.php";
        include "views/evenement.php";
        include "views/footer.php";
        break;
        
    case 'inscription':
        // Page formulaire d'inscription à un événement
        include_once "controllers/Evenement.php";
        include "views/header.php";
        include "views/inscription.php";
        include "views/footer.php";
        break;
        
    case 'statistiques':
        include "views/header.php";
        include "views/Statistics.php";
        include "views/footer.php";
        break;
        
    case 'politique':
        include "views/header.php";
        include "views/politiqueDeRecyclage.php";
        include "views/footer.php";
        break;
        
    case 'login':
        include "views/Connection.php";
        break;
        
    case 'logout':
        include "logout.php";
        break;
        
    default:
        // Page d'accueil
        include "views/header.php";
        include "controllers/Home.php";
        include "views/footer.php";
        break;
}
?>