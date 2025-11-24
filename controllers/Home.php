<?php

include "models/gererEquipement.php";
include "models/gererEvenement.php";

$nbObjetRecycle = getNbObjectRecycled($conn);
$nbEvenementPasse = getNbPastEvent($conn);
$nbObjetDisponible = getNbObjectDisponible($conn);

include "views/banner.php";
include "views/DiscoverPolitique.php";
include "views/Statistics.php";
include "views/Events.php";
include "views/visite.php";
?>