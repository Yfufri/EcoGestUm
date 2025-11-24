<?php

include "models/gererEquipement.php";
include "models/gererEvenement.php";

$nbObjetRecycle = getNbObjectRecycled($conn);
$nbEvenementPasse = getNbPastEvent($conn);
$nbObjetDisponible = getNbObjectDisponible($conn);

function displayDefaultHomePage($conn) {
        include "views/banner.php";
        include "views/DiscoverPolitique.php";
        include "controllers/Statistics.php";
        include "views/Events.php";
        include "views/Visits.php";
        }

function displayStudentHomePage($conn) {
        include "views/banner.php";
        include "views/welcome.php";
        include "views/Recycle.php";
        include "controllers/Statistics.php";
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