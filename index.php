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
        include "controllers/Stati.php";
        include "views/footer.php";
        break;
    default:
        include "views/header.php";
        include "controllers/Home.php";
        include "views/footer.php";
}


?>
