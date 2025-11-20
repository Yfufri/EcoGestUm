<?php
include "models/gererEquipement.php";

// Récupérer les paramètres envoyés par le formulaire (via GET)
$mot_clef = $_GET['search'] ?? null;
$categorie = $_GET['categorie'] ?? null;
$point_collecte = $_GET['point_collecte'] ?? null;

// Appeler la fonction chercherObjets en lui passant la connexion et les filtres
$objets = chercherObjets($conn, $mot_clef, $categorie, $point_collecte);

// Afficher les objets trouvés
foreach ($objets as $objet) {
    $url_photo = !empty($objet['Url_photo']) ? htmlspecialchars($objet['Url_photo']) : 'assets/ObjectBrowser/imageDefautObjectBrowser.png';
    echo '<div class="carte-objet">
            <img src="' . $url_photo . '" alt="Objet">
            <div class="objet-nom">' . htmlspecialchars($objet['Nom_objet']) . '</div>
            <button>Réserver</button>
        </div>';
}
?>

