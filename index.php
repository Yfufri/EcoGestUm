<?php

require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

include "models/gererBaseDeDonnees.php";

$conn = OpenCon();





define('BASE_URL', '/EcoGestUM/'); // à deplacer dans .env ou à supp
define('ASSETS_URL', BASE_URL . 'assets/');

require 'views/Header.php';
require 'views/ObjectBrowser.php';
require 'views/Footer.php';

//if (isset($_GET['action']) && $_GET['action'] === 'ACTION') {
//	header('Location:assets/views/PAGE');
//	exit;
//}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>ÉcoGestUM - Accueil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <?php
    require_once 'views/header.php';
    require_once 'views/InscriptionEvent/inscription.php';
    require_once 'views/footer.php';
    ?>
</body>

</html>