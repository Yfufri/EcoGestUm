<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/stylePC.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-search/dist/leaflet-search.min.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-search/dist/leaflet-search.min.js"></script>


<section class="points-collecte-container">
    <h2>Tout les Points de Collecte</h2>
    <div class="PCcontent">

        <div class="toggle-buttons">
            <button onclick="showMans()">Voir Le Mans</button>
            <button onclick="showLaval()">Voir Laval</button>
        </div>
        <div id="map"></div>
    </div>
</section>


<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-search/dist/leaflet-search.min.js"></script>

<script>
    let points = <?php echo json_encode($points); ?>;
    let map = L.map('map').setView([48.0, 0.2], 8);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    let markersLayer = new L.LayerGroup();
    map.addLayer(markersLayer);

    points.forEach(p => {
        let marker = L.marker([p.lat, p.lng], {
            title: p.nom
        }).bindPopup(p.nom);
        markersLayer.addLayer(marker);
    });

    let searchControl = new L.Control.Search({
        layer: markersLayer,
        propertyName: 'title',
        marker: false,
        moveToLocation: function(latlng, title, map) {
            map.setView(latlng, 18);
        },
        textPlaceholder: 'Rechercher un point de collecte...',
        textErr: 'Point non trouvé',
        textCancel: 'Annuler',
        initial: false,
        zoom: 18, 
        autoCollapse: true,
        autoType: false,
        minLength: 2
    });

    map.addControl(searchControl);

 function showMans() {
    map.setView([48.01698, 0.1616], 16); 
}
    
function showLaval() {
    map.setView([48.0866, -0.75796], 16); 
}
</script>