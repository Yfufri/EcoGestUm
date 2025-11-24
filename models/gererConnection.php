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

$user = getUserFromConnection($conn, $mail, $password);
if (!empty($user)) {
    $user = getUserFromConnection($conn, $mail);
    if ($user && password_verify($password, $user['Password_utilisateur'])) {
        $_SESSION['user'] = $user;
    } else {
        header("Location: index.php?action=login&error=1");
    }
}
?>