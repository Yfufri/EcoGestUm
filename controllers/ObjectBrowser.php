<?php

include "models/gererEquipement.php";

$mot_clef = $_GET['search'] ?? null;
$categorie = $_GET['categorie'] ?? null;
$point_collecte = $_GET['point_collecte'] ?? null;

$objets = consulterObjets($conn, $mot_clef, $categorie, $point_collecte);

$categories = getAllCategories($conn);
$points_collecte = getAllPointsCollecte($conn);


include 'views/ObjectBrowser.php';

?>