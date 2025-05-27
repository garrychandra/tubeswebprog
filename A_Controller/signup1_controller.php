<?php
session_start();
require_once '../A_Model/user_model.php';

$errors = [];
$old = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup1-btn'])) {
    $email = trim($_POST['email']);
    $pass = trim($_POST['password']);
    $repeated_pass = trim($_POST['rpassword']);

    $old['email'] = $email;

    // Email validations
    if (empty($email)) {
        $errors['email'] = "Email cannot be empty";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    } elseif (get_user_by_email($email)) {
        $errors['email'] = "Email is already used";
    }

    // Password validations
    if (empty($pass)) {
        $errors['pass'] = "Password cannot be empty";
    } elseif (strlen($pass) < 6) {
        $errors['pass'] = "Password must be at least 6 characters";
    }

    if ($pass !== $repeated_pass) {
        $errors['rpassword'] = "Passwords do not match";
    }

    if (!empty($errors)) {
        // Save error & old data
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $old;
        header("Location: ../A_View/main.php?page=signup1");
        exit;
    } else {
        $_SESSION['signup_email'] = $email;
        $_SESSION['signup_password'] = password_hash($pass, PASSWORD_DEFAULT); // secure
        header("Location: ../A_View/main.php?page=signup2");
        exit();
    }
}
