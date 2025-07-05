<?php
include "db_connection.php"; // Database connection
session_start();

if (!isset($_SESSION['rollno'])) {
    die("Unauthorized access. Please log in.");
}

$rollno = $_SESSION['rollno'];

// Fetch student's year from nss_student table using roll number
$stmt = $conn->prepare("SELECT year FROM nss_student WHERE rollno = ?");
$stmt->bind_param("s", $rollno);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();
$stmt->close();

// Fetch student's year from anti_student table using roll number
$stmt = $conn->prepare("SELECT year FROM anti_student WHERE rollno = ?");
$stmt->bind_param("s", $rollno);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();
$stmt->close();

// Fetch student's year from bdc_rr_student table using roll number
$stmt = $conn->prepare("SELECT year FROM bdc_rr_student WHERE rollno = ?");
$stmt->bind_param("s", $rollno);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();
$stmt->close();

// Fetch student's year from cb_student table using roll number
$stmt = $conn->prepare("SELECT year FROM cb_student WHERE rollno = ?");
$stmt->bind_param("s", $rollno);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();
$stmt->close();

// Fetch student's year from ccc_student table using roll number
$stmt = $conn->prepare("SELECT year FROM ccc_student WHERE rollno = ?");
$stmt->bind_param("s", $rollno);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();
$stmt->close();

// Fetch student's year from ncc_student table using roll number
$stmt = $conn->prepare("SELECT year FROM ncc_student WHERE rollno = ?");
$stmt->bind_param("s", $rollno);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();
$stmt->close();

// Fetch student's year from egc_student table using roll number
$stmt = $conn->prepare("SELECT year FROM egc_student WHERE rollno = ?");
$stmt->bind_param("s", $rollno);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();
$stmt->close();

// Fetch student's year from gcc_student table using roll number
$stmt = $conn->prepare("SELECT year FROM gcc_student WHERE rollno = ?");
$stmt->bind_param("s", $rollno);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();
$stmt->close();

// Fetch student's year from pe_student table using roll number
$stmt = $conn->prepare("SELECT year FROM pe_student WHERE rollno = ?");
$stmt->bind_param("s", $rollno);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();
$stmt->close();

// Fetch student's year from rr_student table using roll number
$stmt = $conn->prepare("SELECT year FROM rr_student WHERE rollno = ?");
$stmt->bind_param("s", $rollno);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();
$stmt->close();

// Fetch student's year from ssl_student table using roll number
$stmt = $conn->prepare("SELECT year FROM ssl_student WHERE rollno = ?");
$stmt->bind_param("s", $rollno);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();
$stmt->close();

// Fetch student's year from yrc_student table using roll number
$stmt = $conn->prepare("SELECT year FROM yrc_student WHERE rollno = ?");
$stmt->bind_param("s", $rollno);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();
$stmt->close();

if (!$student) {
    die("Student not found.");
}

$year = $student['year']; // Get student's year
$current_datetime = date("Y-m-d H:i:s"); // Get current date and time
// Fetch messages for the student's year where date and time are not expired
$stmt = $conn->prepare("SELECT message, image_path, date, time FROM nss_message WHERE year = ? AND CONCAT(date, ' ', time) > ? ORDER BY date DESC, time DESC");
$stmt->bind_param("ss", $year, $current_datetime);
$stmt->execute();
$messages = $stmt->get_result();

// Fetch messages for the student's year where date and time are not expired
$stmt = $conn->prepare("SELECT message, image_path, date, time FROM anti_message WHERE year = ? AND CONCAT(date, ' ', time) > ? ORDER BY date DESC, time DESC");
$stmt->bind_param("ss", $year, $current_datetime);
$stmt->execute();
$messages = $stmt->get_result();

// Fetch messages for the student's year where date and time are not expired
$stmt = $conn->prepare("SELECT message, image_path, date, time FROM ncc_message WHERE year = ? AND CONCAT(date, ' ', time) > ? ORDER BY date DESC, time DESC");
$stmt->bind_param("ss", $year, $current_datetime);
$stmt->execute();
$messages = $stmt->get_result();

