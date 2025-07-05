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
$sql = "SELECT * FROM ssl_staff";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Service League Staff Records</title>
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
            min-width: 800px;
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
    </style>
</head>
<body>
    <div class="table-container">
        <h1>Student Service League Staff Records</h1>
        <table>
            <thead>
                <tr>
                    <th>Staff ID</th>
                    <th>Staff Name</th>
                    <th>Department</th>
                    <th>Position</th>
                   
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['staffid']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['department']}</td>
                                <td>{$row['position']}</td>
                                <td class='action-buttons'>
                                    <a href='edit.php?id={$row['id']}' class='edit-btn'>Edit</a>
                                    <a href='delete.php?id={$row['id']}' class='delete-btn' onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align:center; padding:20px;'>No records found</td></tr>";
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
