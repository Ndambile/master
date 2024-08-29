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
    $accommodation_id  = $_GET['delete'];
    $conn->query("DELETE FROM accommodation WHERE accommodation_id =$accommodation_id ");
    header("Location: manage_accommodations.php");
}

// Edit user
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
    $accommodation_id  = $_POST['accommodation_id '];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $city= $_POST['city'];
    $room_type = $_POST['room_type'];
    $availability_status = $_POST['availability_status'];
    $facility = $_POST['facility'];
    // $course = $_POST['course'];
    // $region = $_POST['region'];
    // $password = $_POST['password'];
    $conn->query("UPDATE accommodation SET name='$name', address='$address', city='$city',room_type='$room_type',availability_status='$availability_status',facility='$facility' WHERE accommodation_id =$accommodation_id ");
    header("Location: manage_accommodations.php");
}

// Fetch users
$results = $conn->query("SELECT * FROM accommodation");
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
    <a href="manage_accommodations.php">accommodations Data</a>
</div>

<div class="container">
    <h2>students data</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>address</th>
            <th>city</th>
            <th>room type</th>
            <th>status</th>
            <th>facility</th>
            <!-- <th>region</th>
            <th>password</th> -->
            <th>Actions</th>
        </tr>
        <?php while ($row = $results->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['city']; ?></td>
            <td><?php echo $row['room_type']; ?></td>
            <td><?php echo $row['availability_status']; ?></td>
            <td><?php echo $row['facility']; ?></td>
           </td> 
            <td>
                <a href="manage_accommodations.php?edit=<?php echo $row['accommodation_id']; ?>">Edit</a> |
                <a href="manage_accommodations.php?delete=<?php echo $row['accommodation_id']; ?>">Delete</a> |
                <a href="manage_accommodations.php?view=<?php echo $row['accommodation_id']; ?>">View</a>
            </td>
        </tr>
        <?php } ?>
    </table>

    <?php
    // Edit form
    if (isset($_GET['edit'])) {
        $accommodation_id = $_GET['edit'];
        $result = $conn->query("SELECT * FROM accommodation WHERE accommodation_id =$accommodation_id ")->fetch_assoc();
    ?>
        <h2>Edit accommodations</h2>
        <form method="post" action="manage_accommodations">
            <input type="hidden" name="accommodation_id" value="<?php echo $result['accommodation_id']; ?>">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" value="<?php echo $result['name']; ?>" required><br>
            <label for="address">address:</label><br>
            <input type="text" id="address" name="address" value="<?php echo $result['address']; ?>" required><br>
            <label for="city">city:</label><br>
            <input type="text" id="city" name="city" value="<?php echo $result['city']; ?>" required><br><br>
            <label for="room_type">room_type:</label><br>
            <input type="text" id="room_type" name="room_type" value="<?php echo $result['room_type']; ?>" required><br><br>
            <label for="availability_status">availability_status:</label><br>
            <input type="text" id="availability_status" name="availability_status" value="<?php echo $result['availability_status']; ?>" required><br><br>
            <label for="facility">facility:</label><br>
            <input type="text" id="facility" name="facility" value="<?php echo $result['facility']; ?>" required><br><br>
            <!-- <label for="phone">Phone:</label><br>
            <input type="text" id="phone" name="phone" value="" required><br><br>
             -->
            <input type="submit" name="edit" value="Update">
            
        </form>
    <?php } ?>

    <?php
    // View user
    if (isset($_GET['view'])) {
        $accommodation_id = $_GET['view'];
        $result = $conn->query("SELECT * FROM accommodation WHERE accommodation_id=$accommodation_id")->fetch_assoc();
    ?>
        <h2>View User</h2>
        <p><strong>Name:</strong> <?php echo $result['name']; ?></p>
        <p><strong>address:</strong> <?php echo $result['address']; ?></p>
        <p><strong>city:</strong> <?php echo $result['city']; ?></p>
        <p><strong>room type:</strong> <?php echo $result['room_type']; ?></p>
        <p><strong>status:</strong> <?php echo $result['availability_status']; ?></p>
        <p><strong>facility:</strong> <?php echo $result['facility']; ?></p>
       
    <?php } ?>
</div>

</body>
</html>