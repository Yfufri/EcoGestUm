<?php

function getRepartitionObjets($conn) {
    $sql = "SELECT 
                co.Nom_categorie_objet AS label, 
                COUNT(o.Id_objet) AS valeur
            FROM OBJET o
            JOIN CATEGORIE_OBJET co ON o.Id_categorie_objet = co.Id_categorie_objet
            GROUP BY o.Id_categorie_objet, co.Nom_categorie_objet
            ORDER BY valeur DESC
            LIMIT 8";

    $result = $conn->query($sql);
    
    if (!$result) {
        return [];
    }

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'label' => $row['label'],
            'valeur' => (int)$row['valeur']
        ];
    }
    
    return $data;
}

function getEvolutionMensuelle($conn) {
    $sql = "SELECT 
                DATE_FORMAT(o.Date_de_publication, '%Y-%m') AS mois,
                COUNT(o.Id_objet) AS nb_objets
            FROM OBJET o
            GROUP BY DATE_FORMAT(o.Date_de_publication, '%Y-%m')
            ORDER BY mois ASC
            LIMIT 12";  // Derniers 12 mois

    $result = $conn->query($sql);
    
    if (!$result) {
        return [];
    }

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'mois' => $row['mois'],
            'nb_objets' => (int)$row['nb_objets']
        ];
    }
    $result->free();
    
    return $data;
}

?>