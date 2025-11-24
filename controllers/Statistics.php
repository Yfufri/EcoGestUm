<?php

require "models/gererEquipement.php";
require "models/gererEvenement.php";

$nbObjetRecycle=getNbObjectRecycled($conn);
$nbEvenementPasse=getNbPastEvent($conn);
$nbObjetDisponible=getNbObjectDisponible($conn);

include "views/Statistics.php";
?>