<?php
session_start();
require_once '../A_Model/user_model.php';

$errors = [];
$old = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['log-btn'])) {
    
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $old['email'] = $email;

    // Validate inputs
    if (empty($email)) {
        $errors['email'] = "Email cannot be empty";
    }

    if (empty($password)) {
        $errors['password'] = "Password cannot be empty";
    } elseif (strlen($password) < 6) {
        $errors['password'] = "Password must be at least 6 characters";
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $old;
        header("Location: ../A_View/main.php?page=login");
        exit;
    }

    // Try to get user
    $user = get_user_by_email($email);

    if ($user && password_verify($password, $user['password'])) {

        if($user['role'] === 'banned') {
            $errors['login'] = "Your account is banned";
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = $old;
            header("Location: ../A_View/main.php?page=login");
            exit;
        } 
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['is_admin'] = $user['role'];

        if (isset($_POST['remember'])) {
            $token = bin2hex(random_bytes(32));
            update_user_remember_token($user['id'], $token);
            setcookie('remember_token', $token, time() + 3600, "/");
        }

        header("Location: ../A_View/main.php?page=profile");
        exit;
    } else {
        $errors['login'] = "Invalid credentials";
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $old;
        header("Location: ../A_View/main.php?page=login");
        exit;
    }
}
?>
