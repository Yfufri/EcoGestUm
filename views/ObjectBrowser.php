<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/styleObjectBrowser.css">

<div class="titre-objets">OBJETS DISPONIBLES</div>
<div class="container-objets">
    <div class="barre-recherche">
        <form method="get" action="" class="search-form">
            <div class="input-wrapper">
                <input type="text" placeholder="Rechercher..." name="search" id="rechercheObjets" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <button type="button" class="clear-btn" title="Effacer" onclick="document.getElementById('rechercheObjets').value='';">×</button>
            </div>
            <button type="submit" class="loupe-btn" title="Rechercher"><img src="assets/ObjectBrowser/image1ObjectBrowser.png" alt="Loupe de recherche"></button>
        </form>
    </div>

    <button id="openFilterBtn" class="filter-btn" title="Filtrer"><img src="assets/ObjectBrowser/image2ObjectBrowser.png" alt="Filtrer"></button>

    <div id="filterModal" class="modal" style="display:none;">
        <div class="modal-content">
            <span id="closeFilterBtn" class="close">&times;</span>
            <h2>Filtrer les objets</h2>
            
            <form id="filterForm" method="GET" action="">
                <label for="categorie">Catégorie :</label>
                <select name="categorie" id="categorie">
                    <option value="">Toutes</option>
                    <!-- Options dynamiques PHP -->
                </select>

                <label for="point_collecte">Point de collecte :</label>
                <select name="point_collecte" id="point_collecte">
                    <option value="">Tous</option>
                    <!-- Options dynamiques PHP -->
                </select>
                
                <div class="modal-buttons">
                    <button type="reset" class="reset-btn" onclick="resetFilters()">Réinitialiser</button>
                    <button type="submit" class="apply-btn">Appliquer</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script pour gérer l'apparition de la modale -->
    <script>
    // Cibler les éléments
    const openBtn = document.getElementById('openFilterBtn');
    const modal = document.getElementById('filterModal');
    const closeBtn = document.getElementById('closeFilterBtn');

    // Ouvrir la modale
    openBtn.addEventListener('click', () => {
        modal.style.display = 'block';
    });

    // Fermer la modale au clic sur la croix
    closeBtn.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    // Fermer la modale au clic en dehors du contenu
    window.addEventListener('click', (event) => {
        if (event.target === modal) {
        modal.style.display = 'none';
        }
    });
    </script>

    <div class="liste-objets">
        <?php include "controllers/ObjectBrowser.php";  ?>   
    </div>
    <div class="aucun-objet" style="display:none;">
        <div class="aucun-msg">Aucun résultat ne correspond à votre recherche</div>
        <button class="signaler-besoin-btn">Signaler un besoin</button>
    </div>
</div>
