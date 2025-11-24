<?php
// filepath: /Applications/MAMP/htdocs/BoukhedraYanis/EcoGestUmAPP/EcoGestUm/controllers/Statistics.php

include "models/gererEquipement.php";
include "models/gererEvenement.php";

$nbObjetRecycle = getNbObjectRecycled($conn);
$nbEvenementPasse = getNbPastEvent($conn);
$nbObjetDisponible = getNbObjectDisponible($conn);

// Données pour le graphique d'évolution
$evolutionData = [
    ['Jan', 45],
    ['Fév', 52],
    ['Mar', 61],
    ['Avr', 58],
    ['Mai', 72],
    ['Juin', 85],
    ['Juil', 78],
    ['Août', 90],
    ['Sep', 95],
    ['Oct', 88],
    ['Nov', 102],
    ['Déc', 110]
];

// Données pour le diagramme circulaire (répartition par type d'objets)
$repartitionData = [
    ['Livre', 35, '#22c55e'],
    ['Matériel informatique', 25, '#3b82f6'],
    ['Mobilier', 20, '#eab308'],
    ['Fournitures', 12, '#f97316'],
    ['Autres', 8, '#06b6d4']
];

include "views/StatistiquesEnvironnementales.php";
?>