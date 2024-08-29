<?php
session_start();
include 'php/db_connect.php';

// Ensure only admins can access this page
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unitopia Admin Dashboard</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<div class="navbar">
    <a href="admin.php">Dashboard</a>
    <a href="add_guide.php">Add Guide</a>
    <a href="manage_students.php">Manage Students</a>
    <a href="manage_accommodations.php">Manage Accommodations</a>
    <a href="manage_tours.php">Manage Tours</a>
    <a href="manage_feedback.php">Manage Feedback</a>
    <a href="admin_logout.php">Logout</a>
</div>

<div class="container">
    <h1>Welcome to the Admin Dashboard</h1>
    <p>Select an option from the navigation bar to manage the system.</p>

    <div class="dashboard-section">
        <h2>Manage Guides</h2>
        <a href="add_guide.php">Add New Guide</a><br>
        <a href="view_guides.php">View All Guides</a>
    </div>

    <div class="dashboard-section">
        <h2>Manage Students</h2>
        <a href="manage_students.php">View and Manage Students</a>
    </div>

    <div class="dashboard-section">
        <h2>Manage Accommodations</h2>
        <a href="manage_accommodations.php">View and Manage Accommodations</a>
    </div>

    <div class="dashboard-section">
        <h2>Manage Tours</h2>
        <a href="manage_tours.php">View and Manage Tours</a>
    </div>

    <div class="dashboard-section">
        <h2>Manage Feedback</h2>
        <a href="manage_feedback.php">View and Manage Feedback</a>
    </div>
</div>

<script src="js/script.js"></script>
</body>
</html>