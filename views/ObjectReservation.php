<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/styleObjectReservation.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<!--<div class="container">
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
            Ici l'intégration (iframe, <img> ou composant JS) de ta carte interactive
            <div id="map"></div>
        </div>
    </div>
</div>-->


<div class="header-objet">
    <a href="index.php?action=ObjectBrowser" class="retour-objets" title="Retour à la liste">
        <img src="assets/ObjectReservation/image1.png" alt="Retour">
    </a>
    <h1><?php echo htmlspecialchars($objet['Nom_objet']); ?></h1>
    <div class="header-spacer"></div>
</div>
<div class="bloc-objet">
    <div class="bloc-img">
        <?php
        $url_photo = !empty($objet['Url_photo']) ? htmlspecialchars($objet['Url_photo']) : 'assets/ObjectBrowser/imageDefautObjectBrowser.png';
        ?>
        <img src="<?php echo $url_photo; ?>" alt="<?php echo htmlspecialchars($objet['Nom_objet']); ?>"
            class="object-img">
    </div>
    <div class="object-info">
        <div class="categorie-object">
            <p><?php echo htmlspecialchars($objet['Nom_categorie_objet']); ?></p>
        </div>
        <div class="proprietaire">
            <p>Propriétaire : <?php echo htmlspecialchars($objet['Prenom_utilisateur']); ?>
                <?php echo htmlspecialchars($objet['Nom_utilisateur']); ?></p>
        </div>
        <div class="description">
            <p><?php echo nl2br(htmlspecialchars($objet['Desc_objet'])); ?></p>
        </div>
        <button class="btn-reserve">Réserver</button>
    </div>
</div>
<div class="carte-emplacement">
        <p class="titre-emplacement">Emplacement&nbsp;:</p>
        <div class="bloc-carte">
            <!--Ici l'intégration (iframe, <img> ou composant JS) de ta carte interactive-->
            <div id="map"></div>
        </div>
</div>

<?php
$localisation = $objet['Localisation_point_de_collecte'] ?? '';
$latitude = $longitude = null;

// Test si la chaîne existe et contient une virgule
if (!empty($localisation) && strpos($localisation, ',') !== false) {
    list($latitude, $longitude) = explode(',', $localisation);
}
?>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Valeurs par défaut (Le Mans)
    var mapCenterLat = 48.0086;
    var mapCenterLng = 0.1985;

    // Test si localisation fournie et valide
    var hasCoords = <?php echo ($latitude !== null && $longitude !== null && $latitude !== '' && $longitude !== '') ? 'true' : 'false'; ?>;
    if (hasCoords) {
        mapCenterLat = <?php echo floatval($latitude); ?>;
        mapCenterLng = <?php echo floatval($longitude); ?>;
    }

    var map = L.map('map').setView([mapCenterLat, mapCenterLng], 14);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Ajoute le marqueur SEULEMENT si coordonnées présentes
    if (hasCoords) {
        L.marker([mapCenterLat, mapCenterLng]).addTo(map)
            .bindPopup('Emplacement de l\'objet !');
    }
});
</script>
