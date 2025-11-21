<?php
/*include "models/gererEquipement.php";


// Récupérer les paramètres envoyés par le formulaire (via GET)
$mot_clef = $_GET['search'] ?? null;
$categorie = $_GET['categorie'] ?? null;
$point_collecte = $_GET['point_collecte'] ?? null;

// Appeler la fonction chercherObjets en lui passant la connexion et les filtres
$objets = consulterObjets($conn, $mot_clef, $categorie, $point_collecte);

// Afficher les objets trouvés
if(empty($objets)) {
    echo '<div style="color: #263258; font-size:1.5em; text-align: center; width: 100%;">Aucun objet disponible ne correspond à votre recherche</div>';
}
foreach ($objets as $objet) {
    $url_photo = !empty($objet['Url_photo']) ? htmlspecialchars($objet['Url_photo']) : 'assets/ObjectBrowser/imageDefautObjectBrowser.png';
    echo '<div class="carte-objet">
            <img src="' . $url_photo . '" alt="Objet">
            <div class="objet-nom">' . htmlspecialchars($objet['Nom_objet']) . '</div>
            <button>Réserver</button>
        </div>';
}*/

include "models/gererEquipement.php";

$mot_clef = $_GET['search'] ?? null;
$categorie = $_GET['categorie'] ?? null;
$point_collecte = $_GET['point_collecte'] ?? null;

$objets = consulterObjets($conn, $mot_clef, $categorie, $point_collecte);

$categories = getAllCategories($conn);
$points_collecte = getAllPointsCollecte($conn);

include 'views/ObjectBrowser.php';


?>