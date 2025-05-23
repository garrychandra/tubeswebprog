<?php
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup1-btn'])){
    $email = trim($_POST['email']);
    $pass = trim($_POST['password']);
    $repeated_pass = trim($_POST['rpassword']);

    if($pass != $repeated_pass){
        die("Password does not match");
    }

    $_SESSION['signup_email'] = $email;
    $_SESSION['signup_password'] = $pass;

    header("Location: ../A_View/main.php?page=signup2");
    exit();
}
?>