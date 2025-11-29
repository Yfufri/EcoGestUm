<?php

function getHistorique($conn)
{
    $sql = "SELECT Nom_objet,
                    Desc_objet,
                    ";
}

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
    $sql = "SELECT COUNT(*) AS total_recycles FROM objet WHERE Id_Statut=2;";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['total_recycles'];
}

function getNbObjectDisponible($conn)
{
    $sql = "SELECT COUNT(*) FROM objet where objet.Id_statut =1;";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['COUNT(*)'];
}

function addObject($conn, $nom_objet, $desc_objet, $id_categorie_objet, $id_point_de_collecte, $id_utilisateur, $id_statut)
{
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

function getNouveauPropriétaire($conn, $idObjet)
{
    $sql = "SELECT Date_reservation,reservation.id_utilisateur,Nom_utilisateur,Prenom_utilisateur,Mail_utilisateur FROM objet 
            INNER JOIN reservation ON objet.Id_objet = reservation.Id_objet 
            INNER JOIN utilisateur ON utilisateur.Id_utilisateur = reservation.Id_utilisateur 
            WHERE objet.Id_objet = ?";


    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idObjet);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();


    return $row;
}


function getObjetsByDepartement($conn, $idDepartement)
{
    $sql = "SELECT 
                o.Id_objet,
                o.Nom_objet,
                o.Desc_objet,
                c.Nom_categorie_objet,
                p.Nom_point_de_collecte,
                s.Nom_statut,
                u.Nom_utilisateur,
                u.Id_departement,
                o.Date_de_publication,
                MIN(ph.Url_photo) AS Url_photo
            FROM OBJET o
            INNER JOIN CATEGORIE_OBJET c ON o.Id_categorie_objet = c.Id_categorie_objet
            INNER JOIN POINT_DE_COLLECTE p ON o.Id_point_collecte = p.Id_point_collecte
            INNER JOIN STATUT s ON o.Id_statut = s.Id_statut
            INNER JOIN UTILISATEUR u ON o.Id_utilisateur = u.Id_utilisateur
            LEFT JOIN PHOTO ph ON ph.Id_objet = o.Id_objet
            WHERE u.Id_departement = ?
            GROUP BY o.Id_objet, o.Nom_objet, o.Desc_objet, c.Nom_categorie_objet, 
                     p.Nom_point_de_collecte, s.Nom_statut, u.Nom_utilisateur, 
                     u.Id_departement, o.Date_de_publication
            ORDER BY o.Date_de_publication DESC";


    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idDepartement);
    $stmt->execute();
    $result = $stmt->get_result();
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();


    return $rows;
}

function consulterAllObjets(mysqli $conn)
{
    $sql = "SELECT 
    o.Id_objet,
    o.Nom_objet,
    o.Desc_objet,
    c.Nom_categorie_objet,
    p.Nom_point_de_collecte,
    s.Id_statut,
    s.Nom_statut,
    u.Nom_utilisateur,
    u.Id_departement,
    o.Date_de_publication,
    MIN(ph.Url_photo) AS Url_photo
FROM OBJET o
INNER JOIN CATEGORIE_OBJET c ON o.Id_categorie_objet = c.Id_categorie_objet
INNER JOIN POINT_DE_COLLECTE p ON o.Id_point_collecte = p.Id_point_collecte
INNER JOIN STATUT s ON o.Id_statut = s.Id_statut
INNER JOIN UTILISATEUR u ON o.Id_utilisateur = u.Id_utilisateur
LEFT JOIN PHOTO ph ON ph.Id_objet = o.Id_objet
GROUP BY o.Id_objet, o.Nom_objet, o.Desc_objet, c.Nom_categorie_objet, p.Nom_point_de_collecte, s.Nom_statut, u.Nom_utilisateur
ORDER BY o.Date_de_publication DESC;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $rows;
}

