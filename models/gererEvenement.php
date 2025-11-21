<?php
function getNbPastEvent($conn) {
    $sql = "SELECT COUNT(*) as count FROM Evenement WHERE Date_evenement < CURDATE()";
    $result = $conn->query($sql);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    return $row['count'];
}

function getAllEventId($conn) {
    $result = $conn->query('SELECT Id_evenement FROM evenement');
    $ids = [];
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $ids[] = $row['Id_evenement'];
    }
    return $ids;
}

function getInfoEvent($conn, $id) {
    // Récupérer l'événement avec une seule image
    $stmt = $conn->prepare('SELECT e.*, 
                            (SELECT Url_image FROM IMAGE_EVENEMENT WHERE Id_evenement = e.Id_evenement LIMIT 1) as Url_image
                            FROM Evenement e 
                            WHERE e.Id_evenement = ?');
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>