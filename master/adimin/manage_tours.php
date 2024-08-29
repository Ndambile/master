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

// Delete tour
if (isset($_GET['delete'])) {
    $tour_id  = $_GET['delete'];
    $conn->query("DELETE FROM tour WHERE tour_id =$tour_id ");
    header("Location: manage_tours.php");
}

// Edit tour
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
    $tour_id  = $_POST['tour_id '];
    $university_id  = $_POST['university_id '];
    $guide_id  = $_POST['guide_id '];
    $tour_date= $_POST['tour_date'];
    $duration = $_POST['duration'];
    $description = $_POST['description'];
    // $nationality = $_POST['nationality'];
    // $course = $_POST['course'];
    // $region = $_POST['region'];
    // $password = $_POST['password'];
    $conn->query("UPDATE tour SET university_id ='$university_id ', guide_id='$guide_id', tour_date='$tour_date',duration='$duration',description='$description' WHERE tour_id=$tour_id");
    header("Location: manage_tours.php");
}

// Fetch tour
$results = $conn->query("SELECT * FROM tour");
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
    <a href="manage_tours.php">Tours Data</a>
</div>

<div class="container">
    <h2>Tours data</h2>
    <table>
        <tr>
            <th>university</th>
            <th>guide</th>
            <th>tour_date</th>
            <th>duration</th>
            <th>description</th>
            <!-- <th>nationality</th>
            <th>Course</th>
            <th>region</th>
            <th>password</th> -->
            <th>Actions</th>
        </tr>
        <?php while ($row = $results->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['university_id']; ?></td>
            <td><?php echo $row['guide_id']; ?></td>
            <td><?php echo $row['tour_date']; ?></td>
            <td><?php echo $row['duration']; ?></td>
            <td><?php echo $row['description']; ?></td>
           </td>
            <td>
                <a href="manage_tours.php?edit=<?php echo $row['tour_id']; ?>">Edit</a> |
                <a href="manage_tours.php?delete=<?php echo $row['tour_id']; ?>">Delete</a> |
                <a href="manage_tours.php?view=<?php echo $row['tour_id']; ?>">View</a>
            </td>
        </tr>
        <?php } ?>
    </table>

    <?php
    // Edit form
    if (isset($_GET['edit'])) {
        $tour_id = $_GET['edit'];
        $result = $conn->query("SELECT * FROM tour WHERE tour_id='$tour_id'")->fetch_assoc();
    ?>
        <h2>Edit tours</h2>
        <form method="post" action="manage_tours">
            <input type="hidden" name="tour_id" value="<?php echo $result['tour_id']; ?>">
            <label for="university_id ">university:</label><br>
            <input type="number" id="university_id" name="university_id" value="<?php echo $result['university_id']; ?>" required><br>
            <label for="guide_id ">guide:</label><br>
            <input type="number" id="guide_id " name="guide_id " value="<?php echo $result['guide_id']; ?>" required><br>
            <label for="tour_date">tour_date:</label><br>
            <input type="date" id="tour_date" name="tour_date" value="<?php echo $result['tour_date']; ?>" required><br><br>
            <label for="duration">duration:</label><br>
            <input type="text" id="duration" name="duration" value="<?php echo $result['duration']; ?>" required><br><br>
            <label for="description">description:</label><br>
            <input type="text" id="description" name="description" value="<?php echo $result['description']; ?>" required><br><br>
            <!-- <label for="phone">Phone:</label><br>
            <input type="text" id="phone" name="phone" value="" required><br><br>
             -->
            <input type="submit" name="edit" value="Update">
            
        </form>
    <?php } ?>

    <?php
    // View tour
    if (isset($_GET['view'])) {
        $tour_id  = $_GET['view'];
        $result = $conn->query("SELECT * FROM tour WHERE tour_id =$tour_id ")->fetch_assoc();
    ?>
        <h2>View tour</h2>
        
        <p><strong>university:</strong> <?php echo $result['university_id']; ?></p>
        <p><strong>guide:</strong> <?php echo $result['guide_id']; ?></p>
        <p><strong>tour date:</strong> <?php echo $result['tour_date']; ?></p>
        <p><strong>duration:</strong> <?php echo $result['duration']; ?></p>
        <p><strong>description:</strong> <?php echo $result['description']; ?></p>
       
    <?php } ?>
</div>

</body>
</html>