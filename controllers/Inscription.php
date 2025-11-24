<?php
// filepath: /Applications/MAMP/htdocs/BoukhedraYanis/EcoGestUmAPP/EcoGestUm/controllers/Inscription.php

// Vérifier si un ID est fourni
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: ?action=evenements');
    exit();
}

include "models/gererEvenement.php";

// Récupérer l'événement
$evenement = getInfoEvent($conn, $_GET['id']);

// Si l'événement n'existe pas, rediriger
if (!$evenement) {
    header('Location: ?action=evenements');
    exit();
}

// Variable pour stocker le message
$inscriptionMessage = null;

// Traitement du formulaire d'inscription
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom'])) {
    $nom = trim($_POST['nom'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $id_evenement = $_GET['id'];
    
    // Validation des données
    if (empty($nom) || empty($prenom) || empty($email)) {
        $inscriptionMessage = [
            'success' => false, 
            'message' => 'Tous les champs sont obligatoires'
        ];
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $inscriptionMessage = [
            'success' => false, 
            'message' => 'Adresse email invalide'
        ];
    } else {
        // Tenter l'inscription
        $inscriptionMessage = inscrirePersonneEvenement($conn, $nom, $prenom, $email, $id_evenement);
    }
}

// Afficher la vue
include "views/header.php";
include "views/inscription.php";
include "views/footer.php";
?>