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
    $sql = "SELECT COUNT(*) AS total_disponibles
            FROM `vue_objets_disponibles`
            WHERE Nom_Statut LIKE 'Disponible';";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['total_disponibles'];
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

function consulterObjets(mysqli $conn, $mot_clef = null, $categorie = null, $point_collecte = null, $idUtilisateurConnecte = null)
{
    // Requête de base, avec WHERE statique
    $sql = "SELECT 
    o.Id_objet,
    o.Nom_objet,
    o.Desc_objet,
    c.Nom_categorie_objet,
    p.Nom_point_de_collecte,
    s.Nom_statut,
    u.Nom_utilisateur,
    o.Date_de_publication,
    MIN(ph.Url_photo) AS Url_photo
FROM OBJET o
INNER JOIN CATEGORIE_OBJET c ON o.Id_categorie_objet = c.Id_categorie_objet
INNER JOIN POINT_DE_COLLECTE p ON o.Id_point_collecte = p.Id_point_collecte
INNER JOIN STATUT s ON o.Id_statut = s.Id_statut
INNER JOIN UTILISATEUR u ON o.Id_utilisateur = u.Id_utilisateur
LEFT JOIN PHOTO ph ON ph.Id_objet = o.Id_objet
WHERE s.Nom_statut = 'Disponible'" /*AND u.Id_utilisateur<>?*/ ;

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

    // Bind des paramètres (s'il y en a)
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
    $sql = "SELECT Nom_point_de_collecte, Localisation_point_de_collecte FROM POINT_DE_COLLECTE";
    $result = $conn->query($sql);

    $points_collecte = [];

    if ($result) {
        while ($row = $result->fetch_assoc()) {

            list($lat, $lng) = explode(',', $row['Localisation_point_de_collecte']);

            $points_collecte[] = [
                "nom" => $row["Nom_point_de_collecte"],
                "lat" => floatval($lat),
                "lng" => floatval($lng)
            ];
        }
        $result->free();
    }

    return $points_collecte;
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

function reserverObjet(mysqli $conn, int $idUtilisateur, int $idObjet): bool
{
    // Appel de la procédure stockée pour réservation et mise à jour statut
    $stmt = $conn->prepare("CALL ReserverObjetAvecVue(?, ?)");
    if (!$stmt) {
        return false;
    }
    $stmt->bind_param('ii', $idUtilisateur, $idObjet);
    $stmt->execute();
    $stmt->close();

    // La requête ayant changé les données, il vaut mieux reconnecter pour poursuivre les requêtes simples après procédure
    $conn->next_result();
    return true;
}

?>