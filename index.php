<?php
require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

include "models/gererBaseDeDonnees.php";

$conn = OpenCon();

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$mail = $_POST['mail'] ?? null;
$password = $_POST['password'] ?? null;


if ($mail != null && $password != null) {
    include "controllers/identification.php";
}

$action = $_GET['action'] ?? null;

switch ($action) {
    case 'récupération':
        require_once "controllers/récupération.php";
        break;
    case "reservation":
        include 'views/header.php';
        require_once "controllers/ObjectReservation.php";
        include 'views/footer.php';
        break;
    case 'mesObjets':
    case 'mesReservations':
    case "chercherObjet":
        include 'views/header.php';
        require_once "controllers/ObjectBrowser.php";
        include 'views/footer.php';
        break;
    case 'evenements':
        include "controllers/Evenement.php";
        break;
    case 'inscription':
        include "controllers/Inscription.php";
        break;
    case 'login':
        include "controllers/login.php";
        break;
    case 'logout':
        include "controllers/logout.php";
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
    case 'ConseilEco':
        include 'views/header.php';
        include 'controllers/BlockScroller.php';
        include 'views/footer.php';
        break;
    case 'historique':
        include 'views/header.php';
        include 'controllers/BlockScroller.php';
        include 'views/footer.php';
        break;
    case 'addObject':
        include 'views/header.php';
        include 'controllers/AddObject.php';
        include 'views/footer.php';
        break;
    default:
        include "views/header.php";
        include "controllers/Home.php";
        include "views/footer.php";
        break;
}

$conn->close();
?>  