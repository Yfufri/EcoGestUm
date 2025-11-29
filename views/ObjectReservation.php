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
        $nbPhotos = count($photos);
        ?>

        <?php if ($nbPhotos > 1): ?>
            <div class="photos-carousel-container">
                <button class="carousel-arrow left" onclick="scrollPhotos('photos-grid', -1)">‹</button>

                <div class="photos-grid" id="photos-grid">
                    <?php foreach ($photos as $photo): ?>
                        <div class="photo-card">
                            <img src="<?= htmlspecialchars('assets/' . $photo['Url_photo']) ?>"
                                alt="Photo de <?= htmlspecialchars($objet['Nom_objet']) ?>">
                        </div>
                    <?php endforeach; ?>
                </div>

                <button class="carousel-arrow right" onclick="scrollPhotos('photos-grid', 1)">›</button>
            </div>
        <?php elseif ($nbPhotos === 1): ?>
            <div class="photo-single">
                <img src="<?= htmlspecialchars('assets/' . $photos[0]['Url_photo']) ?>"
                    alt="Photo de <?= htmlspecialchars($objet['Nom_objet']) ?>" class="object-img">
            </div>
        <?php else: ?>
            <img src="assets/ObjectBrowser/imageDefautObjectBrowser.png"
                 alt="<?= htmlspecialchars($objet['Nom_objet']) ?>" class="object-img">
        <?php endif; ?>
    </div>

    <div class="object-info">
        <div class="categorie-object">
            <p><?php echo htmlspecialchars($objet['Nom_categorie_objet']); ?></p>
        </div>

        <div class="proprietaire">
            <p>Propriétaire :
                <?php echo htmlspecialchars($objet['Prenom_utilisateur']); ?>
                <?php echo htmlspecialchars($objet['Nom_utilisateur']); ?>
            </p>
        </div>

        <div class="description">
            <p><?php echo nl2br(htmlspecialchars($objet['Desc_objet'])); ?></p>
        </div>

        <?php if (!empty($messageReservation)): ?>
            <div class="message-reservation">
                <?= htmlspecialchars($messageReservation) ?>
            </div>
        <?php endif; ?>

        <div class="actions-reservation">
            <form method="POST"
                  action="index.php?action=reservation&id=<?= htmlspecialchars($objet['Id_objet']) ?>"
                  id="form-reserve">
                <button type="button"
                        id="btn-reserve"
                        class="btn-reserve <?= $reservé ? 'clicked' : '' ?>"
                        <?= $reservé ? 'disabled' : '' ?>>
                    <?= $reservé ? 'Réservé' : 'Réserver' ?>
                </button>
            </form>

            <button type="button" id="btn-flag" class="icon-btn" title="Signaler l'objet">
                <img src="assets/ObjectReservation/image2.png" alt="Signaler un objet">
            </button>
        </div>

        <!-- Modale confirmation réservation -->
        <div id="confirm-modal" class="modal-overlay">
            <div class="modal-content">
                <p>Êtes-vous sûr de vouloir réserver cet objet ?</p>
                <button id="modal-yes">Oui</button>
                <button id="modal-no">Non</button>
            </div>
        </div>

        <!-- Modale signalement -->
        <div id="flag-modal" class="modal-overlaySignal">
            <div class="modal-content">
                <h2>Motif de signalement</h2>
                <p>Explique pourquoi tu signales cet objet :</p>

                <form method="POST"
                      action="index.php?action=reservation&id=<?= htmlspecialchars($objet['Id_objet']) ?>"
                      id="flag-form">
                    <input type="hidden" name="type_form" value="signalement">
                    <textarea name="message" rows="8"
                              placeholder="Exemple : objet non conforme, description erronée, etc."></textarea>

                    <div class="modal-actions">
                        <button type="button" id="flag-cancel" class="btn-secondary">Annuler</button>
                        <button type="submit" id="btn-send" class="btn-primary">Envoyer</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<div class="carte-emplacement">
    <p class="titre-emplacement">Emplacement&nbsp;:</p>
    <div class="bloc-carte">
        <div id="map"></div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    var mapCenterLat = 48.0086;
    var mapCenterLng = 0.1985;

    var hasCoords = <?= ($latitude !== null && $longitude !== null && $latitude !== '' && $longitude !== '') ? 'true' : 'false'; ?>;

    if (hasCoords) {
        mapCenterLat = <?= floatval($latitude); ?>;
        mapCenterLng = <?= floatval($longitude); ?>;
    }

    var map = L.map('map').setView([mapCenterLat, mapCenterLng], 14);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    if (hasCoords) {
        L.marker([mapCenterLat, mapCenterLng]).addTo(map)
            .bindPopup('Emplacement de l\'objet !');
    }
});
</script>

<!-- Script bouton Réserver : modale -->
<script>
const modal = document.getElementById('confirm-modal');
const btnYes = document.getElementById('modal-yes');
const btnNo = document.getElementById('modal-no');
const btnReserve = document.getElementById('btn-reserve');
const formReserve = document.getElementById('form-reserve');

if (btnReserve && modal && btnYes && btnNo && formReserve) {
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
}
</script>

<!-- Changement visuel du bouton après submit -->
<script>
document.getElementById('form-reserve').addEventListener('submit', function () {
    const btn = document.getElementById('btn-reserve');
    btn.disabled = true;
    btn.classList.add('clicked');
    btn.textContent = 'Réservé';
});
</script>

<!-- Script bouton Signaler -->
<script>
const flagModal = document.getElementById('flag-modal');
const btnFlag = document.getElementById('btn-flag');
const flagCancel = document.getElementById('flag-cancel');

if (btnFlag && flagModal && flagCancel) {
    btnFlag.addEventListener('click', function () {
        flagModal.classList.add('active');
    });

    flagCancel.addEventListener('click', function () {
        flagModal.classList.remove('active');
    });

    flagModal.addEventListener('click', function (e) {
        if (e.target === flagModal) {
            flagModal.classList.remove('active');
        }
    });
}
</script>

<!-- Carrousel de photos -->
<script>
function scrollPhotos(id, direction) {
    const grid = document.getElementById(id);
    grid.scrollBy({
        left: direction * 300,
        behavior: 'smooth'
    });
}
</script>
