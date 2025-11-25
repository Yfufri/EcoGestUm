<link rel="stylesheet" href="assets/css/styleEvents.css?v=<?= time() ?>">

<!-- Titre et recherche -->
<div class="event-header">
    <h1>NOS ÉVÉNEMENTS</h1>
    <div class="search-container">
        <span class="icon-search">🔍</span>
        <input type="text" placeholder="Rechercher :" class="search-input">
        <button class="btn-clear">✖</button>
        <button class="btn-filter">☰</button>
    </div>
</div>

<!-- Événements à Le Mans -->
<section class="events-section-lemans">
    <h2>Événements à Le Mans :</h2>
    <div class="events-carousel-container">
        <button class="carousel-arrow left" onclick="scrollCards('lemans', -1)">‹</button>
        <div class="events-grid" id="lemans">
            <?php foreach ($evenementsAVenir as $event): ?>
                <div class="event-card">
                    <div class="event-img">
                        <?php if (!empty($event['Url_image'])): ?>
                            <img src="<?= htmlspecialchars($event['Url_image']) ?>" alt="<?= htmlspecialchars($event['Nom_evenement']) ?>">
                        <?php else: ?>
                            <div class="placeholder-img">📅</div>
                        <?php endif; ?>
                    </div>
                    <div class="event-content">
                        <h3><?= htmlspecialchars($event['Nom_evenement']) ?></h3>
                        <p class="event-desc"><?= htmlspecialchars($event['Description']) ?></p>
                        <p class="event-date"><?= date('d/m/Y', strtotime($event['Date_evenement'])) ?></p>
                        <a href="?action=inscription&id=<?= $event['Id_evenement'] ?>" class="btn-register">S'inscrire</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-arrow right" onclick="scrollCards('lemans', 1)">›</button>
    </div>
</section>

<!-- Événements à Laval -->
<section class="events-section-laval">
    <h2>Événements à Laval :</h2>
    <div class="events-carousel-container">
        <button class="carousel-arrow left" onclick="scrollCards('laval', -1)">‹</button>
        <div class="events-grid" id="laval">
            <?php foreach ($evenementsPasses as $event): ?>
                <div class="event-card">
                    <div class="event-img">
                        <?php if (!empty($event['Url_image'])): ?>
                            <img src="<?= htmlspecialchars($event['Url_image']) ?>" alt="<?= htmlspecialchars($event['Nom_evenement']) ?>">
                        <?php else: ?>
                            <div class="placeholder-img">📅</div>
                        <?php endif; ?>
                    </div>
                    <div class="event-content">
                        <h3><?= htmlspecialchars($event['Nom_evenement']) ?></h3>
                        <p class="event-desc"><?= htmlspecialchars($event['Description']) ?></p>
                        <p class="event-date"><?= date('d/m/Y', strtotime($event['Date_evenement'])) ?></p>
                        <a href="?action=inscription&id=<?= $event['Id_evenement'] ?>" class="btn-register">S'inscrire</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-arrow right" onclick="scrollCards('laval', 1)">›</button>
    </div>
</section>

<script>
function scrollCards(id, direction) {
    const container = document.getElementById(id);
    const scrollAmount = 240;
    container.scrollBy({
        left: direction * scrollAmount,
        behavior: 'smooth'
    });
}
</script>