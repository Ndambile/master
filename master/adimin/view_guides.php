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
    $guide_id = $_GET['delete'];
    $conn->query("DELETE FROM guide WHERE guide_id=$guide_id");
    header("Location: view_guides.php");
}

// Edit user
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
    $guide_id = $_POST['guide_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone= $_POST['phone'];
    // $gender = $_POST['gender'];
    // $year_of_study = $_POST['year_of_study'];
    // $nationality = $_POST['nationality'];
    // $course = $_POST['course'];
    // $region = $_POST['region'];
    $password = $_POST['password'];
    $conn->query("UPDATE guide SET name='$name', email='$email', phone='$phone',password='$password' WHERE guide_id=$guide_id");
    header("Location: view_guides.php");
}

// Fetch users
$results = $conn->query("SELECT * FROM guide");
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
    <a href="view_guides.php">Display Data</a>
</div>

<div class="container">
    <h2>students data</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>email</th>
            <th>Phone</th>
            <!-- <th>gender</th>
            <th>year_of_study</th>
            <th>nationality</th>
            <th>Course</th>
            <th>region</th> -->
            <th>password</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $results->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['password']; ?></td>
            <td>
                <a href="view_guides.php?edit=<?php echo $row['guide_id']; ?>">Edit</a> |
                <a href="view_guides.php?delete=<?php echo $row['guide_id']; ?>">Delete</a> |
                <a href="view_guides.php?view=<?php echo $row['guide_id']; ?>">View</a>
            </td>
        </tr>
        <?php } ?>
    </table>

    <?php
    // Edit form
    if (isset($_GET['edit'])) {
        $guide_id = $_GET['edit'];
        $result = $conn->query("SELECT * FROM guide WHERE guide_id='$guide_id'")->fetch_assoc();
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
        $guide_id = $_GET['view'];
        $result = $conn->query("SELECT * FROM guide WHERE guide_id=$guide_id")->fetch_assoc();
    ?>
        <h2>View User</h2>
        <p><strong>Name:</strong> <?php echo $result['name']; ?></p>
        <p><strong>email:</strong> <?php echo $result['email']; ?></p>
        <p><strong>Phone:</strong> <?php echo $result['phone']; ?></p>
        <p><strong>password:</strong> <?php echo $result['password']; ?></p>
    <?php } ?>
</div>

</body>
</html>