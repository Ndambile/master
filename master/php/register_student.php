<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $year_of_study = $_POST['year_of_study'];
    $nationality = $_POST['nationality'];
    $course = $_POST['course'];
    $region = $_POST['region'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO STUDENT (name, email, phone, gender, year_of_study, nationality, course, region, password)
            VALUES ('$name', '$email', '$phone', '$gender', $year_of_study, '$nationality', '$course', '$region', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful. You can now login.";
        header("Location: ../login.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