function   consulterObjets(mysqli $conn, $mot_clef = null, $categorie = null, $point_collecte = null, $idUtilisateurConnecte = null)
{
    // Requête de base, avec WHERE statique
    $sql = "SELECT 
    o.Id_objet,
    o.Nom_objet,
    o.Desc_objet,
    c.Nom_categorie_objet,
    p.Nom_point_de_collecte,
    s.Nom_statut,
    s.Id_statut,
    u.Nom_utilisateur,
    o.Date_de_publication,
    MIN(ph.Url_photo) AS Url_photo
FROM OBJET o
INNER JOIN CATEGORIE_OBJET c ON o.Id_categorie_objet = c.Id_categorie_objet
INNER JOIN POINT_DE_COLLECTE p ON o.Id_point_collecte = p.Id_point_collecte
INNER JOIN STATUT s ON o.Id_statut = s.Id_statut
INNER JOIN UTILISATEUR u ON o.Id_utilisateur = u.Id_utilisateur
LEFT JOIN PHOTO ph ON ph.Id_objet = o.Id_objet
WHERE s.Nom_statut = 'Disponible'";

    $params = [];
    $types = '';

    if ($idUtilisateurConnecte !== null) {
        $sql .= " AND o.Id_utilisateur <> ?";
        $params[] = $idUtilisateurConnecte;
        $types .= 'i'; // entier
    }

    // On ajoute dynamiquement les filtres sous forme d'AND (si renseignés)
    if (!empty($mot_clef)) {
        $sql .= " AND (o.Nom_objet LIKE ? OR o.Desc_objet LIKE ?)";
        $mot_clef_param = "%$mot_clef%";
        $params[] = $mot_clef_param;
        $params[] = $mot_clef_param;
        $types .= 'ss';
    }
    if (!empty($categorie)) {
        $sql .= " AND c.Nom_categorie_objet LIKE ?";
        $params[] = "%$categorie%";
        $types .= 's';
    }
    if (!empty($point_collecte)) {
        $sql .= " AND p.Nom_point_de_collecte LIKE ?";
        $params[] = "%$point_collecte%";
        $types .= 's';
    }

    // Ajoute GROUP BY et ORDER BY à la fin (jamais avant les filtres)
    $sql .= " GROUP BY o.Id_objet, o.Nom_objet, o.Desc_objet, c.Nom_categorie_objet, p.Nom_point_de_collecte, s.Nom_statut, u.Nom_utilisateur";
    $sql .= " ORDER BY o.Id_objet ASC";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Erreur de préparation : " . $conn->error);
    }

    if (!empty($params)) {
        $bind_names = [];
        $bind_names[] = $types;
        foreach ($params as $i => $value) {
            $bind_name = 'bind' . $i;
            $$bind_name = $value;
            $bind_names[] = &$$bind_name;
        }
        call_user_func_array([$stmt, 'bind_param'], $bind_names);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $rows;
}

