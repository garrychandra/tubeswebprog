<?php
session_start();
require_once '../A_Model/user_model.php';

$errors = [];
$old = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['log-btn'])) {

    $email = trim($_POST['email']); // can be email or username
    $password = trim($_POST['password']);

    $user = get_user_by_email_password($email, $password);

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['is_admin'] = $user['role'];

        if (empty($email)) {
            $errors['email'] = "Email cannot be empty";
        } elseif (!get_user_by_email($email)) {
            $errors['email'] = "Email is not registered";
        }

        if (empty($password)) {
            $errors['password'] = "Password cannot be empty";
        } elseif (strlen($password) < 6) {
            $errors['password'] = "Password must contain at least 6 characters";
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = $old;
            header("Location: ../A_View/main.php?page=login");
            exit;
        } else {
            // Get user by email only
            $user = get_user_by_email($email);

            if ($user && password_verify($password, $user['password'])) {
                // Password verified
                $_SESSION['user_id'] = $user['id'];

                if ($user['role'] === 'admin') {
                    $_SESSION['is_admin'] = true;
                }

                if (isset($_POST['remember'])) {
                    $token = bin2hex(random_bytes(32)); // create remember token
                    update_user_remember_token($user['id'], $token); // You must implement this function
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
    }
}
?>