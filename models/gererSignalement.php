<?php

function signalerObjet(mysqli $conn, int $idObjet, int $idUtilisateur, string $motif): bool
{
    $sql = "INSERT INTO SIGNALEMENT (Motif_signalement, Date_signalement, Id_objet, Id_utilisateur)
            VALUES (?, CURDATE(), ?, ?)";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        return false;
    }

    $stmt->bind_param('sii', $motif, $idObjet, $idUtilisateur);
    $ok = $stmt->execute();
    $stmt->close();

    return $ok;
}

?>