function   consulterMesObjets(mysqli $conn, $mot_clef = null, $categorie = null, $point_collecte = null, $idUtilisateurConnecte)
{
    $sql = "SELECT 
    o.Id_objet,
    o.Nom_objet,
    o.Desc_objet,
    c.Nom_categorie_objet,
    p.Nom_point_de_collecte,
    s.Nom_statut,
    s.Id_statut,
    u.Nom_utilisateur,
    o.Date_de_publication,
    MIN(ph.Url_photo) AS Url_photo
FROM OBJET o
INNER JOIN CATEGORIE_OBJET c ON o.Id_categorie_objet = c.Id_categorie_objet
INNER JOIN POINT_DE_COLLECTE p ON o.Id_point_collecte = p.Id_point_collecte
INNER JOIN STATUT s ON o.Id_statut = s.Id_statut
INNER JOIN UTILISATEUR u ON o.Id_utilisateur = u.Id_utilisateur
LEFT JOIN PHOTO ph ON ph.Id_objet = o.Id_objet
WHERE s.Id_statut IN (1, 2, 3)
";

    $params = [];
    $types = '';

    if ($idUtilisateurConnecte !== null) {
        $sql .= " AND o.Id_utilisateur = ?";
        $params[] = $idUtilisateurConnecte;
        $types .= 'i'; // entier
    }

    // On ajoute dynamiquement les filtres sous forme d'AND (si renseignés)
    if (!empty($mot_clef)) {
        $sql .= " AND (o.Nom_objet LIKE ? OR o.Desc_objet LIKE ?)";
        $mot_clef_param = "%$mot_clef%";
        $params[] = $mot_clef_param;
        $params[] = $mot_clef_param;
        $types .= 'ss';
    }
    if (!empty($categorie)) {
        $sql .= " AND c.Nom_categorie_objet LIKE ?";
        $params[] = "%$categorie%";
        $types .= 's';
    }
    if (!empty($point_collecte)) {
        $sql .= " AND p.Nom_point_de_collecte LIKE ?";
        $params[] = "%$point_collecte%";
        $types .= 's';
    }

    // Ajoute GROUP BY et ORDER BY à la fin (jamais avant les filtres)
    $sql .= " GROUP BY o.Id_objet, o.Nom_objet, o.Desc_objet, c.Nom_categorie_objet, p.Nom_point_de_collecte, s.Nom_statut, u.Nom_utilisateur";
    $sql .= " ORDER BY o.Id_objet ASC";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Erreur de préparation : " . $conn->error);
    }

    if (!empty($params)) {
        $bind_names = [];
        $bind_names[] = $types;
        foreach ($params as $i => $value) {
            $bind_name = 'bind' . $i;
            $$bind_name = $value;
            $bind_names[] = &$$bind_name;
        }
        call_user_func_array([$stmt, 'bind_param'], $bind_names);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $rows;
}

function consulterMesReservations(
    mysqli $conn, 
    $mot_clef = null, 
    $categorie = null, 
    $point_collecte = null, 
    $idUtilisateurConnecte
) {
    // Validation de l'ID utilisateur
    if (empty($idUtilisateurConnecte) || !is_numeric($idUtilisateurConnecte)) {
        return [];
    }

    $sql = "SELECT 
        o.Id_objet,
        o.Nom_objet,
        o.Desc_objet,
        o.Date_de_publication,
        c.Nom_categorie_objet,
        p.Nom_point_de_collecte,
        s.Nom_statut,
        s.Id_statut,
        r.Id_utilisateur as Id_reservateur,
        u.Nom_utilisateur as Nom_donateur,
        MIN(ph.Url_photo) AS Url_photo
    FROM RESERVATION r
    INNER JOIN OBJET o ON r.Id_objet = o.Id_objet
    INNER JOIN CATEGORIE_OBJET c ON o.Id_categorie_objet = c.Id_categorie_objet
    INNER JOIN POINT_DE_COLLECTE p ON o.Id_point_collecte = p.Id_point_collecte
    INNER JOIN STATUT s ON o.Id_statut = s.Id_statut
    INNER JOIN UTILISATEUR u ON o.Id_utilisateur = u.Id_utilisateur
    LEFT JOIN PHOTO ph ON ph.Id_objet = o.Id_objet
    WHERE r.Id_utilisateur = ?
      AND s.Id_statut IN (1, 2, 3)";

    $params = [$idUtilisateurConnecte];
    $types = 'i';

    // Filtres optionnels
    if (!empty($mot_clef)) {
        $sql .= " AND (o.Nom_objet LIKE ? OR o.Desc_objet LIKE ?)";
        $mot_clef_param = "%$mot_clef%";
        $params[] = $mot_clef_param;
        $params[] = $mot_clef_param;
        $types .= 'ss';
    }
    
    if (!empty($categorie)) {
        $sql .= " AND c.Nom_categorie_objet LIKE ?";
        $params[] = "%$categorie%";
        $types .= 's';
    }
    
    if (!empty($point_collecte)) {
        $sql .= " AND p.Nom_point_de_collecte LIKE ?";
        $params[] = "%$point_collecte%";
        $types .= 's';
    }

    // GROUP BY complet
    $sql .= " GROUP BY 
        o.Id_objet,
        o.Nom_objet,
        o.Desc_objet,
        o.Date_de_publication,
        c.Nom_categorie_objet,
        p.Nom_point_de_collecte,
        s.Nom_statut,
        s.Id_statut,
        r.Id_utilisateur,
        u.Nom_utilisateur
    ORDER BY o.Date_de_publication DESC";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        error_log("Erreur de préparation SQL : " . $conn->error);
        return [];
    }

    // Binding dynamique des paramètres
    $bind_names = [$types];
    foreach ($params as $i => $value) {
        $bind_name = 'bind' . $i;
        $$bind_name = $value;
        $bind_names[] = &$$bind_name;
    }
    call_user_func_array([$stmt, 'bind_param'], $bind_names);

    if (!$stmt->execute()) {
        error_log("Erreur d'exécution SQL : " . $stmt->error);
        $stmt->close();
        return [];
    }

    $result = $stmt->get_result();
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $rows;
}


