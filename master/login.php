<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unitopia - Login</title>
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
    <h1>Login</h1>
    <form action="php/login.php" method="POST">
        <label for="role">Login as:</label>
        <select name="role" id="role">
            <option value="student">Student</option>
            <option value="guider">Guider</option>
            <option value="admin">Admin</option>
        </select><br><br>
        <label for="phone">Phone or Email:</label>
        <input type="text" id="phone" name="phone" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Login</button>
    </form>
</div>

<script src="js/script.js"></script>
</body>
</html>
