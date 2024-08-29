<?php
session_start();
include 'db_connect.php';

// Ensure only admins can access this page
// if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
//     header("Location: admin_login.php");
//     exit();
// }

$sql = "SELECT * FROM feedback";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Students</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<div class="navbar">
    <a href="ad.php">Dashboard</a>
    <a href="admin_logout.php">Logout</a>
</div>

<div class="container">
    <h1>Manage feedback</h1>

    <table>
        <thead>
            <tr>
                <th>feedback_id</th>
                <th>booking_id</th>
                <th>student_id</th>
                <th>rating</th>
                <th>comments</th>
                <th>date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['feedback_id']}</td>
                        <td>{$row['booking_id']}</td>
                        <td>{$row['student_id']}</td>
                        <td>{$row['rating']}</td>
                        <td>{$row['comments']}</td>
                        <td>{$row['date']}</td>
                        <td><a href='manage/editf.php?id={$row['feedback_id']}'>Edit</a> | <a href='manage/deletef.php?id={$row['feedback_id']}'>Delete</a></td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No feedback found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="js/script.js"></script>
</body>
</html>

<?php
$conn->close();
?>