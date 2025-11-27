<?php

/*include "models/gererEquipement.php";

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
include 'views/ObjectReservation.php';*/

include "models/gererEquipement.php"; // Fonction reserverObjet et getObjetById

// Récupérer l'ID de l'objet depuis l'URL
$id_objet = $_GET['id'] ?? null;

if (!$id_objet || !is_numeric($id_objet)) {
    header('Location: index.php?action=ObjectBrowser');
    exit;
}

// Récupérer les infos de l'objet (disponible uniquement)
$objet = getObjetById($conn, $id_objet);
if (!$objet) {
    header('Location: index.php?action=ObjectBrowser');
    exit;
}

// Vérifier que l'utilisateur est connecté
if (empty($_SESSION['user']['Id_utilisateur'])) {
    header('Location: index.php?action=login');
    exit;
}

$reservé = false;

// Si formulaire envoyé en POST, effectuer la réservation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_utilisateur = $_SESSION['user']['Id_utilisateur'];

    $success = reserverObjet($conn, $id_utilisateur, $id_objet);

    if ($success) {
        $reservé = true;
        // Recharger les infos à jour de l'objet après réservation
        $objet = getObjetById($conn, $id_objet);
    } else {
        // Tu peux gérer un message d'erreur à afficher si besoin
        $reservé = false;
    }
}

include 'views/ObjectReservation.php';


?>
