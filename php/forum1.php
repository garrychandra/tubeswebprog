<?php
    // connection
    $con = mysqli_connect("localhost", "root", "", "wte");

    // check con
    if (!$con) {
        die("Connection failed : " . mysqli_connect_error());
    }

    session_start();

    $email = $_POST['email'];
    $password = $_POST['password'];
    $result = mysqli_query($con, "SELECT id, password, email FROM user WHERE email = '$email' AND password = '$password'");

    if (mysqli_num_rows($result) == 0) {
        echo "<script> alert('Login error'); </script>";
        $warning = "Email ";

    } else {
        $_SESSION['id'] = mysqli_fetch_array($result)['id'];
        $_SESSION['role'] = mysqli_fetch_array($result)['role'];
    }

    header("Location: ../html/profile.php");
 
?>