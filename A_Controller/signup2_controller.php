<?php
session_start();

require_once '../A_Model/user_model.php';

$errors = [];
$old = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup2-btn'])) {

    $email = $_SESSION['signup_email'];
    $pass = $_SESSION['signup_password'];
    $username = trim($_POST['username']);
    $bio = trim($_POST['bio']);
    $profilepic = 'default.png';

    if (empty($username)) {
        $errors['username'] = "Username cannot be empty";
    }

    if (strlen($bio) > 255) {
        $errors['bio'] = "Bio cannot exceed 255 characters";
    }

    if (isset($_FILES['profilepic']) && $_FILES['profilepic']['error'] === 0) {
        $target = "../uploads/";
        if (!is_dir($target)) {
            mkdir($target);
        }

        $ext = pathinfo($_FILES['profilepic']['name'], PATHINFO_EXTENSION);
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array(strtolower($ext), $allowed_types)) {
            $errors['profilepic'] = "Invalid file type";
        }

        if (empty($errors)) {
            $filename = uniqid('profile_', true) . '.' . $ext;
            $destination = $target . $filename;
            if (move_uploaded_file($_FILES['profilepic']['tmp_name'], $destination)) {
                $profilepic = $filename;
            }
        }
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = ['username' => $username, 'bio' => $bio];
        header("Location: ../A_View/main.php?page=signup2");
        exit();
    }

    if (insert_user($email, $pass, $username, $profilepic, $bio)) {
        unset($_SESSION['signup_email'], $_SESSION['signup_password']);
        $user = get_user_by_email($email);

        if ($user) {
            $_SESSION['user_id'] = $user['id'];
        }

        header("Location: ../A_View/main.php?page=profile");
        exit();
    } else {
        $errors['error'] = "Error during signup.";
    }
}
