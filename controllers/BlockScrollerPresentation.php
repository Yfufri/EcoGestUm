<?php
function setPresentation($type, $conn)
{

    switch ($type) {
        case 'ConseilEco':
            $titre = "Conseils Ecologiques";
            $element =
                [
                    "image" => "conseilEco/image1.png",
                    "titre" => "Pensez à éteindre la lumière",
                    "desc" => "Un petit geste pour une grande économie d’énergie"
                ];
            break;
        case 'historique':
            include_once('models/gererEquipement.php');
            $objets = consulterObjets($conn);
            $objet = $objets[0];
            $titre = "Historique des Opérations";
            $element = [
                "image" => !empty($objet['Url_photo'])
                    ? htmlspecialchars($objet['Url_photo'])
                    : 'assets/ObjectBrowser/imageDefautObjectBrowser.png',

                "titre" => $objet['Nom_statut'] == 'Disponible'
                    ? 'Objet Ajouté'
                    : 'Objet Donné',

                "desc" => $objet["Nom_objet"] . "<br>Propriétaire : " . $objet["Nom_utilisateur"]
            ];
            break;
        default:
            header("Location: index.php");
            break;
    }
include "views/BlockScrollerPresentation.php";
}

?>