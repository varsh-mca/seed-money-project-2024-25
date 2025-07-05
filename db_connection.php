<?php
$servername = "localhost";  // Change if your DB is on a different server
$username = "root";         // Database username
$password = "";           // Database password
$dbname = "seed_money";  // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
