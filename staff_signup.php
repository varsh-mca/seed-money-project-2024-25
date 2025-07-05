<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $staffid = trim($_POST['staffid']);
    $name = trim($_POST['name']);
    $department = trim($_POST['department']);
    $phone_number = trim($_POST['phone_number']);
    $emailid = trim($_POST['emailid']);
    $activity_name = trim($_POST['activity_name']);
    $position = trim($_POST['position']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $auth_key = isset($_POST['auth_key']) ? trim($_POST['auth_key']) : "";

    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
        exit();
    }

    if (strpos($position, 'Coordinator') !== false) {
        if ($auth_key !== "skey") {
            echo "<script>alert('Invalid authorization key!'); window.history.back();</script>";
            exit();
        }
    }

    $check_sql1 = "SELECT staffid FROM staff_data WHERE staffid = ?";
    $stmt1 = $conn->prepare($check_sql1);
    $stmt1->bind_param("s", $staffid);
    $stmt1->execute();
    $stmt1->store_result();

    if ($stmt1->num_rows > 0) {
        echo "<script>alert('Staff ID already registered!'); window.history.back();</script>";
        exit();
    }
    $stmt1->close();

    $check_sql2 = "SELECT staffid FROM $activity_name WHERE staffid = ?";
    $stmt2 = $conn->prepare($check_sql2);
    $stmt2->bind_param("s", $staffid);
    $stmt2->execute();
    $stmt2->store_result();

    if ($stmt2->num_rows > 0) {
        echo "<script>alert('Staff ID is already registered in the selected activity!'); window.history.back();</script>";
        exit();
    }
    $stmt2->close();

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql1 = "INSERT INTO staff_data (staffid, name, department, password, emailid, phone_number, forum_name, position) 
             VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt3 = $conn->prepare($sql1);
    $stmt3->bind_param("ssssssss", $staffid, $name, $department, $hashed_password, $emailid, $phone_number, $activity_name, $position);

    $sql2 = "INSERT INTO $activity_name (staffid, name, department, password, position) 
             VALUES (?, ?, ?, ?, ?)";
    $stmt4 = $conn->prepare($sql2);
    $stmt4->bind_param("sssss", $staffid, $name, $department, $hashed_password, $position);

    if ($stmt3->execute() && $stmt4->execute()) {
        echo "<script>alert('Registration Successful!'); window.location.href='staff_login.html';</script>";
    } else {
        echo "<script>alert('Error: Unable to register.'); window.history.back();</script>";
    }

    $stmt3->close();
    $stmt4->close();
    $conn->close();
}

// Fetch departments
$departments_result = mysqli_query($conn, "SELECT department FROM departments");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Faculty Signup</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f0f0;
            display: flex;
            justify-content: center;
            height: 100vh;
        }
        div {
            width: 60%;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-left: 20%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 50%;
        }
        label {
            font-weight: bold;
            margin-bottom: 10px;
            display: block;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        button {
            background: #4CAF50;
            color: white;
            padding: 12px;
            border: none;
            width: 100%;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover { background-color: #45a049; }
        #passwordDiv, #keyDiv { margin-top: 20px; }
    </style>
    <script>
        function updatePosition() {
            var activity = document.getElementById("activity_name");
            var position = document.getElementById("position");
            var selected = activity.options[activity.selectedIndex].text;
            position.innerHTML = "";

            var option1 = new Option("Programme Officer", "Programme Officer");
            var option2 = new Option(selected + " Coordinator", selected + " Coordinator");

            position.add(option1);
            position.add(option2);
        }

        function handlePositionChange() {
            var pos = document.getElementById("position").value;
            document.getElementById("passwordDiv").style.display = "block";
            document.getElementById("keyDiv").style.display = pos.includes("Coordinator") ? "block" : "none";
        }
    </script>
</head>
<body>
<div>
    <h2>Faculty Signup</h2>
    <form method="POST">
        <label>Faculty CMS ID:</label>
        <input type="text" name="staffid" required pattern="^\d{4}[A-Z]{3}\d{4}$" title="1234ABC1234">

        <label>Faculty Name:</label>
        <input type="text" name="name" required>

        <label>Faculty Department:</label>
        <select name="department" required>
            <?php
            if (mysqli_num_rows($departments_result) > 0) {
                while ($row = mysqli_fetch_assoc($departments_result)) {
                    echo "<option value='" . $row['department'] . "'>" . $row['department'] . "</option>";
                }
            } else {
                echo "<option value=''>No departments available</option>";
            }
            ?>
        </select>

        <label>Phone Number:</label>
        <input type="text" name="phone_number" required>

        <label>Email ID:</label>
        <input type="email" name="emailid" required>

        <label>Co-Curricular Activity Name:</label>
        <select name="activity_name" id="activity_name" onchange="updatePosition()" required>
            <option value="nss_staff">National Service Scheme</option>
            <option value="yrc_staff">Youth Red Cross</option>
            <option value="ssl_staff">Social Service League</option>
            <option value="ccc_staff">Citizen Consumer Club</option>
            <option value="egc_staff">Environmental & Gardening Club</option>
            <option value="pe_staff">Physical Education</option>
            <option value="bdc_rr_staff">Blood Donors Club & Red Ribbon Club</option>
            <option value="cb_staff">Clean Brigade</option>
            <option value="gcc_staff">Gender Champions Club</option>
            <option value="rr_staff">Rovers & Rangers</option>
            <option value="anti_staff">Anti Drug Club</option>
            <option value="ncc_staff">National Cadet Corps</option>
        </select>

        <label>Position:</label>
        <select name="position" id="position" onchange="handlePositionChange()" required>
            <option value="Programme Officer">Programme Officer</option>
            <option value="Coordinator">National Service Scheme Coordinator</option>
        </select>

        <div id="passwordDiv">
            <label>Password:</label>
            <input type="password" name="password" id="password" required>

            <label>Confirm Password:</label>
            <input type="password" name="confirm_password" id="confirm_password" required>
        </div>

        <div id="keyDiv" style="display: none;">
            <label>Enter Authorization Key:</label>
            <input type="password" name="auth_key">
        </div>

        <button type="submit">Register</button>
    </form>
</div>
</body>
</html>
