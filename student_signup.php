<?php
// Include database connection
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $rollno = $_POST['rollno'];
    $name = $_POST['name'];
    $father_name = $_POST['father_name'];
    $mother_name = $_POST['mother_name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $talent = $_POST['talent'];
    $bloodgroup = $_POST['bloodgroup'];
    $dob = $_POST['dob'];
    $class = $_POST['class'];
    $department = $_POST['department'];
    $year = $_POST['year'];
    $stream = $_POST['stream'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $forum_name = $_POST['activity_name'];
    $activity_name = $_POST['activity_name'];
    $community = $_POST['community'];
    $age = $_POST['age'];

    // Check if roll number already exists
    $check_query = "SELECT rollno FROM student_data WHERE rollno = '$rollno'";
    $check_result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('Roll number already exists.'); window.history.back();</script>";
        exit;
    }

 // Check if passwords match
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
        exit();
    }

// Hash the password before storing
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    

    // SQL query to insert data into student_data table
    $sql_student_data = "INSERT INTO student_data (rollno, name, father_name, mother_name, email, gender, phone, talent, bloodgroup, dob, class, department, year, stream, password, forum_name, community, age)    
   VALUES ('$rollno', '$name', '$father_name', '$mother_name', '$email', '$gender', '$phone', '$talent', '$bloodgroup', '$dob', '$class', '$department', '$year', '$stream', '$password', '$forum_name', '$community', '$age')";

    if (mysqli_query($conn, $sql_student_data)) {
        // Determine which activity table to insert data into
        switch ($activity_name) {
            case 'National Service Scheme':
                $sql_activity = "INSERT INTO nss_student (rollno, name, father_name, mother_name, email, gender, phone, talent, bloodgroup, dob, class, department, year, stream, password, forum_name, community, age) 
                   VALUES ('$rollno', '$name', '$father_name', '$mother_name', '$email', '$gender', '$phone', '$talent', '$bloodgroup', '$dob', '$class', '$department', '$year', '$stream', '$password', '$forum_name', '$community', '$age')";
                break;
            case 'Youth Red Cross':
                $sql_activity = "INSERT INTO yrc_student (rollno, name, father_name, mother_name, email, gender, phone, talent, bloodgroup, dob, class, department, year, stream, password, forum_name, community, age) 
                 VALUES ('$rollno', '$name', '$father_name', '$mother_name', '$email', '$gender', '$phone', '$talent', '$bloodgroup', '$dob', '$class', '$department', '$year', '$stream', '$password', '$forum_name', '$community', '$age')";
                break;
            case 'Social Service League':
                $sql_activity = "INSERT INTO ssl_student (rollno, name, father_name, mother_name, email, gender, phone, talent, bloodgroup, dob, class, department, year, stream, password, forum_name, community, age) 
                 VALUES ('$rollno', '$name', '$father_name', '$mother_name', '$email', '$gender', '$phone', '$talent', '$bloodgroup', '$dob', '$class', '$department', '$year', '$stream', '$password', '$forum_name', '$community', '$age')";
                break;
            case 'Citizen Consumer Club':
                $sql_activity = "INSERT INTO ccc_student (rollno, name, father_name, mother_name, email, gender, phone, talent, bloodgroup, dob, class, department, year, stream, password, forum_name, community, age) 
                 VALUES ('$rollno', '$name', '$father_name', '$mother_name', '$email', '$gender', '$phone', '$talent', '$bloodgroup', '$dob', '$class', '$department', '$year', '$stream', '$password', '$forum_name', '$community', '$age')";
                break;
            case 'Environmental & Gardening Club':
                $sql_activity = "INSERT INTO egc_student (rollno, name, father_name, mother_name, email, gender, phone, talent, bloodgroup, dob, class, department, year, stream, password, forum_name, community, age) 
                  VALUES ('$rollno', '$name', '$father_name', '$mother_name', '$email', '$gender', '$phone', '$talent', '$bloodgroup', '$dob', '$class', '$department', '$year', '$stream', '$password', '$forum_name', '$community', '$age')";
                break;
            case 'Physical Education':
                $sql_activity = "INSERT INTO pe_student (rollno, name, father_name, mother_name, email, gender, phone, talent, bloodgroup, dob, class, department, year, stream, password, forum_name, community, age) 
                  VALUES ('$rollno', '$name', '$father_name', '$mother_name', '$email', '$gender', '$phone', '$talent', '$bloodgroup', '$dob', '$class', '$department', '$year', '$stream', '$password', '$forum_name', '$community', '$age')";
                break;
            case 'Blood Donors Club & Red Ribbon Club':
                $sql_activity = "INSERT INTO bdc_rr_student (rollno, name, father_name, mother_name, email, gender, phone, talent, bloodgroup, dob, class, department, year, stream, password, forum_name, community, age) 
                 VALUES ('$rollno', '$name', '$father_name', '$mother_name', '$email', '$gender', '$phone', '$talent', '$bloodgroup', '$dob', '$class', '$department', '$year', '$stream', '$password', '$forum_name', '$community', '$age')";
                break;
            case 'Clean Brigade':
                $sql_activity = "INSERT INTO cb_student (rollno, name, father_name, mother_name, email, gender, phone, talent, bloodgroup, dob, class, department, year, stream, password, forum_name, community, age) 
               VALUES ('$rollno', '$name', '$father_name', '$mother_name', '$email', '$gender', '$phone', '$talent', '$bloodgroup', '$dob', '$class', '$department', '$year', '$stream', '$password', '$forum_name', '$community', '$age')";
                break;
            case 'Gender Champions Club':
                $sql_activity = "INSERT INTO gcc_student (rollno, name, father_name, mother_name, email, gender, phone, talent, bloodgroup, dob, class, department, year, stream, password, forum_name, community, age) 
                VALUES ('$rollno', '$name', '$father_name', '$mother_name', '$email', '$gender', '$phone', '$talent', '$bloodgroup', '$dob', '$class', '$department', '$year', '$stream', '$password', '$forum_name', '$community', '$age')";
                break;
            case 'Rovers & Rangers':
                $sql_activity = "INSERT INTO rr_student (rollno, name, father_name, mother_name, email, gender, phone, talent, bloodgroup, dob, class, department, year, stream, password, forum_name, community, age) 
               VALUES ('$rollno', '$name', '$father_name', '$mother_name', '$email', '$gender', '$phone', '$talent', '$bloodgroup', '$dob', '$class', '$department', '$year', '$stream', '$password', '$forum_name', '$community', '$age')";
                break;
            case 'Anti Drug Club':
                $sql_activity = "INSERT INTO anti_student (rollno, name, father_name, mother_name, email, gender, phone, talent, bloodgroup, dob, class, department, year, stream, password, forum_name, community, age) 
                 VALUES ('$rollno', '$name', '$father_name', '$mother_name', '$email', '$gender', '$phone', '$talent', '$bloodgroup', '$dob', '$class', '$department', '$year', '$stream', '$password', '$forum_name', '$community', '$age')";
                break;
            case 'National Cadet Corps':
                $sql_activity = "INSERT INTO ncc_student (rollno, name, father_name, mother_name, email, gender, phone, talent, bloodgroup, dob, class, department, year, stream, password, forum_name, community, age) 
                VALUES ('$rollno', '$name', '$father_name', '$mother_name', '$email', '$gender', '$phone', '$talent', '$bloodgroup', '$dob', '$class', '$department', '$year', '$stream', '$password', '$forum_name', '$community', '$age')";
                break;
            default:
                echo "Invalid Activity Name.";
                exit;
        }

        // Insert into the corresponding activity table
        if (mysqli_query($conn, $sql_activity)) {
            echo "<script>alert('Registration successful!'); window.location.href='student_login.html';</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}


// Fetch departments from the departments table
$query = "SELECT department FROM departments";
$result = $conn->query($query);

// Check if departments exist
if (!$result) {
    die("Error fetching departments: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Co-Curricular Activity</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        label {
            font-size: 14px;
            color: #555;
            margin-top: 10px;
            display: block;
        }
        input[type="text"], input[type="password"], select {
            width: 100%;
            padding: 8px;
            margin: 10px 0 15px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            width: 100%;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Student Sign Up for Co-Curricular Activity</h1>
    <form action="student_signup.php" method="POST" onsubmit="return validateRollNo()">
       
	 <label for="rollno">Roll Number:</label>
        <input type="text" id="rollno" name="rollno" maxlength="7" required><br><br>
        
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" maxlength="30" required><br><br>
        
	<label>Father Name:</label>
        <input type='text' name='father_name' required>

	<label>Mother Name:</label>
        <input type='text' name='mother_name' required>
      
	<label>Email:</label>
  	<input type='email' name='email' required>
     	
	<label>Gender:</label>
        <select name='gender'>
            <option value='Male'>Male</option>
            <option value='Female'>Female</option>
	    <option value='Others'>Others</option>
        </select>
    	
	<label>Phone No:</label>
        <input type='text' name='phone' required>
    	
	<label>Talent:(Optional)</label>
        <input type='text' name='talent' required>
   
	<label for="bloodgroup">Blood Group:</label>
	<select name="bloodgroup" id="bloodgroup" required>
         <option value="A+">A+</option>
         <option value="A-">A-</option>
         <option value="B+">B+</option>
         <option value="B-">B-</option>
         <option value="O+">O+</option>
         <option value="O-">O-</option>
         <option value="AB+">AB+</option>
         <option value="AB-">AB-</option>
       </select><br><br>
       
	<label>Date of Birth:</label>
        <input type='date' name='dob' required>

        <label>Class:</label>
        <select name='class'>
            <option value='I'>I</option>
            <option value='II'>II</option>
	    <option value='III'>III</option>
        </select>
	

        <label for="department">Department:</label>
        <select name="department" id="department" required>
            <?php
            // Fetch departments from the database and display them in the dropdown
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['department'] . "'>" . $row['department'] . "</option>";
            }
            ?>
        </select><br><br>
	 
        <label for="year">Year of Joining:</label>
        <input type="text" id="year" name="year" maxlength="4" required><br><br>
        
	 <label for="stream">Stream:</label>
        <select name="stream" id="stream" required>
            <option value="Aided">Aided</option>
            <option value="Un-Aided">Un-Aided</option>
        </select><br><br>
       

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" maxlength="20" required><br><br>

	<label>Confirm Password:</label>
                <input type="password" name="confirm_password" id="confirm_password"><br>
           
        
        <label for="activity_name">Co-Curricular Activity Name:</label>
        <select name="activity_name" id="activity_name" required>
 	    <option value="Anti Drug Club">Anti Drug Club</option>
            <option value="Blood Donors Club & Red Ribbon Club">Blood Donors Club & Red Ribbon Club</option>
            <option value="Citizen Consumer Club">Citizen Consumer Club</option>
            <option value="Clean Brigade">Clean Brigade</option>
            <option value="Environmental & Gardening Club">Environmental & Gardening Club</option>
            <option value="Gender Champions Club">Gender Champions Club</option>
            <option value="National Service Scheme">National Service Scheme</option>
            <option value="National Cadet Corps">National Cadet Corps</option>
            <option value="Physical Education">Physical Education</option>
            <option value="Rovers & Rangers">Rovers & Rangers</option>
            <option value="Social Service League">Social Service League</option>
            <option value="Youth Red Cross">Youth Red Cross</option>

           
        </select><br><br>


	<label>Community:</label>
        <input type='text' name='community' required><br>
   
	<label>Age:</label>
        <input type='number' name='age' required><br><br>

        <button type="submit">Sign Up</button>
    </form>
</div>

<script>
function validateRollNo() {
    let stream = document.getElementById("stream").value;
    let year = document.getElementById("year").value;
    let rollNo = document.getElementById("rollno").value;
    let rollPatternAided = /^\d{2}[a-zA-Z]{2}0\d{2}$/;  // Aided format: YYAB0XX
    let rollPatternUnAided = /^\d{2}[a-zA-Z]{2}\d{3}$/; // Un-Aided format: YYABXXX
    
    if (!/^(20\d{2})$/.test(year)) {
        alert("Invalid year of joining. Enter a valid year (e.g., 2022, 2023, etc.).");
        return false;
    }
    
    if (!rollNo.startsWith(year.substring(2))) {
        alert("Roll number must start with the last two digits of the year of joining.");
        return false;
    }
    
    if (stream === "Aided" && !rollPatternAided.test(rollNo)) {
        alert("Invalid roll number format for Aided stream. Format: YYAB0XX (e.g., 12AB012).");
        return false;
    }
    
    if (stream === "Un-Aided" && !rollPatternUnAided.test(rollNo)) {
        alert("Invalid roll number format for Un-Aided stream. Format: YYABXXX (e.g., 12AB123).");
        return false;
    }

    return true;
}

// Function to update forum options based on roll number format
function updateActivityOptions() {
    let rollNo = document.getElementById("rollno").value;
    let rollPatternAided = /^\d{2}[a-zA-Z]{2}0\d{2}$/;
    let activitySelect = document.getElementById("activity_name");

    // Store all activity options
    let allOptions = [
        "National Service Scheme",
        "Youth Red Cross",
        "Social Service League",
        "Citizen Consumer Club",
        "Environmental & Gardening Club",
        "Physical Education",
        "Blood Donors Club & Red Ribbon Club",
        "Clean Brigade",
        "Gender Champions Club",
        "Rovers & Rangers",
        "Anti Drug Club",
        "National Cadet Corps"
    ];

    // Clear existing options
    activitySelect.innerHTML = "";

    // If roll number matches Aided format, include NCC
    if (rollPatternAided.test(rollNo)) {
        allOptions.forEach(option => {
            let opt = document.createElement("option");
            opt.value = option;
            opt.textContent = option;
            activitySelect.appendChild(opt);
        });
    } else {
        // If roll number doesn't match Aided format, exclude NCC
        allOptions.filter(option => option !== "National Cadet Corps").forEach(option => {
            let opt = document.createElement("option");
            opt.value = option;
            opt.textContent = option;
            activitySelect.appendChild(opt);
        });
    }
}

// Event listener for roll number input change
document.getElementById("rollno").addEventListener("input", updateActivityOptions);
</script>

</body>
</html>
