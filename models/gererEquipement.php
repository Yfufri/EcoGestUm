<?php

function getAvailableEquipments($conn)
{
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

function getNbObjectRecycled($conn)
{
    $sql = "SELECT COUNT(*) AS total_recycles
            FROM `vue_objets_disponibles`
            WHERE Nom_Statut NOT LIKE 'Disponible';";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['total_recycles'];
}

function getNbObjectDisponible($conn)
{
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
function consulterObjets(mysqli $conn, $mot_clef = null, $categorie = null, $point_collecte = null) {
    $sql = "SELECT 
                OBJET.Id_objet,
                Nom_objet,
                Desc_objet,
                Nom_categorie_objet,
                Nom_point_de_collecte,
                Nom_statut,
                Nom_utilisateur,
                Url_photo
            FROM OBJET
            INNER JOIN CATEGORIE_OBJET ON OBJET.Id_categorie_objet = CATEGORIE_OBJET.Id_categorie_objet
            INNER JOIN POINT_DE_COLLECTE ON OBJET.Id_point_collecte = POINT_DE_COLLECTE.Id_point_collecte
            INNER JOIN STATUT ON OBJET.Id_statut = STATUT.Id_statut
            INNER JOIN UTILISATEUR ON OBJET.Id_utilisateur = UTILISATEUR.Id_utilisateur
            LEFT JOIN PHOTO ON PHOTO.Id_objet = OBJET.Id_objet
            WHERE Nom_statut = 'Disponible'";

    $params = [];
    $types = '';

    if (!empty($mot_clef)) {
        $sql .= " AND (Nom_objet LIKE ? OR Desc_objet LIKE ?)";
        $mot_clef_param = "%$mot_clef%";
        $params[] = $mot_clef_param;
        $params[] = $mot_clef_param;
        $types .= 'ss';
    }
    if (!empty($categorie)) {
        $sql .= " AND Nom_categorie_objet LIKE ?";
        $params[] = "%$categorie%";
        $types .= 's';
    }
    if (!empty($point_collecte)) {
        $sql .= " AND Nom_point_de_collecte LIKE ?";
        $params[] = "%$point_collecte%";
        $types .= 's';
    }

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Erreur de préparation : " . $conn->error);
    }
    $bind_names = [];
    if (!empty($params)) {
        $bind_names[] = $types; // le premier argument est la chaîne de types
            for ($i=0; $i < count($params); $i++) {
                $bind_name = 'bind' . $i;
                $$bind_name = $params[$i];
                $bind_names[] = &$$bind_name; // référence
            }
        call_user_func_array([$stmt, 'bind_param'], $bind_names);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $rows = $result->fetch_all(MYSQLI_ASSOC);

    $stmt->close();

    return $rows;
}

// Fonction pour récupérer toutes les catégories d'objets
function getAllCategories(mysqli $conn) {
    $sql = "SELECT Id_categorie_objet, Nom_categorie_objet FROM CATEGORIE_OBJET";
    $result = $conn->query($sql);
    $categories = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
        $result->free();
    }
    return $categories;
}

// Fonction pour récupérer toutes les ponts de collecte
function getAllPointsCollecte($conn) {
    $sql = "SELECT Nom_point_de_collecte FROM POINT_DE_COLLECTE";
    $result = $conn->query($sql);
    $points_collecte = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $points_collecte[] = $row;
        }
        $result->free();
    }
    return $points_collecte;
}

function filtrerObjets(mysqli $conn, $categorie = null, $point_collecte = null) {
     // Appel direct de la procédure avec les deux paramètres (même s'ils sont null)
    $stmt = $conn->prepare("CALL filtrer_Objets_Disponibles(?, ?)");
    if (!$stmt) {
        die("Erreur de préparation : " . $conn->error);
    }
    $stmt->bind_param('ss', $categorie, $point_collecte); // 2 chaînes (ou null)

    $stmt->execute();
    $result = $stmt->get_result();
    $rows = $result->fetch_all(MYSQLI_ASSOC);

    $stmt->close();

    return $rows;
}

// Fonction pour récupérer un objet par son ID
function getObjetById(mysqli $conn, $id_objet) {
    $sql = "SELECT 
                OBJET.Id_objet,
                Nom_objet,
                Desc_objet,
                Nom_categorie_objet,
                Nom_point_de_collecte,
                Localisation_point_de_collecte,
                Nom_statut,
                Nom_utilisateur,
                Prenom_utilisateur,
                Url_photo
            FROM OBJET
            INNER JOIN CATEGORIE_OBJET ON OBJET.Id_categorie_objet = CATEGORIE_OBJET.Id_categorie_objet
            INNER JOIN POINT_DE_COLLECTE ON OBJET.Id_point_collecte = POINT_DE_COLLECTE.Id_point_collecte
            INNER JOIN STATUT ON OBJET.Id_statut = STATUT.Id_statut
            INNER JOIN UTILISATEUR ON OBJET.Id_utilisateur = UTILISATEUR.Id_utilisateur
            LEFT JOIN PHOTO ON PHOTO.Id_objet = OBJET.Id_objet
            WHERE OBJET.Id_objet = ? AND Nom_statut = 'Disponible'
            LIMIT 1";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id_objet);
    $stmt->execute();
    $result = $stmt->get_result();
    $objet = $result->fetch_assoc();
    $stmt->close();
    
    return $objet;
}


?>

