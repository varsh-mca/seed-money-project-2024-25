<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "seed_money";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get student ID from URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    die("Invalid ID");
}

// Delete record
$sql = "DELETE FROM bdc_rr_student WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Record deleted successfully'); window.location.href='admin_dasboard.php';</script>";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
