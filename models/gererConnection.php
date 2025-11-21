<?php
function getUserFromConnection($conn, $mail, $password)
{
    $sql = "SELECT *
            FROM utilisateur
            WHERE Mail_utilisateur = ? AND Prenom_utilisateur = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $mail, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}
?>