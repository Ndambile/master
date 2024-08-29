<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unitopia - Sign Up</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<div class="navbar">
    <a href="index.php">Home</a>
    <a href="login.php">Login</a>
    <a href="signup.php">Sign Up</a>
    <a href="services.php">Services</a>
    <a href="contact.php">Contact Us</a>
    <a href="about.php">About Us</a>
</div>

<div class="container">
    <h1>Student Sign Up</h1>
    <form action="php/register_student.php" method="POST">
        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required><br><br>
        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select><br><br>
        <label for="year_of_study">Year of Study:</label>
        <input type="number" id="year_of_study" name="year_of_study" required><br><br>
        <label for="nationality">Nationality:</label>
        <input type="text" id="nationality" name="nationality" required><br><br>
        <label for="course">Course:</label>
        <input type="text" id="course" name="course" required><br><br>
        <label for="region">Region:</label>
        <input type="text" id="region" name="region" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Sign Up</button>
    </form>
</div>

<script src="js/script.js"></script>
</body></html>