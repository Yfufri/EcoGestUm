<?php

function getAvailableEquipments($conn) { 
    $sql = "SELECT Nom_objet,
                    Desc_objet,
                    Nom_categorie_objet,
                    Nom_point_de_collecte,
                    Localisation_point_de_collecte,
                    Nom_utilisateur,Nom_statut,Url_photo
                 FROM vue_objets_disponibles";
    $result = $conn->query($sql);


    return $result->fetch_all(MYSQLI_ASSOC);
}

function getNbObjectRecycled($conn) {
    $sql = "SELECT COUNT(*) AS total_recycles
            FROM `vue_objets_disponibles`
            WHERE Nom_Statut NOT LIKE 'Disponible';";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['total_recycles'];
}

function getNbObjectDisponible($conn) {
    $sql = "SELECT COUNT(*) AS total_disponibles
            FROM `vue_objets_disponibles`
            WHERE Nom_Statut LIKE 'Disponible';";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['total_disponibles'];
}

function addObject($conn, $nom_objet, $desc_objet, $id_categorie_objet, $id_point_de_collecte, $id_utilisateur, $id_statut) {
    $stmt = $conn->prepare("INSERT INTO Objet (Nom_objet, 
                                                Desc_objet, 
                                                Id_categorie_objet, 
                                                Id_point_de_collecte, 
                                                Id_utilisateur, 
                                                Id_statut) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiiii", $nom_objet, $desc_objet, $id_categorie_objet, $id_point_de_collecte, $id_utilisateur, $id_statut);
    
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}


?>