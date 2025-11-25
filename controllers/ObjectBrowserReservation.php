<?php
if (isset($_GET["action"])) {
    switch ($_GET["action"]) {
        case "reservation":
            require_once "controllers/ObjectReservation.php";
            break;
        // tu peux ajouter d'autres cas ici
        default:
            require_once "controllers/ObjectBrowser.php";
            break;
    }
} else {
    require_once "controllers/ObjectBrowser.php";
}

?>