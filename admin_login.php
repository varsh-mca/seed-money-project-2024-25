<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "seed_money";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$adminid = $admin_password = "";
$error = "";

// Form submission check
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adminid = trim($_POST["adminid"]);
    $admin_password = trim($_POST["password"]);

    // Input validation
    if (empty($adminid) || empty($admin_password)) {
        $error = "Please enter both Admin ID and Password.";
    } else {
        // Prepare SQL query
        $sql = "SELECT adminid, password FROM admin_data WHERE adminid = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $adminid);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verify credentials
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($admin_password, $row["password"])) {
                $_SESSION["adminid"] = $adminid; // Store session
                header("Location: admin_dashboard.php"); // Redirect to admin dashboard
                exit();
            } else {
                $error = "Invalid password.";
            }
        } else {
            $error = "Invalid Admin ID.";
        }
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #d9d9da, #d1cbd1);
            font-family: 'Arial', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background: skyblue;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        h2 {
            color: blue;
            margin-bottom: 20px;
        }
        .form-group {
            text-align: left;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: none;
            font-size: 1rem;
            margin-bottom: 15px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            border-radius: 12px;
            background: linear-gradient(135deg, #5b94b5, #38e4db);
            color: #fff;
            border: none;
            cursor: pointer;
            width: 100%;
            font-size: 1rem;
            font-weight: bold;
        }
        input[type="submit"]:hover {
            background: linear-gradient(135deg, #f582bb, #e070bb);
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
        .links {
            margin-top: 20px;
        }
        .links a {
            color: #fff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Login</h2>
        <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>
        <form action="admin_dasboard.php" method="post">
            <div class="form-group">
                <label for="adminid">Admin ID:</label>
                <input type="text" name="adminid" id="adminid" placeholder="Enter Admin ID" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="Enter Password" required>
            </div>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
