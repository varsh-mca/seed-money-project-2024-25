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

// Fetch data
$sql = "SELECT * FROM cb_student";
$result = $conn->query($sql);

// Count total, boys, and girls
$totalStudents = $result->num_rows;
$boysCount = $conn->query("SELECT COUNT(*) AS count FROM cb_student WHERE gender = 'Male'")->fetch_assoc()['count'];
$girlsCount = $conn->query("SELECT COUNT(*) AS count FROM cb_student WHERE gender = 'Female'")->fetch_assoc()['count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clean Bridge Club Students Records</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
            color: #333;
        }
        .table-container {
            max-width: 100%;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }
        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        .stats {
            text-align: center;
            margin-bottom: 15px;
            font-size: 16px;
            color: #555;
        }
        .add-btn-container {
            text-align: right;
            margin-bottom: 15px;
        }
        .add-btn {
            background-color: #2c3e50;
            color: white;
            padding: 10px 25px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .add-btn:hover {
            background-color: #34495e;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
            min-width: 1400px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
            font-size: 14px;
            white-space: nowrap;
        }
        th {
            background-color: #2c3e50;
            color: #fff;
            position: sticky;
            top: 0;
            font-weight: 600;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .action-buttons {
            display: flex;
            gap: 8px;
            justify-content: center;
        }
        .action-buttons a {
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 13px;
            transition: opacity 0.3s;
            text-decoration: none;
        }
        .edit-btn {
            background-color: #27ae60;
            color: white;
        }
        .delete-btn {
            background-color: #c0392b;
            color: white;
        }
        .action-buttons a:hover {
            opacity: 0.9;
        }
        @media screen and (max-width: 768px) {
            .table-container {
                padding: 10px;
            }
            th, td {
                padding: 8px;
                font-size: 13px;
            }
        }
    </style>
</head>
<body>
    <div class="table-container">
        <h1>Clean Bridge Club Students Records</h1>
        <div class="stats">
            <p>Total Students: <?php echo $totalStudents; ?> | Boys: <?php echo $boysCount; ?> | Girls: <?php echo $girlsCount; ?></p>
        </div>
       
        <table>
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Roll No</th>
 <th>Gender</th>
                    <th>Father</th>
                    <th>Mother</th>
                    <th>Year</th>
                    <th>Department</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>DOB</th>
                    <th>Community</th>
                    <th>Blood</th>
                    <th>Talent</th>
                    <th>Place</th>
                    <th>Date</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['rollno']}</td>
<td>{$row['gender']}</td>
                                <td>{$row['father_name']}</td>
                                <td>{$row['mother_name']}</td>
                                <td>{$row['year']}</td>
                                <td>{$row['department']}</td>
                                <td>{$row['address']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['phone']}</td>
                                <td>{$row['dob']}</td>
                                <td>{$row['community']}</td>
                                <td>{$row['bloodgroup']}</td>
                                <td>{$row['talent']}</td>
                                <td>{$row['place']}</td>
                                <td>{$row['date']}</td>
                                <td>{$row['created_at']}</td>
                                <td class='action-buttons'>
                                    <a href='cb_edit.php?id={$row['id']}' class='edit-btn'>Edit</a>
                                    <a href='cb_delete.php?id={$row['id']}' class='delete-btn' onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='18' style='text-align:center; padding:20px;'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
