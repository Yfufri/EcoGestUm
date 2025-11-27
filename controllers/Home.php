<?php

require_once("models/gererUtilisateur.php");

function displayDefaultHomePage($conn) {
        include "views/banner.php";
        include "views/DiscoverPolitique.php";
        include "controllers/HomeStatistics.php";
        include "views/Events.php";
        include "views/visite.php";
        include "controllers/BlockScrollerPresentation.php";
        setPresentation('ConseilEco',$conn);
}

function displayStudentTeacherHomePage($conn) {
        include "views/banner.php";
        include "controllers/welcome.php";
        include "views/Recycle.php";
        include "controllers/HomeStatistics.php";
        include "controllers/BlockScrollerPresentation.php";
        setPresentation('ConseilEco',$conn);
        include "controllers/AllPointsCollecte.php";
}

function displayChefDepHomePage($conn) {
        include "views/banner.php";
        include "controllers/welcome.php";
        include "views/Recycle.php";
        include "controllers/HomeStatistics.php";
        include "controllers/BlockScrollerPresentation.php";
        setPresentation('historique',$conn);
        include "controllers/AllPointsCollecte.php";
        setPresentation('ConseilEco',$conn);
}


$sessionUser = $_SESSION['user'] ?? null;
$userId = $sessionUser['Id_utilisateur'] ?? null;

switch (getRole($conn, $userId)) {
    case 'Etudiant':
        displayStudentTeacherHomePage($conn);
        break;
    case 'Enseignant':
        displayStudentTeacherHomePage($conn);
        break;   
    case 'Chef de departement':
        displayChefDepHomePage($conn);
        break;      
    default:
        displayDefaultHomePage($conn);
        break;
}

?>