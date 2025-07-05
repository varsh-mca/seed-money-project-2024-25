<!-- reset_password.php -->
<?php
session_start();
require 'db_connection.php'; 

if (!isset($_SESSION['otp_verified'])) {
    header('Location: faculty_login.html'); // Redirect to index if accessed directly
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['password'] === $_POST['confirm_password']) {
        $password = $_POST['password'];
        $stmt = $conn->prepare("UPDATE staff_data SET password = ? WHERE mail_id = ?");
        $stmt->bind_param('ss', $password, $_SESSION['email']);
        $stmt->execute();
        echo "<script>alert('Password updated successfully.');window.location.href='staff_login.html';</script>";
        session_destroy();
    } else {
        echo '<div class="error">Passwords do not match.</div>';
    }
}
?>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;
        color: #333;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 400px;
        margin: 50px auto;
        padding: 20px;
        background: white;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    h2 {
        text-align: center;
        color: #007bff;
    }

    label {
        display: block;
        margin: 10px 0 5px;
    }

    input[type="password"] {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
    }

    button {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
    }

    button:hover {
        background-color: #0056b3;
    }

    .error {
        color: red;
        font-size: 14px;
        text-align: center;
    }

    .success {
        color: green;
        font-size: 14px;
        text-align: center;
    }
</style>

<div class="container">
    <h2>Reset Password</h2>
    <form method="POST">
        <label>New Password:</label>
        <input type="password" name="password" required>
        
        <label>Confirm Password:</label>
        <input type="password" name="confirm_password" required>
        
        <button type="submit">Reset Password</button>
    </form>
</div>
