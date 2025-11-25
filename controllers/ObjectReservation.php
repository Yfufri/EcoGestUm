<?php

include "models/gererEquipement.php";

// Récupérer l'ID de l'objet depuis l'URL
$id_objet = $_GET['id'] ?? null;

// Vérifier que l'ID est valide
if (!$id_objet || !is_numeric($id_objet)) {
    header('Location: index.php?action=ObjectBrowser');
    exit;
}

// Récupérer les infos de l'objet
$objet = getObjetById($conn, $id_objet);

// Vérifier que l'objet existe
if (!$objet) {
    header('Location: index.php?action=ObjectBrowser');
    exit;
}

// Charger la vue
include 'views/ObjectReservation.php';

?>
