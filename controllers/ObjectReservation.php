<?php
require_once 'models/gererEquipement.php';
require_once 'models/gererSignalement.php';

$id_objet = $_GET['id'] ?? null;

if (!$id_objet || !is_numeric($id_objet)) {
    header('Location: index.php?action=ObjectBrowser');
    exit;
}

if (empty($_SESSION['user']['Id_utilisateur'])) {
    header('Location: index.php?action=login');
    exit;
}

$objet = getObjetById($conn, $id_objet);
if (!$objet) {
    header('Location: index.php?action=ObjectBrowser');
    exit;
}

$reservé = isset($_GET['reserved']) && $_GET['reserved'] == 1;
$messageReservation = '';

if ($reservé) {
    $objet = getObjetById($conn, $id_objet);
    $emailProprietaire = $objet['Mail_utilisateur'] ?? '';
    $messageReservation = "Votre réservation a bien été prise en compte. Veuillez contacter le propriétaire à cette adresse mail : $emailProprietaire";
}

$localisation = $objet['Localisation_point_de_collecte'] ?? '';
$latitude = $longitude = null;

if (!empty($localisation) && strpos($localisation, ',') !== false) {
    list($latitude, $longitude) = explode(',', $localisation);
}

if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_POST['type_form'])
    && $_POST['type_form'] === 'signalement'
) {
    $motif = trim($_POST['message'] ?? '');
    $idUtilisateur = $_SESSION['user']['Id_utilisateur'] ?? null;

    if ($idUtilisateur && $motif !== '') {
        signalerObjet($conn, (int)$id_objet, (int)$idUtilisateur, $motif);
    }

    header('Location: index.php?action=reservation&id=' . urlencode($id_objet));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_POST['type_form'])) {
    $id_utilisateur = $_SESSION['user']['Id_utilisateur'];
    $success = reserverObjet($conn, $id_objet, $id_utilisateur);
    if ($success) {
        header('Location: index.php?action=reservation&id=' . urlencode($id_objet) . '&reserved=1');
        exit;
    }
}

$photos = getPhotosByObjet($conn, $id_objet);
include 'views/ObjectReservation.php';
?>