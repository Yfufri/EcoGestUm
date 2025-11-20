<?php

require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

include "models/gererBaseDeDonnees.php";

$conn = OpenCon();

include "models/gererEvenement.php";

var_dump(getAllEventId($conn));



define('BASE_URL', '/EcoGestUM/'); // à deplacer dans .env ou à supp
define('ASSETS_URL', BASE_URL . 'assets/');

//if (isset($_GET['action']) && $_GET['action'] === 'ACTION') {
//	header('Location:assets/views/PAGE');
//	exit;
//}

?>
