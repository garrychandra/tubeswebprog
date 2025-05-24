<?php
    session_start();

    require_once '../A_Model/user_model.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup1-btn'])){
        $email = trim($_POST['email']);
        $pass = trim($_POST['password']);
        $repeated_pass = trim($_POST['rpassword']);

        // validasi format email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['signup_error'] = "Email format unvalid";
            header("Location: ../A_View/main.php?page=signup1");
            exit();
        }

        // validasi email udh kedaftar
        if (get_user_by_email($email)) {
            $_SESSION['signup_error'] = "Email is already in use";
            header("Location: ../A_View/main.php?page=signup1");
            exit();
        }

        // validasi pass
        if($pass !== $repeated_pass){ 
            $_SESSION['signup_error'] = "Password doesn't match";
            header("Location: ../A_View/main.php?page=signup1");
            exit();
        }

        $_SESSION['signup_email'] = $email;
        $_SESSION['signup_password'] = $pass;

        header("Location: ../A_View/main.php?page=signup2");
        exit();
    }
?>