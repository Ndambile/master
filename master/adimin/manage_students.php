<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "unitopia";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete user
if (isset($_GET['delete'])) {
    $admission_number = $_GET['delete'];
    $conn->query("DELETE FROM student WHERE admission_number=$admission_number");
    header("Location: manage_students.php");
}

// Edit user
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
    $admission_number = $_POST['admission_number'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone= $_POST['phone'];
    $gender = $_POST['gender'];
    $year_of_study = $_POST['year_of_study'];
    $nationality = $_POST['nationality'];
    $course = $_POST['course'];
    $region = $_POST['region'];
    $password = $_POST['password'];
    $conn->query("UPDATE student SET name='$name', email='$email', phone='$phone',gender='$gender',year_of_study='$year_of_study',nationality='$nationality',course='$course' region='$region',password='$password' WHERE admission_number=$admission_number");
    header("Location: manage_students.php");
}

// Fetch users
$results = $conn->query("SELECT * FROM student");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Display Data</title>
    <style>
        /* CSS for styling */
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        .navbar {
            overflow: hidden;
            background-color: #333;
        }
        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="navbar">
    <a href="ad.php">dashboard</a>
    <a href="manage_students.php">Display Data</a>
</div>

<div class="container">
    <h2>students data</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>email</th>
            <th>Phone</th>
            <th>gender</th>
            <th>year_of_study</th>
            <th>nationality</th>
            <th>Course</th>
            <th>region</th>
            <th>password</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $results->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['gender']; ?></td>
            <td><?php echo $row['year_of_study']; ?></td>
            <td><?php echo $row['nationality']; ?></td>
            <td><?php echo $row['course']; ?></td>
            <td><?php echo $row['region']; ?></td>
            <td><?php echo $row['password']; ?></td>
            <td>
                <a href="manage_students.php?edit=<?php echo $row['admission_number']; ?>">Edit</a> |
                <a href="manage_students.php?delete=<?php echo $row['admission_number']; ?>">Delete</a> |
                <a href="manage_students.php?view=<?php echo $row['admission_number']; ?>">View</a>
            </td>
        </tr>
        <?php } ?>
    </table>

    <?php
    // Edit form
    if (isset($_GET['edit'])) {
        $admission_number = $_GET['edit'];
        $result = $conn->query("SELECT * FROM student WHERE admission_number='$admission_number'")->fetch_assoc();
    ?>
        <h2>Edit student</h2>
        <form method="post" action="manage_students">
            <input type="hidden" name="admission_number" value="<?php echo $result['admission_number']; ?>">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" value="<?php echo $result['name']; ?>" required><br>
            <label for="email">email:</label><br>
            <input type="email" id="email" name="email" value="<?php echo $result['email']; ?>" required><br>
            <label for="phone">Phone:</label><br>
            <input type="number" id="phone" name="phone" value="<?php echo $result['phone']; ?>" required><br><br>
            <label for="gender">gender:</label><br>
            <input type="text" id="gender" name="gender" value="<?php echo $result['gender']; ?>" required><br><br>
            <label for="year_of_study">year of study:</label><br>
            <input type="number" id="year_of_study" name="year_of_study" value="<?php echo $result['year_of_study']; ?>" required><br><br>
            <label for="nationality">nationality:</label><br>
            <input type="text" id="nationality" name="nationality" value="<?php echo $result['nationality']; ?>" required><br><br>
            <label for="course">course:</label><br>
            <input type="text" id="course" name="course" value="<?php echo $result['course']; ?>" required><br><br>
            <label for="region">region:</label><br>
            <input type="text" id="region" name="region" value="<?php echo $result['region']; ?>" required><br><br>
            <label for="password">password:</label><br>
            <input type="password" id="password" name="password" value="<?php echo $result['password']; ?>" required><br><br>
            <!-- <label for="phone">Phone:</label><br>
            <input type="text" id="phone" name="phone" value="" required><br><br>
             -->
            <input type="submit" name="edit" value="Update">
            
        </form>
    <?php } ?>

    <?php
    // View user
    if (isset($_GET['view'])) {
        $admission_number = $_GET['view'];
        $result = $conn->query("SELECT * FROM student WHERE admission_number=$admission_number")->fetch_assoc();
    ?>
        <h2>View User</h2>
        <p><strong>Name:</strong> <?php echo $result['name']; ?></p>
        <p><strong>email:</strong> <?php echo $result['email']; ?></p>
        <p><strong>Phone:</strong> <?php echo $result['phone']; ?></p>
        <p><strong>gender:</strong> <?php echo $result['gender']; ?></p>
        <p><strong>year_of_study:</strong> <?php echo $result['year_of_study']; ?></p>
        <p><strong>nationality:</strong> <?php echo $result['nationality']; ?></p>
        <p><strong>course:</strong> <?php echo $result['course']; ?></p>
        <p><strong>region:</strong> <?php echo $result['region']; ?></p>
        <p><strong>password:</strong> <?php echo $result['password']; ?></p>
    <?php } ?>
</div>

</body>
</html>