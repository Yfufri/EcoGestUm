<?php

include "models/gererUtilisateur.php";

function displayDefaultHomePage($conn) {
        include "views/banner.php";
        include "views/DiscoverPolitique.php";
        include "controllers/HomeStatistics.php";
        include "views/Events.php";
        include "views/visite.php";
}

function displayStudentHomePage($conn) {
        include "views/banner.php";
        include "controllers/welcome.php";
        include "views/Recycle.php";
        include "controllers/HomeStatistics.php";
        // point de collecte
        echo "point de collecte";
}


$sessionUser = $_SESSION['user'] ?? null;
$userId = $sessionUser['Id_utilisateur'] ?? null;

switch (getRole($conn, $userId)) {
    case 'Etudiant':
        displayStudentHomePage($conn);
        break;
    default:
        displayDefaultHomePage($conn);
        break;
}

?>