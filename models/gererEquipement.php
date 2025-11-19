<?php

$sql = "SELECT Nom_objet,
                Desc_objet,
                Nom_categorie_objet,
                Nom_point_de_collecte,
                Localisation_point_de_collecte,
                Nom_utilisateur,Nom_statut
             FROM vue_objets_disponibles";
$result = $conn->query($sql);

var_dump($result->fetch_all());


?>