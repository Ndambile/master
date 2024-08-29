<?php
include('db_connect.php');

// Handle form submission for adding feedback
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $booking_id = $_POST['booking_id'];
    $student_id = $_POST['student_id'];
    $rating = $_POST['rating'];
    $comments = $_POST['comments'];
    $date = date('Y-m-d'); // Current date

    $query = "INSERT INTO FEEDBACK (booking_id, student_id, rating, comments, date) 
              VALUES ('$booking_id', '$student_id', '$rating', '$comments', '$date')";

    if (mysqli_query($conn, $query)) {
        echo "Feedback added successfully.";
        header('Location: manage_feedback.php'); // Redirect to student dashboard or another page
        exit();
    } else {
        echo "Error adding feedback: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Feedback - Unitopia</title>
</head>
<body>
    <h1>Add Feedback</h1>
    <form method="POST">
        <label>Booking ID:</label>
        <input type="text" name="booking_id" required><br>

        <label>Student ID:</label>
        <input type="text" name="student_id" required><br>

        <label>Rating:</label>
        <input type="number" name="rating" min="1" max="5" required><br>

        <label>Comments:</label>
        <textarea name="comments" required></textarea><br>

        <input type="submit" value="Add Feedback">
    </form>
</body>
</html>