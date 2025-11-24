<?php
// Récupérer l'événement si un ID est passé
if (isset($_GET['id'])) {
    $evenement = getInfoEvent($conn, $_GET['id']);
}
?>

<link rel="stylesheet" href="assets/css/styleEvents.css?v=<?= time() ?>">

<!-- Titre et recherche -->
<div class="event-title">
    <h2>NOS ÉVÉNEMENTS</h2>
    <div class="search-bar">
        <span class="search-icon">🔍</span>
        <input type="text" placeholder="Rechercher :">
        <button class="btn-close">✖</button>
    </div>
</div>

<!-- Événements à Le Mans -->
<section class="events-section">
    <h3>Événements à Le Mans :</h3>
    <div class="carousel-wrapper">
        <button class="carousel-btn left" onclick="scrollCarousel('carousel-lemans', -1)">
            <span>‹</span>
        </button>
        <div class="event-carousel" id="carousel-lemans">
            <?php foreach ($evenementsAVenir as $evenement): ?>
                <div class="event-card">
                    <div class="event-image-container">
                        <?php if (!empty($evenement['Url_image'])): ?>
                            <img src="<?= htmlspecialchars($evenement['Url_image']) ?>" 
                                 alt="<?= htmlspecialchars($evenement['Nom_evenement']) ?>"
                                 class="event-card-image">
                        <?php else: ?>
                            <div class="event-image-placeholder">
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="event-card-body">
                        <h4><?= htmlspecialchars($evenement['Nom_evenement']) ?></h4>
                        <p class="event-description"><?= htmlspecialchars($evenement['Description']) ?></p>
                        
                        <div class="event-details">
                            <div class="event-date">
                                <span><?= date('d/m/Y', strtotime($evenement['Date_evenement'])) ?></span>
                            </div>
                            <div class="event-location">
                                <span><?= htmlspecialchars($evenement['Localisation_evenement']) ?></span>
                            </div>
                        </div>
                        
                        <a href="?action=inscription&id=<?= $evenement['Id_evenement'] ?>" class="btn-inscription">
                            S'inscrire
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-btn right" onclick="scrollCarousel('carousel-lemans', 1)">
            <span>›</span>
        </button>
    </div>
</section>

<!-- Événements passés -->
<section class="events-section-light">
    <h3>Événements passés :</h3>
    <div class="carousel-wrapper">
        <button class="carousel-btn left" onclick="scrollCarousel('carousel-passes', -1)">
            <span>‹</span>
        </button>
        <div class="event-carousel" id="carousel-passes">
            <?php foreach ($evenementsPasses as $evenement): ?>
                <div class="event-card">
                    <div class="event-image-container">
                        <?php if (!empty($evenement['Url_image'])): ?>
                            <img src="<?= htmlspecialchars($evenement['Url_image']) ?>" 
                                 alt="<?= htmlspecialchars($evenement['Nom_evenement']) ?>"
                                 class="event-card-image">
                        <?php else: ?>
                            <div class="event-image-placeholder">
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="event-card-body">
                        <h4><?= htmlspecialchars($evenement['Nom_evenement']) ?></h4>
                        <p class="event-description"><?= htmlspecialchars($evenement['Description']) ?></p>
                        
                        <div class="event-details">
                            <div class="event-date">
                                <span><?= date('d/m/Y', strtotime($evenement['Date_evenement'])) ?></span>
                            </div>
                            <div class="event-location">
                                <span><?= htmlspecialchars($evenement['Localisation_evenement']) ?></span>
                            </div>
                        </div>
                        
                        <span class="btn-expired">Événement terminé</span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-btn right" onclick="scrollCarousel('carousel-passes', 1)">
            <span>›</span>
        </button>
    </div>
</section>

<script>
function scrollCarousel(carouselId, direction) {
    const carousel = document.getElementById(carouselId);
    const cardWidth = 350; // largeur carte + gap
    const scrollAmount = cardWidth * 2;
    
    carousel.scrollBy({
        left: direction * scrollAmount,
        behavior: 'smooth'
    });
}
</script>