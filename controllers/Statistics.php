<?php
// filepath: /Applications/MAMP/htdocs/BoukhedraYanis/EcoGestUmAPP/EcoGestUm/controllers/Statistics.php

include "models/gererEquipement.php";
include "models/gererEvenement.php";

$nbObjetRecycle = getNbObjectRecycled($conn);
$nbEvenementPasse = getNbPastEvent($conn);
$nbObjetDisponible = getNbObjectDisponible($conn);

include "views/Statistics.php";
?>