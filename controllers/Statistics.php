<?php
include "models/voirStatistiques.php";


// Données pour le graphique d'évolution
/*$evolutionData = [
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
];*/

$evolutionData = getEvolutionMensuelle($conn);

// Formatage labels lisibles (ex: "2025-11" → "Nov 2025")
$evolutionLabels = [];
$evolutionValues = array_column($evolutionData, 'nb_objets');
foreach(array_column($evolutionData, 'mois') as $mois) {
    $date = DateTime::createFromFormat('Y-m', $mois);
    $evolutionLabels[] = $date ? $date->format('M y') : $mois;
}



// CAMEMBERT - Données réelles de la BDD
$repartitionData = getRepartitionObjets($conn);
$labels = array_column($repartitionData, 'label');
$values = array_column($repartitionData, 'valeur');
$colors = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#FF9584', '#C9CBCF'];
$chartData = [
    'labels' => $labels,
    'values' => $values,
    'colors' => array_slice($colors, 0, count($labels))
];

include "views/StatistiquesEnvironnementales.php";
?>