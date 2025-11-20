<link rel="stylesheet" href="assets/css/style.csss">
<link rel="stylesheet" href="assets/css/styleObjectBrowser.css">

<div class="titre-objets">OBJETS DISPONIBLES</div>
<!-- ObjetsDisponibles.html -->
<div class="container-objets">
    <div class="barre-recherche">
        <input type="text" placeholder="Rechercher..." id="rechercheObjets">
        <button title="effacer la recherche" class="clear-btn">×</button>
    </div>
    <div class="liste-objets">
        <!-- Exemple de carte objet; à injecter dynamiquement via ton contrôleur -->
        
       
        <?php include "controllers/ObjectBrowser.php";  ?>
        
    </div>
    <div class="aucun-objet" style="display:none;">
        <div class="aucun-msg">Aucun résultat ne correspond à votre recherche</div>
        <button class="signaler-besoin-btn">Signaler un besoin</button>
    </div>
</div>
