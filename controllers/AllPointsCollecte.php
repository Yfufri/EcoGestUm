<?php
require_once "models/gererEquipement.php";
$points = getAllPointsCollecte($conn);
include 'views/PointsCollecte.php';
?>