// Fonction pour récupérer toutes les catégories d'objets
function getAllCategories(mysqli $conn)
{
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

function getAllPointsCollecte($conn)
{
    $sql = "SELECT * FROM POINT_DE_COLLECTE";
    $result = $conn->query($sql);

    $points_collecte = [];

    if ($result) {
        while ($row = $result->fetch_assoc()) {

            list($lat, $lng) = explode(',', $row['Localisation_point_de_collecte']);

            $points_collecte[] = [
                "id" => $row["Id_point_collecte"],
                "nom" => $row["Nom_point_de_collecte"],
                "lat" => floatval($lat),
                "lng" => floatval($lng)
            ];
        }
        $result->free();
    }

    return $points_collecte;
}

function ajouterObjet($mysqli, $nom, $description, $idUtilisateur, $idCategorie, $idPointCollecte)
{
    $sql = "INSERT INTO OBJET (Nom_objet, Desc_objet, Id_utilisateur, Id_categorie_objet, Id_point_collecte, Id_statut) 
            VALUES (?, ?, ?, ?, ?, 1)";

    $stmt = $mysqli->prepare($sql);

    $stmt->bind_param("ssiii", $nom, $description, $idUtilisateur, $idCategorie, $idPointCollecte);

    if ($stmt->execute()) {
        $objetId = $mysqli->insert_id;
        $stmt->close();
        return $objetId;
    } else {
        error_log("Erreur d'exécution : " . $stmt->error);
        $stmt->close();
        return null;
    }
}

function ajouterImage($mysqli, $idObjet, $urlPhoto)
{
    $sql = "INSERT INTO PHOTO (Url_photo, Id_objet) VALUES (?, ?)";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("si", $urlPhoto, $idObjet);

    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        error_log("Erreur d'exécution : " . $stmt->error);
        $stmt->close();
        return false;
    }
}

