<?php
require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

include "models/gererBaseDeDonnees.php";

$conn = OpenCon();

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$action = $_GET['action'] ?? null;

switch($action){
    case 'evenements':
        include "controllers/Evenement.php";
        break;
    case 'inscription':
        include "controllers/Inscription.php";
        break;
    case 'login':
        include "views/Connection.php";
        break;
    case 'logout':
        include "logout.php";
        break;
    case 'politique':
        include "views/header.php";
        include "views/politiqueDeRecylage.php";
        include "views/footer.php";
        break;
    case 'statistiques':
        include "views/header.php";
        include "controllers/Statistics.php";
        include "views/footer.php";
        break;
    default:
        include "views/header.php";
        include "controllers/Home.php";
        include "views/footer.php";
        break;
}

$conn->close();
?>