// Fetch messages for the student's year where date and time are not expired
$stmt = $conn->prepare("SELECT message, image_path, date, time FROM gcc_message WHERE year = ? AND CONCAT(date, ' ', time) > ? ORDER BY date DESC, time DESC");
$stmt->bind_param("ss", $year, $current_datetime);
$stmt->execute();
$messages = $stmt->get_result();

// Fetch messages for the student's year where date and time are not expired
$stmt = $conn->prepare("SELECT message, image_path, date, time FROM egc_message WHERE year = ? AND CONCAT(date, ' ', time) > ? ORDER BY date DESC, time DESC");
$stmt->bind_param("ss", $year, $current_datetime);
$stmt->execute();
$messages = $stmt->get_result();

// Fetch messages for the student's year where date and time are not expired
$stmt = $conn->prepare("SELECT message, image_path, date, time FROM ccc_message WHERE year = ? AND CONCAT(date, ' ', time) > ? ORDER BY date DESC, time DESC");
$stmt->bind_param("ss", $year, $current_datetime);
$stmt->execute();
$messages = $stmt->get_result();

// Fetch messages for the student's year where date and time are not expired
$stmt = $conn->prepare("SELECT message, image_path, date, time FROM bdc_rr_message WHERE year = ? AND CONCAT(date, ' ', time) > ? ORDER BY date DESC, time DESC");
$stmt->bind_param("ss", $year, $current_datetime);
$stmt->execute();
$messages = $stmt->get_result();

// Fetch messages for the student's year where date and time are not expired
$stmt = $conn->prepare("SELECT message, image_path, date, time FROM rr_message WHERE year = ? AND CONCAT(date, ' ', time) > ? ORDER BY date DESC, time DESC");
$stmt->bind_param("ss", $year, $current_datetime);
$stmt->execute();
$messages = $stmt->get_result();

// Fetch messages for the student's year where date and time are not expired
$stmt = $conn->prepare("SELECT message, image_path, date, time FROM pe_message WHERE year = ? AND CONCAT(date, ' ', time) > ? ORDER BY date DESC, time DESC");
$stmt->bind_param("ss", $year, $current_datetime);
$stmt->execute();
$messages = $stmt->get_result();

// Fetch messages for the student's year where date and time are not expired
$stmt = $conn->prepare("SELECT message, image_path, date, time FROM ssl_message WHERE year = ? AND CONCAT(date, ' ', time) > ? ORDER BY date DESC, time DESC");
$stmt->bind_param("ss", $year, $current_datetime);
$stmt->execute();
$messages = $stmt->get_result();

// Fetch messages for the student's year where date and time are not expired
$stmt = $conn->prepare("SELECT message, image_path, date, time FROM yrc_message WHERE year = ? AND CONCAT(date, ' ', time) > ? ORDER BY date DESC, time DESC");
$stmt->bind_param("ss", $year, $current_datetime);
$stmt->execute();
$messages = $stmt->get_result();

// Fetch messages for the student's year where date and time are not expired
$stmt = $conn->prepare("SELECT message, image_path, date, time FROM cb_message WHERE year = ? AND CONCAT(date, ' ', time) > ? ORDER BY date DESC, time DESC");
$stmt->bind_param("ss", $year, $current_datetime);
$stmt->execute();
$messages = $stmt->get_result();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            width: 60%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .message-box {
            background: #fff;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
        }
        .message-date {
            font-size: 12px;
            color: #888;
        }
        .message-img {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Student Dashboard</h2>
        <h3>Latest Messages</h3>
        
        <?php if ($messages->num_rows > 0): ?>
            <?php while ($row = $messages->fetch_assoc()): ?>
                <div class="message-box">
                    <p><strong>Message:</strong> <?php echo htmlspecialchars($row['message']); ?></p>
                    <p class="message-date">Date: <?php echo $row['date']; ?> | Time: <?php echo $row['time']; ?></p>
                    
                    <?php if (!empty($row['image_path'])): ?>
                        <?php if (pathinfo($row['image_path'], PATHINFO_EXTENSION) == 'pdf'): ?>
                            <p><a href="<?php echo $row['image_path']; ?>" target="_blank">View Attached PDF</a></p>
                        <?php else: ?>
                            <img src="<?php echo $row['image_path']; ?>" class="message-img">
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No messages available.</p>
        <?php endif; ?>
    </div>
</body>
</html>