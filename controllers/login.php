<?php
if (!empty($_GET['error'])) {
    $error = $_GET['error'];
} else {
    $error = 0;
}
include "views/connection.php";
?>