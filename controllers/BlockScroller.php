<?php

switch ($action) {
    case 'ConseilEco':
        $titre = "Conseils Ecologiques";
        $elements = [
            [
                "image" => "assets/conseilEco/image1.png",
                "titre" => "Pensez à éteindre la lumière",
                "desc" => "Un petit geste pour une grande économie d’énergie"
            ],
            [
                "image" => "assets/conseilEco/image2.png",
                "titre" => "Triez Correctement vos Déchets",
                "desc" => "Un petit geste pour une grande économie d’énergie"
            ]
        ];
        break;
    case 'historique':
        include('models/gererEquipement.php');
        $objets = consulterAllObjets($conn);
        $titre = "Historique des Opérations";
        $elements = [];
        foreach ($objets as $objet) {
            array_push($elements, [
                "image" => !empty($objet['Url_photo'])
                    ? htmlspecialchars('assets'.$objet['Url_photo'])
                    : 'assets/ObjectBrowser/imageDefautObjectBrowser.png',

                "titre" => $objet['Nom_statut'] == 'Disponible'
                    ? 'Objet Ajouté'
                    : 'Objet Donné',

                "desc" => $objet["Nom_objet"] . "<br>Propriétaire : " . $objet["Nom_utilisateur"] . "<br>Mise en ligne : " . $objet["Date_de_publication"]
            ]);
        }
        break;

    default:
        header("Location: index.php");
        break;
}

include("views/BlockScroller.php");

?>