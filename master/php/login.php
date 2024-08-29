<?php
include 'db_connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = $_POST['role'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    

    if ($role == 'student') {
        $sql = "SELECT * FROM STUDENT WHERE phone='$phone'";
    } elseif ($role == 'guider') {
        $sql = "SELECT * FROM GUIDE WHERE phone='$phone'";
    } elseif ($role == 'admin') {
        $sql = "SELECT * FROM `ADMIN` WHERE phone='$phone'";
        //echo $role.$password;die;
    }

    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if($role=='admin'){
            if($password==$row['password']){
                header("Location:../adimin/ad.php");
            }else{
                echo 'Invalid password';
            }   
        }
        elseif (password_verify($password, $row['password'])) {
            $_SESSION['user'] = $row;
            if ($role == 'student') {
                header("Location: ../student_dashboard.php");
            } elseif ($role == 'guider') {
                header("Location: ../guider_dashboard.php");
            } 
        } else{
            echo "Invalid password.";
        }
    } else {
        echo "No user found with this phone/email.";
    }

    $conn->close();
}
?>

