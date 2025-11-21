<?php
function openCon() {
    
$conn = new mysqli($_ENV["DB_HOST"], $_ENV["DB_USER"],$_ENV["DB_PASSWORD"], $_ENV["DB_NAME"]);

if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
return $conn;
}
?>