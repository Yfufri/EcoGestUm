<?php
$evenementsAVenir = [];
$evenementsPasses = [];

$today = date('Y-m-d');

// Événements à venir - Prendre une seule image par événement
$sqlAVenir = "SELECT e.Id_evenement, e.Nom_evenement, e.Description, 
              e.Localisation_evenement, e.Date_evenement, e.Id_categorie_evenement, 
              e.Id_utilisateur, 
              (SELECT Url_image FROM IMAGE_EVENEMENT WHERE Id_evenement = e.Id_evenement LIMIT 1) as Url_image
              FROM Evenement e 
              WHERE e.Date_evenement >= ?
              ORDER BY e.Date_evenement ASC";
$stmt = $conn->prepare($sqlAVenir);
$stmt->execute([$today]);
while ($event = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $evenementsAVenir[] = $event;
}

// Événements passés - Prendre une seule image par événement
$sqlPasses = "SELECT e.Id_evenement, e.Nom_evenement, e.Description, 
              e.Localisation_evenement, e.Date_evenement, e.Id_categorie_evenement, 
              e.Id_utilisateur, 
              (SELECT Url_image FROM IMAGE_EVENEMENT WHERE Id_evenement = e.Id_evenement LIMIT 1) as Url_image
              FROM Evenement e 
              WHERE e.Date_evenement < ?
              ORDER BY e.Date_evenement DESC";
$stmtP = $conn->prepare($sqlPasses);
$stmtP->execute([$today]);
while ($event = $stmtP->fetch(PDO::FETCH_ASSOC)) {
    $evenementsPasses[] = $event;
}

// Pour la page inscription (si ID présent)
if (isset($_GET['id'])) {
    include_once __DIR__ . '/../models/gererEvenement.php';
    $evenement = getInfoEvent($conn, $_GET['id']);
}
?>