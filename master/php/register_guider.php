<?php
session_start();
include 'db_connect.php';
    header("Location: admin_login.php");
    exit();


// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    // Validate inputs
    if (empty($name) || empty($phone) || empty($email)) {
        $error_message = "All fields are required.";
    } else {
        // Check if the email is already registered
        $sql_check = "SELECT * FROM GUIDE WHERE email = '$email'";
        $result_check = $conn->query($sql_check);

        if ($result_check->num_rows > 0) {
            $error_message = "This email is already registered as a guider.";
        } else {
            // Insert the new guider into the GUIDE table
            $sql = "INSERT INTO GUIDE (name, phone, email) 
                    VALUES ('$name', '$phone', '$email')";

            if ($conn->query($sql) === TRUE) {
                $success_message = "Guider registered successfully.";
            } else {
                $error_message = "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Guider</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<div class="navbar">
    <a href="admin_dashboard.php">Dashboard</a>
    <a href="register_guider.php">Register Guider</a>
    <a href="admin_logout.php">Logout</a>
</div>

<div class="container">
    <h1>Register a New Guider</h1>

    <?php
    if (isset($error_message)) {
        echo "<div class='error-message'>$error_message</div>";
    }
    if (isset($success_message)) {
        echo "<div class='success-message'>$success_message</div>";
    }
    ?>

    <form method="POST" action="register_guider.php">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <button type="submit">Register Guider</button>
    </form>
</div>

<script src="js/script.js"></script>
</body>
</html>
