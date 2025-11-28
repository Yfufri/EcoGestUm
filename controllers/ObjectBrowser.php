<?php

include "models/gererEquipement.php";

$idUtilisateurConnecte = $_SESSION['user']['Id_utilisateur'] ?? null;

$mot_clef = $_GET['search'] ?? null;
$categorie = $_GET['categorie'] ?? null;
$point_collecte = $_GET['point_collecte'] ?? null;

$categories = getAllCategories($conn);
$points_collecte = getAllPointsCollecte($conn);


switch ($_GET['action']) { // marche pas (renvoie tjrs vers default)
    case 'mesObjets':
        $nomButton = 'Supprimer';
        $redirection = 'mesObjets';
        $objets = consulterMesObjets($conn, $mot_clef, $categorie, $point_collecte, $idUtilisateurConnecte);
        include 'views/ObjectBrowser.php'; 
        break;
    case 'mesReservations':
        $nomButton = 'Supprimer la réservation';
        $redirection = 'mesReservations';
        $objets = null;
        include 'views/ObjectBrowser.php'; 
        break;
    case 'chercherObjet':
        $nomButton = "Réserver";  
        $redirection = "reservation";
        $objets = consulterObjets($conn, $mot_clef, $categorie, $point_collecte, $idUtilisateurConnecte);
        include 'views/ObjectBrowser.php'; 
        break;
    default:
        echo "Erreur: action non reconnue.";
        break;
}

?>