<?php
// Charger les variables d'environnement
$env = parse_ini_file(__DIR__ . '/../.env');

// Créer la connexion PDO
try {
    $conn = new PDO(
        'mysql:host=' . $env['DB_HOST'] . ';dbname=' . $env['DB_NAME'] . ';charset=utf8mb4',
        $env['DB_USER'],
        $env['DB_PASSWORD'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    die('Erreur connexion BD: ' . $e->getMessage());
}
?>