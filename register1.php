<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "seed_money";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check current student count
$count_sql = "SELECT COUNT(*) AS total FROM student";
$count_result = $conn->query($count_sql);
$row = $count_result->fetch_assoc();
$student_count = $row['total'];

// Maximum allowed students
$max_students = 200;
$registration_open = ($student_count < $max_students);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gobi Arts & Science College - Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }
        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        .header img {
            max-width: 100px;
            float: left;
            margin-right: 20px;
        }
        .header {
            text-align: center;
            overflow: hidden;
        }
        .header h1, .header p {
            margin: 0;
            line-height: 1.4;
        }
        .form-section h2 {
            text-align: center;
            color: #0056b3;
            margin-bottom: 30px;
        }
        .form-group {
            margin: 15px 0;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #0056b3;
            color: #fff;
            padding: 12px 25px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #004494;
        }
        .registration-closed {
            background-color: #dc3545;
            color: white;
            padding: 25px;
            text-align: center;
            border-radius: 5px;
            margin: 30px 0;
            font-size: 1.2em;
        }
        .seat-counter {
            text-align: center;
            margin: 20px 0;
            padding: 15px;
            background-color: #e9f5ff;
            border-radius: 5px;
            font-weight: bold;
            color: #0056b3;
        }
        .required {
            color: red;
            margin-left: 3px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <img src="logo.png" alt="College Logo">
            <h1>GOBI ARTS & SCIENCE COLLEGE</h1>
            <p>(Govt. Aided Autonomous Co-educational Institution, Affiliated to Bharathiar University, Coimbatore)</p>
            <p>Accredited with 'A' Grade by NAAC [4th Cycle] and Recognised as a STAR College by DBT, Govt. of India</p>
            <p>KARATTADIPALAYAM POST, GOBICHETTIPALAYAM, ERODE DISTRICT - 638 453.</p>
            <hr>
        </div>

        <?php if (!$registration_open): ?>
            <div class="registration-closed">
                <h2>REGISTRATION CLOSED</h2>
                <p>We have reached the maximum capacity of 200 NSS volunteers.</p>
                <p>No further applications will be accepted for the 2025-26 academic year.</p>
            </div>
        <?php else: ?>
            <div class="seat-counter">
                Remaining Seats: <?php echo ($max_students - $student_count); ?> / 200
            </div>

            <!-- Form Section -->
            <div class="form-section">
                <h2>APPLICATION FORM FOR ENROLMENT IN NSS FORUM ACTIVITIES (2025-26)</h2>
                <form action="submit.php" method="post" onsubmit="return validateForm()">
                    
                    <!-- All form groups remain the same -->
                    <!-- Name -->
                    <div class="form-group">
                        <label for="name">Name <span class="required">*</span></label>
                        <input type="text" id="name" name="name" placeholder="Enter your full name" required>
                    </div>

                    <!-- Rollno -->
                    <div class="form-group">
                        <label for="rollno">Roll Number <span class="required">*</span></label>
                        <input type="text" id="rollno" name="rollno" placeholder="Enter your college roll number" required>
                    </div>
			<div>
<label for="gender">Gender</label>
    <select id="gender" name="gender" required>
        <option value="male">Male</option>
        <option value="female">Female</option></select></div>

                   <!-- Father's Name -->
                <div class="form-group">
                    <label for="fathername">Father's Name</label>
                    <input type="text" id="fathername" name="fathername" placeholder="Enter father's name" required>
                </div>
		<!--Mother Name -->
                <div class="form-group">
                    <label for="mothername">Mother Name</label>
                    <input type="text" id="mothername" name="mothername" placeholder="Enter your Mother's name" required>
                </div>
<div>
<label for="year">Year</label>
    <select id="year" name="year" required>
        <option value="">Select Year</option>
        <option value="I-Year">I</option>
        <option value="II-Year">II-Year</option></select>
</div>
		<!-- Department Name -->
                <div class="form-group">
    <label for="departmentname">Department Name</label>
    <select id="departmentname" name="departmentname" required>
        <option value="">Select Department</option>
        <option value="Economics-Aided">Economics (Aided)</option>
        <option value="Mathematics-Aided">Mathematics (Aided)</option>
        <option value="Physics-Aided">Physics (Aided)</option>
        <option value="Chemistry-Aided">Chemistry (Aided)</option>
        <option value="Botany-Aided">Botany (Aided)</option>
        <option value="Computer Science-Aided">Computer Science (Aided)</option>
        <option value="Commerce-Aided">Commerce (Aided)</option>
        <option value="BBA-Aided">BBA (Aided)</option>
        <option value="Physical Education">Physical Education</option>
        <option value="Tamil-UnAided">Tamil (UnAided)</option>
        <option value="English-UnAided">English (UnAided)</option>
        <option value="Mathematics-UnAided">Mathematics (UnAided)</option>
        <option value="Physics-UnAided">Physics (UnAided)</option>
        <option value="InternetOfThings-UnAided">Internet of Things (UnAided)</option>
        <option value="Chemistry-UnAided">Chemistry (UnAided)</option>
        <option value="Commerce-UnAided">Commerce (UnAided)</option>
        <option value="Commerce-CA-UnAided">Commerce (CA - UnAided)</option>
        <option value="Commerce-PA-UnAided">Commerce (PA - UnAided)</option>
        <option value="Commerce-BI&IT-UnAided">Commerce (BI & IT - UnAided)</option>
        <option value="BBA-UnAided">BBA (UnAided)</option>
        <option value="Computer Science-UnAided">Computer Science (UnAided)</option>
        <option value="BCA-UnAided">BCA (UnAided)</option>
        <option value="BSC-IT-UnAided">B.Sc. IT (UnAided)</option>
        <option value="BSC-AI&DS-UnAided">B.Sc. AI & DS (UnAided)</option>
    </select>
</div>

                <!-- Address -->
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea id="address" name="address" rows="3" placeholder="Enter your address" required></textarea>
                </div>
		<!-- Email -->
                <div class="form-group">
                    <label for="email">Email-id</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email">
                </div>
                <!-- Phone Number -->
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" placeholder="Enter your mobile number" required>
                </div>

                <!-- Date of Birth -->
                <div class="form-group">
                    <label for="dob">Date of Birth</label>
                    <input type="date" id="dob" name="dob" required>
                </div>

                <!-- Community -->
                <div class="form-group">
                    <label for="community">Community</label>
                    <input type="text" id="community" name="community" placeholder="Enter your community">
                </div>

                <!-- Blood Group -->
                <div class="form-group">
                    <label for="bloodgroup">Blood Group</label>
                    <input type="text" id="bloodgroup" name="bloodgroup" placeholder="Enter blood group">
                </div>
              
                <!-- Talents -->
                <div class="form-group">
                    <label for="talent">Talents</label>
                    <input type="text" id="talent" name="talent" placeholder="e.g., Creative Writing, Singing">
                </div>

                <!-- Place & Date -->
                <div class="form-group">
                    <label for="place">Place</label>
                    <input type="text" id="place" name="place" placeholder="Enter the place" required>
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" id="date" name="date" required>
                </div>

                    <!-- Submit Button -->
                    <div class="form-group" style="text-align: center; margin-top: 30px;">
                        <button type="submit">Submit Application</button>
                    </div>
                </form>
            </div>
        <?php endif; ?>
    </div>

    <script>
        function validateForm() {
            // Add any client-side validation here
            return true;
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>