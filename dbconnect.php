<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "mada";

$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>