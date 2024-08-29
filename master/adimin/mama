<?php
session_start();
if(!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unitopia - Student Dashboard</title>
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
    <h1>Welcome, <?php echo $_SESSION['user']['name']; ?></h1>
    <p>Manage your bookings, view feedback, and more.</p>
</div>


<div class="dashboard-section">
    <h2>Your Profile</h2>
    <p><strong>Admission Number:</strong> <?php echo $_SESSION['user']['admission_number']; ?></p>
    <p><strong>Email:</strong> <?php echo  $_SESSION['user']['email']; ?></p>
    <p><strong>Gender:</strong> <?php echo  $_SESSION['user']['gender']; ?></p>
    <p><strong>Year of Study:</strong> <?php echo  $_SESSION['user']['year_of_study']; ?></p>
    <p><strong>Nationality:</strong> <?php echo   $_SESSION['user']['nationality']; ?></p>
    <p><strong>Course:</strong> <?php echo  $_SESSION['user']['course']; ?></p>
    <p><strong>Region:</strong> <?php echo  $_SESSION['user']['region']; ?></p>
</div>

<div class="dashboard-section">
    <h2>Your Bookings</h2>
    <?php if (mysqli_num_rows($booking_result) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Accommodation</th>
                    <th>University</th>
                    <th>Booking Date</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Guide Info</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($booking = mysqli_fetch_assoc($booking_result)): ?>
                    <tr>
                        <td><?php echo $booking['booking_Id']; ?></td>
                        <td><?php echo $booking['accommodation_name'] . ', ' . $booking['address']; ?></td>
                        <td><?php echo $booking['university_name']; ?></td>
                        <td><?php echo $booking['booking_data']; ?></td>
                        <td><?php echo $booking['start_date']; ?></td>
                        <td><?php echo $booking['end_date']; ?></td>
                        <td><?php echo ucfirst($booking['status']); ?></td>
                        <td>
                            <?php if ($booking['status'] == 'accepted'): ?>
                                <?php
                                $guide_query = "SELECT G.name, G.phone FROM TOUR T
                                                JOIN GUIDE G ON T.guide_Id = G.guide_Id
                                                WHERE T.university_Id = '{$booking['accomodation']}' 
                                                AND T.tour_Id = '{$booking['booking_Id']}'";
                                $guide_result = mysqli_query($conn, $guide_query);
                                $guide = mysqli_fetch_assoc($guide_result);
                                ?>
                                <?php echo $guide['name'] . '<br>' . $guide['phone']; ?>
                            <?php else: ?>
                                N/A
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>You have no bookings yet.</p>
    <?php endif; ?>
</div>

<div class="dashboard-section">
    <h2>Your Feedback</h2>
    <?php
    $feedback_query = "SELECT F.*, T.description AS tour_description
                       FROM FEEDBACK F
                       JOIN TOUR T ON F.booking_Id = T.tour_Id
                       WHERE F.student_id = '$student_id'";
    $feedback_result = mysqli_query($conn, $feedback_query);
    ?>
    <?php if (mysqli_num_rows($feedback_result) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Feedback ID</th>
                    <th>Booking ID</th>
                    <th>Tour</th>
                    <th>Rating</th>
                    <th>Comments</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($feedback = mysqli_fetch_assoc($feedback_result)): ?>
                    <tr>
                        <td><?php echo $feedback['feedback_id']; ?></td>
                        <td><?php echo $feedback['booking_Id']; ?></td>
                        <td><?php echo $feedback['tour_description']; ?></td>
                        <td><?php echo $feedback['rating']; ?>/5</td>
                        <td><?php echo $feedback['comments']; ?></td>
                        <td><?php echo $feedback['date']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>You have no feedback yet.</p>
    <?php endif; ?>
</div>
</div>

<script src="js/script.js"></script>
</body>
</html>

<?php
mysqli_close($conn);
?>

