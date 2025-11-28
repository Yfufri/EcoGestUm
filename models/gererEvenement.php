<?php
function getNbPastEvent($conn) {
    $sql = "SELECT COUNT(*) as count FROM Evenement WHERE Date_evenement < CURDATE()";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['count'];
}

function getNbEvent($conn) {
    $sql = 'SELECT COUNT(*) as count FROM Evenement';
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

// Fonction pour inscrire une personne  à un événement
function inscrirePersonneEvenement($conn, $nom, $prenom, $email, $id_evenement) {
    // Vérifier si l'événement existe
    $stmt = $conn->prepare("SELECT Id_evenement FROM EVENEMENT WHERE Id_evenement = ?");
    $stmt->bind_param("i", $id_evenement);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        return ['success' => false, 'message' => 'Événement introuvable'];
    }
    
    // Vérifier si la personne n'est pas déjà inscrite
    $stmt = $conn->prepare("SELECT Id_inscription_externe FROM INSCRIPTION_EXTERNE WHERE Email = ? AND Id_evenement = ?");
    $stmt->bind_param("si", $email, $id_evenement);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        return ['success' => false, 'message' => 'Vous êtes déjà inscrit à cet événement'];
    }
    
    // Insérer l'inscription dans la table INSCRIPTION_EXTERNE
    $stmt = $conn->prepare("INSERT INTO INSCRIPTION_EXTERNE (Nom, Prenom, Email, Id_evenement) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $nom, $prenom, $email, $id_evenement);
    
    if ($stmt->execute()) {
        return ['success' => true, 'message' => 'Inscription réussie ! Merci pour votre participation.'];
    } else {
        return ['success' => false, 'message' => 'Erreur lors de l\'inscription: ' . $stmt->error];
    }
}

// Sépare les événements par localisation (Le Mans et Laval)
$evenementsLeMans = [];
$evenementsLaval = [];

$today = date('Y-m-d');

// Récupère tous les événements avec leur image (LEFT JOIN car certains événements peuvent ne pas avoir d'image)
$sql = "SELECT e.Id_evenement, e.Nom_evenement, e.Description, 
        e.Date_evenement, e.Localisation_evenement,
        e.Id_categorie_evenement,
        i.Url_image
        FROM EVENEMENT e
        LEFT JOIN IMAGE_EVENEMENT i ON e.Id_evenement = i.Id_evenement
        ORDER BY e.Date_evenement ASC";
$result = $conn->query($sql);
// Trie les événements selon leur localisation
while ($event = $result->fetch_assoc()) {
    $localisation = strtolower($event['Localisation_evenement']);
    
    // Vérifie si l'événement est à Le Mans ou Laval
    if (strpos($localisation, 'le mans') !== false) {
        $evenementsLeMans[] = $event;
    } elseif (strpos($localisation, 'laval') !== false) {
        $evenementsLaval[] = $event;
    }
}

// Page inscription
if (isset($_GET['id'])) {
    $evenement = getInfoEvent($conn, $_GET['id']);
}
?>
