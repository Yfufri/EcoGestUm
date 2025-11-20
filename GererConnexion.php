<?php

require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

include "models/gererBaseDeDonnees.php";
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
        echo "Connexion réussie. Bienvenue !";
        //header("Location: views/accueil_etudiant.php   "); 
        exit;
    } else {
        echo "Identifiant ou mot de passe incorrect.";
    }
} else {
    echo "Identifiant ou mot de passe incorrect.";
}

$stmt->close();


?>