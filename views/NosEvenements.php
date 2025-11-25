
<link rel="stylesheet" href="assets/css/styleEvents.css?v=<?= time() ?>">

<!-- En-tête avec titre -->
<div class="event-header">
    <h1>NOS ÉVÉNEMENTS</h1>
    
    <!-- Barre de recherche -->
    <div class="search-container">
        <span class="icon-search">🔍</span>
        <input type="text" id="searchInput" placeholder="Rechercher :" class="search-input">
        <button class="btn-clear" onclick="clearSearch()">✖</button>
        <button class="btn-filter" onclick="toggleFilters()">☰</button>
    </div>
    
    <!-- filtres par catégorie -->
    <div class="filter-menu" id="filterMenu">
        <h3>Filtrer par catégorie :</h3>
        <div class="filter-options">
            <button class="filter-btn active" onclick="filterByCategory('all', this)">Tous</button>
            <?php 
            $categories = $conn->query("SELECT * FROM CATEGORIE_EVENEMENT ORDER BY Nom_categorie_evenement");
            while ($cat = $categories->fetch_assoc()): 
            ?>
                <button class="filter-btn" onclick="filterByCategory('<?= $cat['Id_categorie_evenement'] ?>', this)">
                    <?= htmlspecialchars($cat['Nom_categorie_evenement']) ?>
                </button>
            <?php endwhile; ?>
        </div>
    </div>
</div>

<!-- Section événements pour Le Mans -->
<section class="events-section-lemans">
    <h2>Événements à Le Mans :</h2>
    <div class="events-carousel-container">
        <button class="carousel-arrow left" onclick="scrollCards('lemans', -1)">‹</button>
        
        <div class="events-grid" id="lemans">
            <?php foreach ($evenementsAVenir as $event): ?>
                <div class="event-card" 
                     data-nom="<?= strtolower($event['Nom_evenement']) ?>"
                     data-desc="<?= strtolower($event['Description']) ?>"
                     data-lieu="<?= strtolower($event['Localisation_evenement']) ?>"
                     data-categorie="<?= $event['Id_categorie_evenement'] ?>">
                    
                    <!-- img de l'événement -->
                    <div class="event-img">
                        <?php if (!empty($event['Url_image'])): ?>
                            <img src="<?= $event['Url_image'] ?>" alt="<?= $event['Nom_evenement'] ?>">
                        <?php else: ?>
                            <div class="placeholder-img">📅</div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- contenu de la card -->
                    <div class="event-content">
                        <h3><?= htmlspecialchars($event['Nom_evenement']) ?></h3>
                        <p class="event-desc"><?= htmlspecialchars($event['Description']) ?></p>
                        <p class="event-date"><?= date('d/m/Y', strtotime($event['Date_evenement'])) ?></p>
                        <p class="event-location"><?= htmlspecialchars($event['Localisation_evenement']) ?></p>
                        <a href="?action=inscription&id=<?= $event['Id_evenement'] ?>" class="btn-register">S'inscrire</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <button class="carousel-arrow right" onclick="scrollCards('lemans', 1)">›</button>
    </div>
</section>

<!-- Section événements pour Laval -->
<section class="events-section-laval">
    <h2>Événements à Laval :</h2>
    <div class="events-carousel-container">
        <button class="carousel-arrow left" onclick="scrollCards('laval', -1)">‹</button>
        
        <div class="events-grid" id="laval">
            <?php foreach ($evenementsPasses as $event): ?>
                <div class="event-card"
                     data-nom="<?= strtolower($event['Nom_evenement']) ?>"
                     data-desc="<?= strtolower($event['Description']) ?>"
                     data-lieu="<?= strtolower($event['Localisation_evenement']) ?>"
                     data-categorie="<?= $event['Id_categorie_evenement'] ?>">
                    
                    <div class="event-img">
                        <?php if (!empty($event['Url_image'])): ?>
                            <img src="<?= $event['Url_image'] ?>" alt="<?= $event['Nom_evenement'] ?>">
                        <?php else: ?>
                            <div class="placeholder-img">📅</div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="event-content">
                        <h3><?= htmlspecialchars($event['Nom_evenement']) ?></h3>
                        <p class="event-desc"><?= htmlspecialchars($event['Description']) ?></p>
                        <p class="event-date"><?= date('d/m/Y', strtotime($event['Date_evenement'])) ?></p>
                        <p class="event-location"><?= htmlspecialchars($event['Localisation_evenement']) ?></p>
                        <a href="?action=inscription&id=<?= $event['Id_evenement'] ?>" class="btn-register">S'inscrire</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <button class="carousel-arrow right" onclick="scrollCards('laval', 1)">›</button>
    </div>
</section>

<script>

// Variables pour stocker les filtres 
let currentCategory = 'all';
let currentSearch = '';

//  défiler le carousel à gauche ou droite
function scrollCards(id, direction) {
    document.getElementById(id).scrollBy({
        left: direction * 300,
        behavior: 'smooth'
    });
}

// Affiche/masque le menu des filtres
function toggleFilters() {
    document.getElementById('filterMenu').classList.toggle('show');
}

// Filtre les événements par catégorie
function filterByCategory(categoryId, btn) {
    currentCategory = categoryId;
    
    // Met à jour le bouton (selectionné/deselectionné)
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    
    applyFilters();
}

// Réinitialise la barre de recherche
function clearSearch() {
    document.getElementById('searchInput').value = '';
    currentSearch = '';
    applyFilters();
}

// lire les changements dans la barre de recherche
document.getElementById('searchInput').addEventListener('input', function() {
    currentSearch = this.value.toLowerCase().trim();
    applyFilters();
});

// Applique les filtres 
function applyFilters() {
    document.querySelectorAll('.event-card').forEach(card => {
        // Vérifie si la catégorie correspond
        const matchCategory = currentCategory === 'all' || 
                            card.dataset.categorie === currentCategory;
        
        // Vérifie si le texte de recherche correspond
        const matchSearch = !currentSearch ||
                          card.dataset.nom.includes(currentSearch) ||
                          card.dataset.desc.includes(currentSearch) ||
                          card.dataset.lieu.includes(currentSearch);
        
        // Affiche la card si les deux critères sont OK
        card.style.display = (matchCategory && matchSearch) ? 'block' : 'none';
    });
    
    updateEmptyMessages();
}

// Affiche un message si aucun événement trouvé
function updateEmptyMessages() {
    ['lemans', 'laval'].forEach(sectionId => {
        const section = document.getElementById(sectionId);
        
        // Vérifie s'il y a au moins une card visible
        const hasVisible = Array.from(section.querySelectorAll('.event-card'))
            .some(card => card.style.display !== 'none');
        
        // Supprime l'ancien message
        const oldMsg = section.parentElement.querySelector('.no-results-message');
        if (oldMsg) oldMsg.remove();
        
        // Ajoute un nouveau message si aucun résultat
        if (!hasVisible) {
            const msg = document.createElement('p');
            msg.className = 'no-results-message';
            msg.textContent = 'Aucun événement trouvé.';
            section.parentElement.insertBefore(msg, section);
        }
    });
}

// Ferme le menu des filtres si on clique à l'extérieur
document.addEventListener('click', (e) => {
    const menu = document.getElementById('filterMenu');
    const btn = document.querySelector('.btn-filter');
    
    if (menu && !menu.contains(e.target) && e.target !== btn) {
        menu.classList.remove('show');
    }
});
</script>