<?php 
$action = $_GET['action'] ?? null;

require_once 'models/gererEquipement.php';

switch ($action) {
    case 'mesReservations':
        supprimerReservation($conn, $_GET['id']);
        break;
    case 'mesObjets':
        supprimerObjet($conn, $_GET['id']);
        break;
    default:
        break;
}

?>