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
        $objets = getObjetsByDepartement($conn,$_SESSION['user']["Id_departement"]);
        $titre = "Historique des Opérations";
        $elements = [];
        foreach ($objets as $objet) {
            $nouveauProprietaire = null;
            if ($objet['Nom_statut'] != 'Disponible') {
                $nouveauProprietaire = getNouveauPropriétaire($conn, $objet['Id_objet']);
            }

            array_push($elements, [
                "image" => !empty($objet['Url_photo'])
                    ? htmlspecialchars('assets' . $objet['Url_photo'])
                    : 'assets/ObjectBrowser/imageDefautObjectBrowser.png',

                "titre" => $objet['Nom_statut'] == 'Disponible'
                    ? 'Objet Ajouté'
                    : 'Objet Donné',

                "desc" => $objet["Nom_objet"] .
                    "<br>Propriétaire : " . $objet["Nom_utilisateur"] .
                    "<br>Mise en ligne : " . htmlspecialchars($objet["Date_de_publication"]) .
                    ($nouveauProprietaire !== null
                        ? '<br>Récupéré par : ' . htmlspecialchars($nouveauProprietaire['Nom_utilisateur']) .
                        '<br>Réservé le : ' . htmlspecialchars($nouveauProprietaire['Date_reservation'])
                        : '')
            ]);
        }
        break;

    default:
        header("Location: index.php");
        break;
}

include("views/BlockScroller.php");

?>