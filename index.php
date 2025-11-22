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
    include "models/gererConnection.php";
    $user = getUserFromConnection($conn, $mail);
    if ($user && password_verify($password, $user['Password_utilisateur'])) {
        $_SESSION['user'] = $user;
    } else {
        header("Location: index.php?action=login&error=1");
    }
}

$action = $_GET['action'] ?? null;

switch($action){
    case 'evenements':
        include "controllers/Evenement.php";
        break;
        
    case 'inscription':
        include "models/gererEvenement.php";
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
        include "controllers/login.php";
        break;
        
    case 'logout':
        include "controllers/logout.php";
        break;
        
    default:
        include "views/header.php";
        include "controllers/Home.php";
        include "views/footer.php";
        break;
}
?>