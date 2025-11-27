
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/stylePC.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>


<div class="points-collecte-container">
    <h2>Tout les Points de Collecte</h2>
    <div class="PCcontent">

        <div class="toggle-buttons">
            <button onclick="showMans()">Voir Le Mans</button>
            <button onclick="showLaval()">Voir Laval</button>
        </div>
        <div id="map"></div>
    </div>
</div>


<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    let points = <?php echo json_encode($points); ?>;
    let map = L.map('map').setView([48.0, 0.2], 8);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    points.forEach(p => {
        L.marker([p.lat, p.lng]).bindPopup(p.nom).addTo(map);
    });

    function showMans() {
        map.setView([48.00, 0.20], 12);  // ou map.flyTo([...], 12);
    }
    function showLaval() {
        map.setView([48.07, -0.77], 12); // ou map.flyTo([...], 12);
    }
</script>