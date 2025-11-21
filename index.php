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
    default:
        include "views/header.php";
        include "views/banner.php";
        include "views/DiscoverPolitique.php";
        include "views/Statistics.php";
        include "views/Events.php";
        include "views/Visits.php";
        include "views/footer.php";
}


?>
