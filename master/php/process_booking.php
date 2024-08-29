<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_SESSION['user']['admission_number'];  // Assuming the student is logged in
    $accomodation_id = $_POST['accomodation'];
    $booking_date = date('Y-m-d');  // Current date
    $start_date = $_POST['start_date'];  // Assuming you have start and end dates in your form
    $end_date = $_POST['end_date'];
    $status = 'pending';  // Default status

    $sql = "INSERT INTO BOOKING (student_id, accomodation_id, booking_date, start_date, end_date, status)
            VALUES ('$student_id', '$accomodation_id', '$booking_date', '$start_date', '$end_date', '$status')";

    if ($conn->query($sql) === TRUE) {
        echo "Booking submitted successfully!";
        // Optionally redirect to a confirmation page
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>