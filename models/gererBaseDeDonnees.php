<?php
// filepath: /Applications/MAMP/htdocs/BoukhedraYanis/EcoGestUmAPP/EcoGestUm/models/gererBaseDeDonnees.php

function openCon() {
    $conn = new mysqli(
        $_ENV["DB_HOST"], 
        $_ENV["DB_USER"],
        $_ENV["DB_PASSWORD"], 
        $_ENV["DB_NAME"],
        (int)$_ENV["DB_PORT"]  // ← AJOUT DU PORT
    );

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function updateAllPasswordsHashed($conn) {
    $sql = "SELECT Id_utilisateur, Prenom_utilisateur FROM utilisateur";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $id = $row['Id_utilisateur'];
        $prenom = $row['Prenom_utilisateur'];
        
        $newPassword = $prenom . "@";
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("UPDATE utilisateur SET Password_utilisateur = ? WHERE Id_utilisateur = ?");
        $stmt->bind_param("si", $hashedPassword, $id);
        $stmt->execute();
        echo "Password updated for : " . $prenom . "\n";
    }
    echo "C'est bon, tout est modifié :) \n";
}
?>