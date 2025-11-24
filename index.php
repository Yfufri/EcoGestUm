<?php
// filepath: /Applications/MAMP/htdocs/BoukhedraYanis/EcoGestUmAPP/EcoGestUm/index.php

// ============================================
// 1. CONFIGURATION ET INITIALISATION
// ============================================
require_once __DIR__ . '/vendor/autoload.php';

// Charger les variables d'environnement
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Démarrer la session
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Connexion à la base de données
include "models/gererBaseDeDonnees.php";
$conn = OpenCon();

// ============================================
// 2. RÉCUPÉRATION DES PARAMÈTRES
// ============================================
$action = $_GET['action'] ?? 'accueil';

// ============================================
// 3. ROUTAGE ET CONTRÔLEURS
// ============================================
switch($action) {
    
    // ===== PAGE D'ACCUEIL =====
    case 'accueil':
        include "views/header.php";
        include "views/welcome.php";
        include "views/footer.php";
        break;
    
    // ===== ÉVÉNEMENTS =====
    case 'evenements':
        include "controllers/Evenement.php";
        break;
    
    // ===== INSCRIPTION À UN ÉVÉNEMENT =====
    case 'inscription':
        include "controllers/Inscription.php";
        break;
    
    // ===== STATISTIQUES =====
    case 'statistiques':
        include "controllers/Statistics.php";
        break;
    
    // ===== POLITIQUE DE RECYCLAGE =====
    case 'politique':
        include "views/header.php";
        include "views/politiqueDeRecyclage.php";
        include "views/footer.php";
        break;
    
    // ===== AUTHENTIFICATION =====
    case 'login':
        include "controllers/login.php";
        break;
    
    case 'logout':
        include "controllers/logout.php";
        break;
    
    // ===== PAGE PAR DÉFAUT =====
    default:
        include "views/header.php";
        include "views/Accueil.php";
        include "views/footer.php";
        break;
}

// Fermer la connexion
$conn->close();
?>