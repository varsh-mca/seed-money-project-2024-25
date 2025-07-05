<?php
include "db_connection.php";
session_start();

if (!isset($_SESSION['rollno'])) {
    die("Unauthorized access. Please log in.");
}

$rollno = $_SESSION['rollno'];

// Map of forum => student table
$forum_tables = [
    'nss' => 'nss_student',
    'anti' => 'anti_student',
    'ncc' => 'ncc_student',
    'ssl' => 'ssl_student',
    'ccc' => 'ccc_student',
    'yrc' => 'yrc_student',
    'cb' => 'cb_student',
    'gcc' => 'gcc_student',
    'egc' => 'egc_student',
    'pe' => 'pe_student',
    'rr' => 'rr_student',
    'bdc_rr' => 'bdc_rr_student'
];

$forums_of_student = [];
$year = null;

foreach ($forum_tables as $forum => $table) {
    $stmt = $conn->prepare("SELECT year FROM $table WHERE rollno = ?");
    $stmt->bind_param("s", $rollno);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($student = $result->fetch_assoc()) {
        $forums_of_student[] = $forum;
        if (!$year) {
            $year = $student['year'];
        }
    }
    $stmt->close();
}

if (!$year || empty($forums_of_student)) {
    die("No forums associated with this student.");
}

$current_datetime = date("Y-m-d H:i:s");

// Now fetch messages only from the forums the student belongs to
$messages = [];
foreach ($forums_of_student as $forum) {
    $message_table = $forum . '_message'; // e.g., 'nss_message'
    $stmt = $conn->prepare("SELECT message, image_path, date, time FROM $message_table WHERE year = ? AND CONCAT(date, ' ', time) > ? ORDER BY date DESC, time DESC");
    $stmt->bind_param("ss", $year, $current_datetime);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
    $stmt->close();
}

$conn->close();

// Sort messages by date and time
usort($messages, function ($a, $b) {
    return strtotime($b['date'] . ' ' . $b['time']) - strtotime($a['date'] . ' ' . $a['time']);
});
?>
