<?php
function getNbPastEvent($conn) {
    $sql = "SELECT COUNT(*) as count FROM Evenement WHERE Date_evenement < CURDATE()";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['count'];
}

function getAllEventId($conn) {
    $result = $conn->query('SELECT Id_evenement FROM evenement');
    $ids = [];
    while ($row = $result->fetch_assoc()) {
        $ids[] = $row['Id_evenement'];
    }
    return $ids;
}

function getInfoEvent($conn, $id) {
    $stmt = $conn->prepare(
        'SELECT e.*,
                (SELECT Url_image 
                 FROM IMAGE_EVENEMENT 
                 WHERE Id_evenement = e.Id_evenement LIMIT 1) as Url_image
         FROM Evenement e 
         WHERE e.Id_evenement = ?'
    );
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

$evenementsAVenir = [];
$evenementsPasses = [];

$today = date('Y-m-d');

// Événements à venir
$sqlAVenir = "SELECT e.Id_evenement, e.Nom_evenement, e.Description, 
              e.Localisation_evenement, e.Date_evenement, e.Id_categorie_evenement, 
              e.Id_utilisateur, 
              (SELECT Url_image FROM IMAGE_EVENEMENT WHERE Id_evenement = e.Id_evenement LIMIT 1) as Url_image
              FROM Evenement e 
              WHERE e.Date_evenement >= ?
              ORDER BY e.Date_evenement ASC";
$stmt = $conn->prepare($sqlAVenir);
$stmt->bind_param("s", $today);
$stmt->execute();
$resultAVenir = $stmt->get_result();
while ($event = $resultAVenir->fetch_assoc()) {
    $evenementsAVenir[] = $event;
}

// Événements passés
$sqlPasses = "SELECT e.Id_evenement, e.Nom_evenement, e.Description, 
              e.Localisation_evenement, e.Date_evenement, e.Id_categorie_evenement, 
              e.Id_utilisateur, 
              (SELECT Url_image FROM IMAGE_EVENEMENT WHERE Id_evenement = e.Id_evenement LIMIT 1) as Url_image
              FROM Evenement e 
              WHERE e.Date_evenement < ?
              ORDER BY e.Date_evenement DESC";
$stmtP = $conn->prepare($sqlPasses);
$stmtP->bind_param("s", $today);
$stmtP->execute();
$resultP = $stmtP->get_result();
while ($event = $resultP->fetch_assoc()) {
    $evenementsPasses[] = $event;
}

// Page inscription
if (isset($_GET['id'])) {
    include_once __DIR__ . '/../models/gererEvenement.php';
    $evenement = getInfoEvent($conn, $_GET['id']);
}
?>
