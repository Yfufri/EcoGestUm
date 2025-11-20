<?php
require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
session_start();

include __DIR__ . '/../models/gererBaseDeDonnees.php';
$conn = OpenCon();

$identifiant = $_POST['identifiant'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT Mot_de_passe, Id_utilisateur FROM CONNEXION WHERE Identifiant = ?");
$stmt->bind_param("s", $identifiant);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
     $stmt->bind_result($hash, $id_utilisateur);
     $stmt->fetch();
    if (password_verify($password, $hash)) {
         $_SESSION['id_utilisateur'] = $id_utilisateur;
        header('Location: index.php?login=success');
         exit;
    }
}
header('Location: ../views/connection.php?error=1');
exit;
?>
