<link rel="stylesheet" href="assets/css/style.csss">
<link rel="stylesheet" href="assets/css/styleObjectBrowser.css">

<div class="titre-objets">OBJETS DISPONIBLES</div>
<!-- ObjetsDisponibles.html -->
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
    <div class="liste-objets">
        <?php include "controllers/ObjectBrowser.php";  ?>   
    </div>
    <div class="aucun-objet" style="display:none;">
        <div class="aucun-msg">Aucun résultat ne correspond à votre recherche</div>
        <button class="signaler-besoin-btn">Signaler un besoin</button>
    </div>
</div>
