<?php
session_start();
include 'php/db_connect.php';
if(!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_SESSION['user']['admission_number'];
    $accommodation = $_POST['accommodation'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $status = 'pending';

    $sql = "INSERT INTO BOOKING (student_id, accommodation, booking_date, start_date, end_date, status)
            VALUES ('$student_id', '$accommodation', CURDATE(), '$start_date', '$end_date', '$status')";

    if ($conn->query($sql) === TRUE) {
        echo "Booking request submitted successfully.";
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
    <title>Unitopia - Book a Tour/Accommodation</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<div class="navbar">
    <a href="student_dashboard.php">Dashboard</a>
    <a href="booking.php">Book a Tour/Accommodation</a>
    <a href="services.php">Services</a>
    <a href="contact.php">Contact Us</a>
    <a href="about.php">About Us</a>
    <a href="php/logout.php">Logout</a>
</div>

<div class="container">
    <h1>Book a Tour/Accommodation</h1>
    <form action="booking.php" method="POST">
        <label for="accommodation">Accommodation:</label>
        <select name="accommodation" id="accommodation" required>
            <!-- Add dynamic options from the ACCOMMODATION table -->
            <?php
$booking_id = $_GET['booking_id'];  // Assuming you pass the booking ID in the URL

$sql = "UPDATE ACCOMODATION SET availability_status = 'booked' WHERE accomodation_id = (SELECT accomodation_id FROM BOOKING WHERE booking_id = '$booking_id')";

if ($conn->query($sql) === TRUE) {
    echo "Accommodation status updated successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
            <?php
            $result = $conn->query("SELECT name FROM ACCOMMODATION WHERE availability_status='available'");
            while($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
            }
            ?>
        </select><br><br>
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date" required><br><br>
        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date" required><br><br>
        <button type="submit">Submit Booking</button>
    </form>
</div>

<script src="js/script.js"></script>
</body>
</html>

