<?php
function getNbPastEvent($conn) {
    $sql = "SELECT COUNT(*) FROM Vue_Evenement_Passé";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['COUNT(*)'];
}


?>