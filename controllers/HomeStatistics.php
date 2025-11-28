<?php

require_once "models/gererEquipement.php";
require_once "models/gererEvenement.php";
$nbObjetRecycle = getNbObjectRecycled($conn);
$nbEvenementPasse = getNbEvent($conn);
$nbObjetDisponible = getNbObjectDisponible($conn);

include "views/Statistics.php";
?>