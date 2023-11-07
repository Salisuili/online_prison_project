<?php
session_start();
require_once('req/database.php');

if(isset($_SESSION['username']) && isset($_SESSION['usertype'])) {
    if($_SESSION['usertype'] == 1) {
        header("Location: home.php");
        exit();
    } else {
        header("Location: user.php");
        exit();
    }
}

if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password'";
    $result = $conn->query($sql);
    //print_r($result);
    //exit();
    if($result->num_rows > 0) {
      $row = $result -> fetch_assoc();
        $_SESSION['username'] = $username;
        $_SESSION['usertype'] = $row['type'];
        $_SESSION['userEmail'] = $row['email'];
        
        if($_SESSION['usertype'] == 1) {
            header("Location: home.php");
            exit();
        } else {
            header("Location: user.php");
            exit();
        }

    } else {
        header("Location: login.php");
        $_SESSION['message'] = "Invalid Username or Password";
    }

    $conn->close();
}
?>

