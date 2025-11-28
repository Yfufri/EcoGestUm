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
include "models/gererSignalement.php"; // Fonctions liées aux signalements



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
// 1. TRAITEMENT RÉSERVATION (seulement si pas de signalement)
if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    (!isset($_POST['type_form']) || $_POST['type_form'] !== 'signalement')
) {

    $id_utilisateur = $_SESSION['user']['Id_utilisateur'];
    $success = reserverObjet($conn, $id_utilisateur, $id_objet);

    if ($success) {
        $reservé = true;
        $objet = getObjetById($conn, $id_objet);
        // Récupérer email propriétaire
        $emailProprietaire = $objet['Mail_utilisateur'] ?? '';
        // Préparer message à afficher dans la vue
        $messageReservation = "Votre réservation a bien été prise en compte. Veuillez contacter le propriétaire à cette adresse mail : $emailProprietaire";
    } else {
        $reservé = false;
    }
}

// ------ TRAITEMENT DU FORMULAIRE DE SIGNALEMENT ------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message']) && isset($_POST['type_form']) && $_POST['type_form'] === 'signalement') {
    $motif = trim($_POST['message']);
    $idUtilisateur = $_SESSION['user']['Id_utilisateur'] ?? null;

    if ($idUtilisateur && $motif !== '') {
        signalerObjet($conn, (int) $id_objet, (int) $idUtilisateur, $motif);
    }

    // après signalement, on reste sur la même page
    header('Location: index.php?action=reservation&id=' . urlencode($id_objet));
    exit;
}



include 'views/ObjectReservation.php';


?>