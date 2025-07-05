<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'seed_money');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $rollno = $_POST['rollno'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $stream = $_POST['stream'];
    $activity_name = $_POST['activity_name'];
    $father_name = $_POST['father_name'];
    $mother_name = $_POST['mother_name'];
    $age = $_POST['age'];
    $department_name = $_POST['department_name'];
    $address = $_POST['address'];
    $phone_no = $_POST['phone_no'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $dob = $_POST['dob'];
    $blood_group = $_POST['blood_group'];
    $talent = $_POST['talent'];
    $registration_place = 'GASC';
    $register_date = date('Y-m-d');
    $created_at = date('Y-m-d H:i:s');

    // Validate roll number format
    if (!preg_match('/^\d{2}[A-Z]{2}[0-2]\d{2}$/', $rollno)) {
        echo "<script>alert('Invalid roll number format.'); window.history.back();</script>";
        exit;
    }

    // Determine stream
    $stream_type = (substr($rollno, -3, 1) == '0') ? 'Aided' : 'Un-Aided';
    if ($stream_type != $stream) {
        echo "<script>alert('Stream does not match roll number.'); window.history.back();</script>";
        exit;
    }

    // Restrict NCC for Un-Aided students
    if ($stream == 'Un-Aided' && $activity_name == 'National Cadet Corps') {
        echo "<script>alert('Un-Aided students cannot join NCC.'); window.history.back();</script>";
        exit;
    }

    // Check if roll number exists
    $check_query = "SELECT rollno FROM student_data WHERE rollno = '$rollno'";
    $check_result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('Roll number already exists.'); window.history.back();</script>";
        exit;
    }

    // Insert into student_data
    $sql = "INSERT INTO student_data (rollno, name, gender, stream, activity_name, father_name, mother_name, age, department_name, address, phone_no, email, password, dob, blood_group, talent, registration_place, register_date, created_at) 
            VALUES ('$rollno', '$name', '$gender', '$stream', '$activity_name', '$father_name', '$mother_name', '$age', '$department_name', '$address', '$phone_no', '$email', '$password', '$dob', '$blood_group', '$talent', '$registration_place', '$register_date', '$created_at')";
    if (mysqli_query($conn, $sql)) {
        // Redirect to respective activity page
        echo "<script>alert('Registration successful!'); window.location.href='{$activity_name}_page.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
        .container { max-width: 600px; margin: auto; background: white; padding: 20px; border-radius: 10px; }
        label, input, select { display: block; width: 100%; margin-bottom: 10px; }
        button { width: 100%; padding: 10px; background: #4CAF50; color: white; border: none; }
    </style>
</head>
<body>
<div class='container'>
    <h2>Student Registration</h2>
    <form method='POST'>
        <label>Roll Number:</label>
        <input type='text' name='rollno' required>
        <label>Name:</label>
        <input type='text' name='name' required>
        <label>Gender:</label>
        <select name='gender'>
            <option value='Male'>Male</option>
            <option value='Female'>Female</option>
        </select>
        <label>Stream:</label>
        <select name='stream'>
            <option value='Aided'>Aided</option>
            <option value='Un-Aided'>Un-Aided</option>
        </select>
        <label>Activity Name:</label>
        <select name='activity_name'>
            <option value='NSS'>NSS</option>
            <option value='NCC'>NCC</option>
            <option value='BDC'>BDC</option>
        </select>
        <label>Father Name:</label>
        <input type='text' name='father_name' required>
        <label>Mother Name:</label>
        <input type='text' name='mother_name' required>
        <label>Age:</label>
        <input type='number' name='age' required>
        <label>Department:</label>
        <input type='text' name='department_name' required>
        <label>Address:</label>
        <input type='text' name='address' required>
        <label>Phone No:</label>
        <input type='text' name='phone_no' required>
        <label>Email:</label>
        <input type='email' name='email' required>
        <label>Password:</label>
        <input type='password' name='password' required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=]).{6,10}">
        <label>Date of Birth:</label>
        <input type='date' name='dob' required>
        <label>Blood Group:</label>
        <input type='text' name='blood_group' required>
        <label>Talent:</label>
        <input type='text' name='talent' required>
        <button type='submit'>Register</button>
    </form>
</div>
</body>
</html>
