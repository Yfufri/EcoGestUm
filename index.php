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
    $user = getUserFromConnection($conn, $mail, $password);
    if (!empty($user)) {
        $_SESSION['user'] = $user;
    } else {
        header("Location: index.php?action=login&error=1");
    }
}

$action = $_GET['action'] ?? null;

switch($action){
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
}


?>
