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

// Fetch record
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    $sql = "SELECT * FROM cb_student WHERE id = $id";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        die("Record not found");
    }
    $row = $result->fetch_assoc();
}

// Update record
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    $activityname = $_POST['activityname'];
    $password = $_POST['password'];
    $community = $_POST['community'];
    $bloodgroup = $_POST['bloodgroup'];
    $talent = $_POST['talent'];
    $place = $_POST['place'];
    $date = $_POST['date'];

    $sql = "UPDATE cb_student SET 
            name='$name', rollno='$rollno', gender='$gender', fathername='$fathername', 
            mothername='$mothername', year='$year', departmentname='$departmentname', 
            address='$address', email='$email', phone='$phone', dob='$dob', 
            activityname='$activityname', password='$password', community='$community', 
            bloodgroup='$bloodgroup', talent='$talent', place='$place', date='$date' 
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record updated successfully'); window.location.href='admin_dasboard.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Student</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            padding: 20px;
        }
        form {
            max-width: 600px;
            margin: auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #2c3e50;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
            color: #333;
        }
        input[type="text"], input[type="email"], input[type="password"], input[type="date"], select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }
        input[type="submit"] {
            background-color: #27ae60;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 10px 15px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 15px;
        }
        input[type="submit"]:hover {
            background-color: #219150;
        }
    </style>
</head>

<body>
    <form action="" method="post">
        <h1>Edit Student Record</h1>
        <label>Name</label><input type="text" name="name" value="<?php echo $row['name']; ?>" required>
        <label>Roll No</label><input type="text" name="rollno" value="<?php echo $row['rollno']; ?>" required>
        <label>Gender</label>
        <select name="gender">
            <option value="Male" <?php echo $row['gender'] == 'Male' ? 'selected' : ''; ?>>Male</option>
            <option value="Female" <?php echo $row['gender'] == 'Female' ? 'selected' : ''; ?>>Female</option>
        </select>
        <label>Father's Name</label><input type="text" name="fathername" value="<?php echo $row['fathername']; ?>">
        <label>Mother's Name</label><input type="text" name="mothername" value="<?php echo $row['mothername']; ?>">
        <label>Year</label><input type="text" name="year" value="<?php echo $row['year']; ?>">
        <label>Department</label><input type="text" name="departmentname" value="<?php echo $row['departmentname']; ?>">
        <label>Address</label><input type="text" name="address" value="<?php echo $row['address']; ?>">
        <label>Email</label><input type="email" name="email" value="<?php echo $row['email']; ?>">
        <label>Phone</label><input type="text" name="phone" value="<?php echo $row['phone']; ?>">
        <label>Date of Birth</label><input type="date" name="dob" value="<?php echo $row['dob']; ?>">
        <label>Activity Name</label><input type="text" name="activityname" value="<?php echo $row['activityname']; ?>">
        <label>Password</label><input type="password" name="password" value="<?php echo $row['password']; ?>">
        <label>Community</label><input type="text" name="community" value="<?php echo $row['community']; ?>">
        <label>Blood Group</label><input type="text" name="bloodgroup" value="<?php echo $row['bloodgroup']; ?>">
        <label>Talent</label><input type="text" name="talent" value="<?php echo $row['talent']; ?>">
        <label>Place</label><input type="text" name="place" value="<?php echo $row['place']; ?>">
        <label>Date</label><input type="date" name="date" value="<?php echo $row['date']; ?>">
        <input type="submit" value="Update">
    </form>
</body>
</html>

<?php
$conn->close();
?>
