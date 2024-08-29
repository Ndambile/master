<?php
session_start();
include 'db_connect.php';

// Ensure only admins can access this page


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $sql = "INSERT INTO GUIDE (name, phone, email) VALUES ('$name', '$phone', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "New guide added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Guide</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<div class="navbar">
    <a href="ad.php">Dashboard</a>
    <a href="view_guides.php">Manage Guides</a>
    <a href="admin_logout.php">Logout</a>
</div>

<div class="container">
    <h1>Add New Guide</h1>
    <form action="add_guide.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="phone">Phone:</label>
        <input type="text" name="phone" id="phone" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <button type="submit">Add Guide</button>
    </form>
</div>

<script src="js/script.js"></script>
</body>
</html>