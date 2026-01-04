<?php

include "models/gererEquipement.php";

$idUtilisateurConnecte = $_SESSION['user']['Id_utilisateur'] ?? null;

$mot_clef = $_GET['search'] ?? null;
$categorie = $_GET['categorie'] ?? null;
$point_collecte = $_GET['point_collecte'] ?? null;

$categories = getAllCategories($conn);
$points_collecte = getAllPointsCollecte($conn);


switch ($_GET['action']) {
    case 'mesObjets':
        if (isset($_GET['id'])){
            supprimerObjet($conn,$_GET['id']);
        }
        $titre = 'MES OBJETS';
        $nomButton = 'Supprimer';
        $redirection = 'mesObjets';
        $objets = consulterMesObjets($conn, $mot_clef, $categorie, $point_collecte, $idUtilisateurConnecte);
        include 'views/ObjectBrowser.php'; 
        break;
    case 'mesReservations':
        if (isset($_GET['id'])){
            supprimerReservation($conn,$_GET['id']);
        }
        $titre = 'MES RESERVATIONS';
        $nomButton = 'Supprimer la réservation';
        $redirection = 'mesReservations';
        $estUneRecuperation = true;
        $objets = consulterMesReservations($conn,$mot_clef,$categorie, $point_collecte, $idUtilisateurConnecte);
        include 'views/ObjectBrowser.php'; 
        break;
    case 'chercherObjet':
        $titre = 'OBJETS DISPONIBLES';
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