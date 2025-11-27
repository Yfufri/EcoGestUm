<?php
include 'models/gererConnection.php';

$user = getUserFromConnection($conn, $mail);
if (!empty($user)) {
    if ($user && password_verify($password, $user['Password_utilisateur'])) {
        $_SESSION['user'] = $user;
    } else {
        header("Location: index.php?action=login&error=1");
    }
} else{
    header("Location: index.php?action=login&error=1");
}

?>