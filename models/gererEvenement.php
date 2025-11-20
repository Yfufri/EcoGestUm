<?php
function getNbPastEvent($conn)
{
    $sql = "SELECT COUNT(*) FROM Vue_Evenement_Passé";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['COUNT(*)'];
}

function getAllEventId($conn)
{
    $sql = "SELECT Id_evenement FROM Evenement";
    $result = $conn->query($sql);
    $ids = [];
    while ($row = $result->fetch_assoc()) {
        $ids[] = $row['Id_evenement'];
    }
    return $ids;
}

function getInfoEvent($conn, $id_event)
{
    $sql = "SELECT evenement.Nom_evenement,evenement.Description,image_evenement.Url_image FROM evenement
            INNER JOIN image_evenement 
                ON image_evenement.Id_evenement=evenement.Id_evenement
            WHERE evenement.Id_evenement=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_event);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}
