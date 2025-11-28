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
        $nomButton = null;
        $redirection = null;
        $objets = null;
        include 'views/ObjectBrowser.php'; 
        break;
    case 'mesReservations':
        $nomButton = null;
        $redirection = null;
        $objets = null;
        include 'views/ObjectBrowser.php'; 
        break;
    case 'chercherObjet':
        $nomButton = null;  
        $redirection = null;
        $objets = consulterObjets($conn, $mot_clef, $categorie, $point_collecte, $idUtilisateurConnecte);
        include 'views/ObjectBrowser.php'; 
        break;
    default:
        echo "Erreur: action non reconnue.";
        break;
}

?>