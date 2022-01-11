<?php
$servername = "localhost";
$username = "root";
$password = "091195";
$database = "vb_bib";
$port = "3306";

$conn = new mysqli($servername, $username, $password, $database, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>