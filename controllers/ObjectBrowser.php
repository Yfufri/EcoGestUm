<?php

include "models/gererEquipement.php";

$idUtilisateurConnecte = $_SESSION['user']['Id_utilisateur'] ?? null;

$mot_clef = $_GET['search'] ?? null;
$categorie = $_GET['categorie'] ?? null;
$point_collecte = $_GET['point_collecte'] ?? null;

$objets = consulterObjets($conn, $mot_clef, $categorie, $point_collecte, $idUtilisateurConnecte);

$categories = getAllCategories($conn);
$points_collecte = getAllPointsCollecte($conn);


include 'views/ObjectBrowser.php';

?>