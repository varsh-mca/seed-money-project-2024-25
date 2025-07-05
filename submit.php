<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "seed_money";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$name = $_POST['name'];
$rollno = $_POST['rollno'];
$gender = $_POST['gender'];
$fathername = $_POST['fathername']; 
$mothername = $_POST['mothername'];
$year = $_POST['year'];  
$departmentname = $_POST['departmentname']; 
$address = $_POST['address'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$dob = $_POST['dob'];
$community = $_POST['community'];
$bloodgroup = $_POST['bloodgroup']; 
$talent = $_POST['talent'];
$place = $_POST['place'];
$date = $_POST['date'];
$sql = "INSERT INTO student (name, rollno,gender, fathername, mothername,year, departmentname, address, email, phone, dob, community, bloodgroup, talent, place, date) 
VALUES ('$name', '$rollno', '$gender','$fathername', '$mothername','$year', '$departmentname', '$address', '$email', '$phone', '$dob', '$community', '$bloodgroup', '$talent', '$place', '$date')";

if ($conn->query($sql) === TRUE) {
    echo <center>"New record created successfully.<a href="student_login.html"Back</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

