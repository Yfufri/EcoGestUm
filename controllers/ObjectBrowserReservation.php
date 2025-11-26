<?php
if (isset($_GET["action"])) {
    switch ($_GET["action"]) {
        case "reservation":
            require_once "controllers/ObjectReservation.php";
            break;
        case "chercherObjet":
            require_once "controllers/ObjectBrowser.php";
        default:
            break;
    }
} else {
    require_once "controllers/ObjectBrowser.php";
}

?>