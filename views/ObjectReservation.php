<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/styleObjectReservation.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<div class="container">
    <h1>[Objet]</h1>
    <div class="bloc-objet">
        <div class="bloc-img">
            <img src="assets/ObjectBrowser/imageDefautObjectBrowser.png" alt="Mug rouge" class="object-img">
        </div>
        <div class="object-info">
            <div class="categorie-object">
                <p>Autre</p>
            </div>
            <div class="proprietaire">
                <p>Propriétaire : [Prénom] [Nom]</p>
            </div>
            <div class="description">
                <p>
                    Cet objet est proposé gratuitement dans le cadre du projet EcoGESTUM.<br>
                    Il est en très bon état et idéal pour une seconde vie.<br>
                    N'hésitez pas à consulter sa localisation sur la carte et à contacter le propriétaire pour plus
                    d'informations ou pour convenir d'un rendez-vous.
                </p>
            </div>
            <button class="btn-reserve">Réserver</button>
        </div>
    </div>
    <div class="carte-emplacement">
        <p class="titre-emplacement">Emplacement&nbsp;:</p>
        <div class="bloc-carte">
            <!-- Ici l'intégration (iframe, <img> ou composant JS) de ta carte interactive -->
            <div id="map"></div>
        </div>
    </div>


    <!--<script>
    // Définis les coordonnées du point central (exemple : Le Mans)
    var latitude = 48.0086;
    var longitude = 0.1985;
    var zoomLevel = 14;

    // Initialise la carte
    //alert("Script Leaflet lancé !");
    var map = L.map('map').setView([latitude, longitude], zoomLevel);

    // Ajoute OpenStreetMap comme fond
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Ajoute un marqueur
    L.marker([latitude, longitude]).addTo(map)
        .bindPopup('Emplacement du Mug !')
        .openPopup();
</script>-->
<script>  
    document.addEventListener("DOMContentLoaded", function () {
    var map = L.map('map', {
        preferCanvas: false
    }).setView([48.0086, 0.1985], 14);
    
    // Essaie avec une autre source de tuiles
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);
    
    L.marker([48.0086, 0.1985]).addTo(map).bindPopup('Emplacement du Mug !');
});
</script>