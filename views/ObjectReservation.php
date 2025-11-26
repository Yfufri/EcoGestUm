<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/styleObjectReservation.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>


<div class="header-objet">
    <a href="index.php?action=chercherObjet" class="retour-objets" title="Retour à la liste">
        <img src="assets/ObjectReservation/image1.png" alt="Retour">
    </a>
    <h1><?php echo htmlspecialchars($objet['Nom_objet']); ?></h1>
    <div class="header-spacer"></div>
</div>
<div class="bloc-objet">
    <div class="bloc-img">
        <?php
        $url_photo = !empty($objet['Url_photo']) ? htmlspecialchars("assets/" . $objet['Url_photo']) : 'assets/ObjectBrowser/imageDefautObjectBrowser.png';
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
                <?php echo htmlspecialchars($objet['Nom_utilisateur']); ?>
            </p>
        </div>
        <div class="description">
            <p><?php echo nl2br(htmlspecialchars($objet['Desc_objet'])); ?></p>
        </div>
        <form method="POST" action="index.php?action=reservation&id=<?= htmlspecialchars($objet['Id_objet']) ?>"
            id="form-reserve">
            <button type="button" id="btn-reserve" class="btn-reserve <?= $reservé ? 'clicked' : '' ?>" <?= $reservé ? 'disabled' : '' ?>>
                <?= $reservé ? 'Réservé' : 'Réserver' ?>
            </button>
        </form>
        <!--Modale cachée double check du bouton Réserver-->
        <div id="confirm-modal" class="modal-overlay">
            <div class="modal-content">
                <p>Êtes-vous sûr de vouloir réserver cet objet ?</p>
                <button id="modal-yes">Oui</button>
                <button id="modal-no">Non</button>
            </div>
        </div>

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
// Récupération de la localisation et séparation en latitude et longitude
$localisation = $objet['Localisation_point_de_collecte'] ?? '';
$latitude = $longitude = null;

// Test si la chaîne existe et contient une virgule
if (!empty($localisation) && strpos($localisation, ',') !== false) {
    list($latitude, $longitude) = explode(',', $localisation);
}
?>


<!--Script pour la carte Intéractive-->
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

<!--Script pour la gestion du bouton Réserver-->
<!-- Modale de confirmation -->
<script>
    const modal = document.getElementById('confirm-modal');
    const btnYes = document.getElementById('modal-yes');
    const btnNo = document.getElementById('modal-no');
    const btnReserve = document.getElementById('btn-reserve');
    const formReserve = document.getElementById('form-reserve');

    btnReserve.addEventListener('click', function () {
        if (this.disabled) return;
        modal.classList.add('active');
    });

    btnNo.addEventListener('click', function () {
        modal.classList.remove('active');
    });

    btnYes.addEventListener('click', function () {
        modal.classList.remove('active');
        formReserve.submit();
    });

</script>

<!--Changement visuel du bouton après clic-->
<script>
    document.getElementById('form-reserve').addEventListener('submit', function () {
        const btn = document.getElementById('btn-reserve');
        btn.disabled = true;          // Désactive le bouton pour empêcher double clic
        btn.classList.add('clicked');  // Change la couleur en vert immédiatement
        btn.textContent = 'Réservé';  // Change le texte du bouton immédiatement
    });
</script>