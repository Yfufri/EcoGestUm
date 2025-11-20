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
var_dump($action);

switch($action){
    case 'politique':
        include "views/politiqueDeRecylage.php";
        break;
    case 'logout':
        include "logout.php";
        break;
    default:
        include "views/header.php";
        include "views/home.php";
        include "views/footer.php";
}


?>
