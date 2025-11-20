<?php
function getNbPastEvent($conn) {
    $sql = "SELECT COUNT(*) FROM Vue_Evenement_Passé";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['COUNT(*)'];
}

function getAllEventId($conn) {
    $sql = "SELECT Id_evenement FROM Evenement";
    $result = $conn->query($sql);
    $ids = [];
    while ($row = $result->fetch_assoc()) {
        $ids[] = $row['Id_evenement'];
    }
    return $ids;
}


?>