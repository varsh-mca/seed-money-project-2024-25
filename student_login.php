<?php
session_start();
include 'db_connection.php'; // Ensure you have a proper database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rollno = trim($_POST["rollno"]);
    $password = trim($_POST["password"]);

    if (!preg_match("/^\d{2}[A-Z]{2}\d{3}$/", $rollno)) {
        echo "<script>alert('Invalid Roll Number format!'); window.location.href='index.html';</script>";
        exit();
    }

    // Prepare SQL query
    $sql = "SELECT rollno, password, name FROM student_data WHERE rollno = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $rollno);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if ($password=== $row['password']) {
            // Successful login
            $_SESSION["rollno"] = $row["rollno"];
            $_SESSION["name"] = $row["name"];
            header("Location: student_dashboard.php");
            exit();
        } else {
            echo "<script>alert('Incorrect Password!'); window.location.href='student_login.html';</script>";
        }
    } else {
        echo "<script>alert('Roll Number not found!'); window.location.href='student_login.html';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
