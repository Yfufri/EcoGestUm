<?php

function getAvailableEquipments($conn) { // NON DEMANDEE pour le moment
    $sql = "SELECT Nom_objet,
                    Desc_objet,
                    Nom_categorie_objet,
                    Nom_point_de_collecte,
                    Localisation_point_de_collecte,
                    Nom_utilisateur,Nom_statut
                 FROM vue_objets_disponibles";
    $result = $conn->query($sql);

    return $result->fetch_all(MYSQLI_ASSOC);
}

function GetNbObjectRecycled($conn) {
    $sql = "SELECT COUNT(*) AS total_recycles
            FROM `vue_objets_disponibles`
            WHERE Nom_Statut NOT LIKE 'Disponible';";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['total_recycles'];
}

function GetNbObjectDisponible($conn) {
    $sql = "SELECT COUNT(*) AS total_disponibles
            FROM `vue_objets_disponibles`
            WHERE Nom_Statut LIKE 'Disponible';";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['total_disponibles'];
}



?>