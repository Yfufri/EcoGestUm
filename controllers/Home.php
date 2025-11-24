<?php

function displayDefaultHomePage($conn) {
        include "views/banner.php";
        include "views/DiscoverPolitique.php";
       
        include "views/Events.php";
        include "views/Visits.php";

        }

function displayStudentHomePage($conn) {
        include "views/banner.php";
        // Bonjour STUDENT
        // recycler objet
        include "controllers/Statistics.php";
        // point de collecte
        }
?>