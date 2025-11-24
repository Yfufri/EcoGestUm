<link rel="stylesheet" href="assets/css/styleEvents.css">

<!-- Titre et recherche -->
<div class="event-title">
    <h2>NOS ÉVÉNEMENTS</h2>
    <div class="search-bar">
        <span>🔍</span>
        <input type="text" placeholder="Rechercher :">
        <button class="btn-close">✖</button>
        <button class="btn-filter"></button>
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
                                <span>📅</span>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="event-card-body">
                        <h4><?= htmlspecialchars($evenement['Nom_evenement']) ?></h4>
                        <p class="event-description"><?= htmlspecialchars($evenement['Description']) ?></p>
                        
                        <div class="event-details">
                            <div class="event-date">
                                <span class="icon">Date:</span>
                                <span><?= date('Y-m-d', strtotime($evenement['Date_evenement'])) ?></span>
                            </div>
                            <div class="event-location">
                                <span class="icon">Emplacement:</span>
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

<!-- Événements à Laval -->
<section class="events-section-light">
    <h3>Événements à Laval :</h3>
    <div class="carousel-wrapper">
        <button class="carousel-btn left" onclick="scrollCarousel('carousel-laval', -1)">
            <span>‹</span>
        </button>
        <div class="event-carousel" id="carousel-laval">
            <?php foreach ($evenementsPasses as $evenement): ?>
                <div class="event-card">
                    <div class="event-image-container">
                        <?php if (!empty($evenement['Url_image'])): ?>
                            <img src="<?= htmlspecialchars($evenement['Url_image']) ?>" 
                                 alt="<?= htmlspecialchars($evenement['Nom_evenement']) ?>"
                                 class="event-card-image">
                        <?php else: ?>
                            <div class="event-image-placeholder">
                                <span>📅</span>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="event-card-body">
                        <h4><?= htmlspecialchars($evenement['Nom_evenement']) ?></h4>
                        <p class="event-description"><?= htmlspecialchars($evenement['Description']) ?></p>
                        
                        <div class="event-details">
                            <div class="event-date">
                                <span class="icon">📅</span>
                                <span><?= date('Y-m-d', strtotime($evenement['Date_evenement'])) ?></span>
                            </div>
                            <div class="event-location">
                                <span class="icon">📍</span>
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
        <button class="carousel-btn right" onclick="scrollCarousel('carousel-laval', 1)">
            <span>›</span>
        </button>
    </div>
</section>

<script>
function scrollCarousel(carouselId, direction) {
    const carousel = document.getElementById(carouselId);
    const cardWidth = 320; // 280px largeur + 30px gap + marge
    const scrollAmount = cardWidth * 3; // Défile de 3 cartes à la fois
    
    carousel.scrollBy({
        left: direction * scrollAmount,
        behavior: 'smooth'
    });
}

// Navigation au clavier
document.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowLeft') {
        scrollCarousel('carousel-lemans', -1);
    } else if (e.key === 'ArrowRight') {
        scrollCarousel('carousel-lemans', 1);
    }
});
</script>