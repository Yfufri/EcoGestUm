<?php
include "models/gererUtilisateur.php";

function displayDefaultHomePage($conn) {
        include "views/banner.php";
        include "views/DiscoverPolitique.php";
        include "controllers/Statistics.php";
        include "views/Events.php";
        include "views/visite.php";

        }

function displayStudentHomePage($conn) {
        include "views/banner.php";
        include "controllers/Welcome.php";
        include "views/Recycle.php";
        include "controllers/Statistics.php";
        // point de collecte
        echo "point de collecte";
        }

## a refractor
if (isset( $_SESSION['id_utilisateur'])) {
        if (isStudent($conn, $_SESSION['id_utilisateur'])) {
                displayStudentHomePage($conn);
        }

        else {
                displayDefaultHomePage($conn);
        }

}
else {
        displayDefaultHomePage($conn);
}


?>