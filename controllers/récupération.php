<?php
require_once("models/gererEquipement.php");
supprimerObjet($conn,$_GET['id']);
header("Location: ?action=mesReservation");
?>