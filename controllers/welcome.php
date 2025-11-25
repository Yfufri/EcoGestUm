<?php

$userName = $_SESSION['user']['Prenom_utilisateur'] ?? 'Prénom';

include "views/welcome.php";
?>