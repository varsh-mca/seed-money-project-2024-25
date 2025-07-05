<?php
include 'db_connection.php'; // Ensure database connection is included

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adminid = trim($_POST['adminid']);
    $password = trim($_POST['password']);

    // Password validation
    if (empty($adminid) || empty($password)) {
        echo "<script>alert('All fields are required!'); window.history.back();</script>";
        exit();
    }

    // Hash the password before storing
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert into admin_data table
    $sql = "INSERT INTO admin_data (adminid, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $adminid, $hashed_password);

    if ($stmt->execute()) {
        echo "<script>alert('Registration Successful!'); window.location.href='admin_login.html';</script>";
    } else {
        echo "<script>alert('Error: Unable to register.'); window.history.back();</script>";
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Signup</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            height: 100vh;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        div {
            width: 60%;
        }
        form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 50%;
            margin-left: 20%;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #45a049;
        }
        @media (max-width: 600px) {
            form {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <div>
        <h2>Admin Signup</h2>
        <form action="" method="POST">
            <label>Admin ID:</label>
            <input type="text" name="adminid" required pattern="^\d{4}[A-Z]{3}\d{4}$" title="Format: 1234ABC1234">

            <label>Password:</label>
            <input type="password" name="password" required pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&*!]).{8,10}" 
                   title="Password must be 8-10 characters, with at least one uppercase, one lowercase, one digit, and one special character.">

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
