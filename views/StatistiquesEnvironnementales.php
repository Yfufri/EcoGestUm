<?php
// filepath: /Applications/MAMP/htdocs/BoukhedraYanis/EcoGestUmAPP/EcoGestUm/views/StatistiquesEnvironnementales.php
?>
<link rel="stylesheet" href="assets/css/styleStatistiques.css?v=<?= time() ?>">

<div class="stats-container">
    <div class="stats-header">
        <h1>Statistiques Environnementales</h1>
    </div>

    <!-- Graphiques -->
    <div class="charts-section">
        <div class="chart-card">
            <h3>Évolution du recyclage par mois - Université du Mans (campus Sud)</h3>
            <canvas id="evolutionChart"></canvas>
        </div>

        <div class="chart-card">
            <h3>Répartition par type d'objets recyclés - Université du Mans (Nord)</h3>
            <canvas id="repartitionChart"></canvas>
        </div>
    </div>

    <!-- Rapports -->
    <div class="rapports-section">
        <h2>Rapports</h2>
        
        <div class="rapport-card">
            <h3>Rapport annuel sur le recyclage universitaire</h3>
            <p class="rapport-subtitle">Année 2025 - Université ÉcoGestUM</p>
            <p class="rapport-date">Date : 15 janvier 2026</p>
            
            <div class="rapport-content">
                <p>Ce rapport présente les résultats obtenus en matière de gestion et de valorisation des déchets au sein de l'Université du Mans au cours de l'année 2025.</p>
                
                <p>L'application ÉcoGestUM a permis de centraliser les données issues des différents services et composantes, ce qui facilite le suivi et l'analyse (matériel informatique, papier, etc.).</p>
                
                <div class="rapport-stats">
                    <p><strong>Les principaux enseignements de cette année sont :</strong></p>
                    <ul>
                        <li>Une augmentation globale de 22 % du volume recyclé par rapport à 2024.</li>
                        <li>Une forte progression dans la réutilisation des appareils informatiques (+35 %)</li>
                        <li>Un taux de participation aux événements écologiques de 68 % sur le campus du Mans et de Laval.</li>
                        <li>Lancement réussi de 12 ateliers de sensibilisation touchant plus de 400 étudiants et personnels.</li>
                    </ul>
                </div>
                
                <p class="rapport-conclusion">Ces résultats confirment l'efficacité de notre démarche collective et encouragent la poursuite des efforts en matière de développement durable.</p>
                
                <p class="rapport-signature"><strong>Président de l'Université du Mans</strong></p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Graphique d'évolution
const evolutionCtx = document.getElementById('evolutionChart').getContext('2d');
const evolutionChart = new Chart(evolutionCtx, {
    type: 'line',
    data: {
        labels: <?= json_encode(array_column($evolutionData, 0)) ?>,
        datasets: [{
            label: 'Nombre d\'objets recyclés',
            data: <?= json_encode(array_column($evolutionData, 1)) ?>,
            borderColor: '#f97316',
            backgroundColor: 'rgba(249, 115, 22, 0.1)',
            tension: 0.4,
            fill: true,
            pointBackgroundColor: '#f97316',
            pointBorderColor: '#fff',
            pointBorderWidth: 2,
            pointRadius: 5
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: '#e2e8f0'
                }
            },
            x: {
                grid: {
                    display: false
                }
            }
        }
    }
});

// Graphique circulaire
const repartitionCtx = document.getElementById('repartitionChart').getContext('2d');
const repartitionChart = new Chart(repartitionCtx, {
    type: 'doughnut',
    data: {
        labels: <?= json_encode(array_column($repartitionData, 0)) ?>,
        datasets: [{
            data: <?= json_encode(array_column($repartitionData, 1)) ?>,
            backgroundColor: <?= json_encode(array_column($repartitionData, 2)) ?>,
            borderWidth: 3,
            borderColor: '#fff'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: {
                position: 'right',
                labels: {
                    padding: 20,
                    font: {
                        size: 13
                    }
                }
            }
        }
    }
});
</script>