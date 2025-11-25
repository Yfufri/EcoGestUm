<link
  rel="stylesheet"
  href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
  integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
  crossorigin="">
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/stylePC.css">


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

<!-- ⚠️ LES SCRIPTS DOIVENT ÊTRE EN DEHORS DES BLOCS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    let points = <?php echo json_encode($points); ?>;

    let map = L.map('map').setView([48.0, 0.2], 8);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19
    }).addTo(map);

    let groupMans = L.layerGroup();
    let groupLaval = L.layerGroup();

    points.forEach(p => {
        let marker = L.marker([p.lat, p.lng]).bindPopup(p.nom);

        if (p.ville === "mans") {
            groupMans.addLayer(marker);
        } else if (p.ville === "laval") {
            groupLaval.addLayer(marker);
        }
    });

    groupMans.addTo(map);

    function showMans() {
        map.addLayer(groupMans);
        map.removeLayer(groupLaval);
        map.setView([48.00, 0.20], 12);
    }

    function showLaval() {
        map.addLayer(groupLaval);
        map.removeLayer(groupMans);
        map.setView([48.07, -0.77], 12);
    }
</script>