function filtrerObjets(mysqli $conn, $categorie = null, $point_collecte = null)
{
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
function getObjetById(mysqli $conn, $id_objet)
{
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
                Mail_utilisateur,
                Url_photo
            FROM OBJET
            INNER JOIN CATEGORIE_OBJET ON OBJET.Id_categorie_objet = CATEGORIE_OBJET.Id_categorie_objet
            INNER JOIN POINT_DE_COLLECTE ON OBJET.Id_point_collecte = POINT_DE_COLLECTE.Id_point_collecte
            INNER JOIN STATUT ON OBJET.Id_statut = STATUT.Id_statut
            INNER JOIN UTILISATEUR ON OBJET.Id_utilisateur = UTILISATEUR.Id_utilisateur
            LEFT JOIN PHOTO ON PHOTO.Id_objet = OBJET.Id_objet
            WHERE OBJET.Id_objet = ? 
            LIMIT 1";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id_objet);
    $stmt->execute();
    $result = $stmt->get_result();
    $objet = $result->fetch_assoc();
    $stmt->close();

    return $objet;
}

function reserverObjet(mysqli $conn, int $idObjet, int $idUtilisateur): bool
{
    if (empty($idObjet) || empty($idUtilisateur)) {
        error_log("Paramètres invalides pour la réservation");
        return false;
    }

    $conn->begin_transaction();
    try {
        $sqlCheck = "SELECT Id_statut FROM OBJET WHERE Id_objet = ? AND Id_statut = 1";
        $stmtCheck = $conn->prepare($sqlCheck);
        
        if (!$stmtCheck) {
            throw new Exception("Erreur de préparation de la vérification : " . $conn->error);
        }
        
        $stmtCheck->bind_param('i', $idObjet);
        $stmtCheck->execute();
        $resultCheck = $stmtCheck->get_result();
        
        if ($resultCheck->num_rows === 0) {
            $stmtCheck->close();
            throw new Exception("L'objet n'existe pas ou n'est plus disponible");
        }
        $stmtCheck->close();

        $sqlInsert = "INSERT INTO RESERVATION (Date_reservation, Id_utilisateur, Id_objet) 
                      VALUES (NOW(), ?, ?)";
        $stmtInsert = $conn->prepare($sqlInsert);
        
        if (!$stmtInsert) {
            throw new Exception("Erreur de préparation de l'insertion : " . $conn->error);
        }
        
        $stmtInsert->bind_param('ii', $idUtilisateur, $idObjet);
        
        if (!$stmtInsert->execute()) {
            throw new Exception("Erreur lors de l'insertion de la réservation : " . $stmtInsert->error);
        }
        $stmtInsert->close();

        $sqlUpdate = "UPDATE OBJET SET Id_statut = 2 WHERE Id_objet = ?";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        
        if (!$stmtUpdate) {
            throw new Exception("Erreur de préparation de la mise à jour : " . $conn->error);
        }
        
        $stmtUpdate->bind_param('i', $idObjet);
        
        if (!$stmtUpdate->execute()) {
            throw new Exception("Erreur lors de la mise à jour du statut : " . $stmtUpdate->error);
        }
        $stmtUpdate->close();
        $conn->commit();
        return true;

    } catch (Exception $e) {
        $conn->rollback();
        error_log("Erreur lors de la réservation : " . $e->getMessage());
        return false;
    }
}

function getObjetReserve($conn, $idUtilisateur)
{
    $sql = "SELECT objet.Nom_objet,utilisateur.Prenom_utilisateur,utilisateur.Nom_utilisateur,point_de_collecte.Nom_point_de_collecte FROM reservation
        INNER JOIN objet
        	ON objet.Id_objet=reservation.Id_objet
        INNER JOIN utilisateur -- proprietaire
        	ON objet.Id_utilisateur = utilisateur.Id_utilisateur
        INNER JOIN point_de_collecte
        	ON objet.Id_point_collecte=point_de_collecte.Id_point_collecte
        WHERE reservation.Id_utilisateur= ?
        ORDER BY reservatio  n.Date_reservation ASC";


    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idUtilisateur);
    $stmt->execute();
    $result = $stmt->get_result();
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $rows;
}

function getPhotosByObjet(mysqli $conn, int $idObjet): array
{
    $sql = "SELECT Url_photo FROM PHOTO WHERE Id_objet = ? ORDER BY Url_photo";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $idObjet);
    $stmt->execute();
    $result = $stmt->get_result();
    $photos = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $photos;
}

function supprimerObjet(mysqli $conn, int $idObjet): bool
{
    $sql = "UPDATE objet SET Id_statut = 4 WHERE Id_objet = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $idObjet);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}

function supprimerReservation(mysqli $conn, int $idObjet): bool
{
    $sql = "DELETE FROM RESERVATION WHERE Id_objet = ?;
    UPDATE objet SET Id_statut = 1 WHERE Id_objet = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $idObjet, $idObjet);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}

?>