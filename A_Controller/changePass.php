<?php
session_start();

require '../A_Model/user_model.php';

$errors = [];
$success = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change-btn'])) {
    $curr = trim($_POST['curr_password'] ?? '');
    $new = trim($_POST['new_password'] ?? '');
    $user_id = $_SESSION['user_id'] ?? null;

    if (!$user_id) {
        $errors[] = "User not logged in.";
    } 

    if(isset($_COOKIE['last_password_change'])){
        $errors[] = "You must wait 30 days before changing your password again.";
    }

    if (empty($curr) || empty($new)) {
        $errors[] = "All fields are required";
    } else if (strlen($new) < 6) {
        $errors[] = "New password must be at least 6 characters.";
    }

    if (empty($errors)) {

        $query = "SELECT password FROM user WHERE id = $user_id LIMIT 1";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            $hashed_pass = $row['password'];

            if (!password_verify($curr, $hashed_pass)) {
                $errors[] = "Current password is incorrect";
            } elseif (password_verify($new, $hashed_pass)) {
                $errors[] = "New password must be different.";
            } else {
                $new_hashed = password_hash($new, PASSWORD_DEFAULT);
                $update = "UPDATE user SET password = '$new_hashed' WHERE id = $user_id";
                if (mysqli_query($con, $update)) {
                    setcookie('last_password_change', time(), time() + 2592000, "/");
                    $success = "Password changed successfully.";
                } else {
                    $errors[] = "Error updating password.";
                }
            }
        } else {
            $errors[] = "User not found.";
        }
    }

    $_SESSION['errors'] = $errors;
    $_SESSION['success'] = $success;
    header("Location: ../A_View/main.php?page=settings");
    exit;
} else {
    header("Location: ../A_View/main.php?page=settings");
    exit;
}
