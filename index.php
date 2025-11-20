<?php
//require_once __DIR__ . '/vendor/autoload.php';
//$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
//$dotenv->load();

//include "models/database.php";

//OpenCon();


//define('BASE_URL', '/EcoGestUM/'); // à deplacer dans .env ou à supp
//define('ASSETS_URL', BASE_URL . 'assets/');

//if (isset($_GET['action']) && $_GET['action'] === 'ACTION') {
//	header('Location:assets/views/PAGE');
//	exit;
//}
require_once 'views/header.php';
require_once 'views/InscriptionEvent/inscription.php';
require_once 'views/footer.php';
?>
