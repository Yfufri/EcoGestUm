<?php
function getUserFromConnection($conn, $mail)
{
    $sql = "SELECT *
            FROM utilisateur
            WHERE Mail_utilisateur = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $mail);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}
?>
