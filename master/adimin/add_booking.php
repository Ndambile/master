<?php
include('db_connect.php');

// Handle form submission for adding a new booking
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $_POST['student_id'];
    $accomodation = $_POST['accomodation'];
    $booking_data = $_POST['booking_data'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $status = 'pending'; // Default status

    $query = "INSERT INTO BOOKING (student_id, accomodation, booking_data, start_date, end_date, status) 
              VALUES ('$student_id', '$accomodation', '$booking_data', '$start_date', '$end_date', '$status')";

    if (mysqli_query($conn, $query)) {
        echo "Booking added successfully.";
        header('Location: manage_booking.php'); // Redirect to student dashboard or another page
        exit();
    } else {
        echo "Error adding booking: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Booking - Unitopia</title>
</head>
<body>
    <h1>Add New Booking</h1>
    <form method="POST">
        <label>Student ID:</label>
        <input type="text" name="student_id" required><br>

        <label>Accommodation:</label>
        <input type="text" name="accomodation" required><br>

        <label>Booking Date:</label>
        <input type="date" name="booking_data" required><br>

        <label>Start Date:</label>
        <input type="date" name="start_date" required><br>

        <label>End Date:</label>
        <input type="date" name="end_date" required><br>

        <input type="submit" value="Add Booking">
    </form>
</body>
</html>