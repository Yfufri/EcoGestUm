<?php
include "models/gererEquipement.php";

$objets = getAvailableEquipments($conn);

foreach ($objets as $objet) {
    echo '<div class="carte-objet">
            <img src="' . htmlspecialchars($objet['Url_photo']) . '" alt="Objet">
            <div class="objet-nom">' . htmlspecialchars($objet['Nom_objet']) . '</div>
            <button>Réserver</button>
        </div>';
}
?>
