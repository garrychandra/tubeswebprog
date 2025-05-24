<?php
require_once '../A_Model/user_model.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $username = trim($_POST['username']);
    $bio = trim($_POST['bio']);
    $profile_pic = null;

    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $max_file_size = 2 * 1024 * 1024; // 2MB

        $file_extension = strtolower(pathinfo($_FILES['profile_pic']['name'], PATHINFO_EXTENSION));
        $file_size = $_FILES['profile_pic']['size'];

        if (!in_array($file_extension, $allowed_extensions)) {
            $_SESSION['message'] = "File type not allowed. JPG, JPEG, PNG, GIF only.";
            $_SESSION['message_type'] = "error";
            header("Location: ../A_View/main.php?page=profile");
            exit();
        }

        if ($file_size > $max_file_size) {
            $_SESSION['message'] = "File size is too big. Max 2MB.";
            $_SESSION['message_type'] = "error";
            header("Location: ../A_View/main.php?page=profile");
            exit();
        }

        $target = '../uploads/';
        if (!is_dir($target)) {
            mkdir($target);
        }

        $filename = basename($_FILES['profile_pic']['name']);
        $destination = $target . $filename;

        if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $destination)) {
            $profile_pic = $filename;
        } else {
            $_SESSION['message'] = "Failed to upload profile pic";
            $_SESSION['message_type'] = "error";
            header("Location: ../A_View/main.php?page=profile");
            exit();
        }
    }

    if(update_user_profile($user_id, $username, $bio, $profile_pic)){
        $_SESSION['message'] = "Profile updated successfully!";
        $_SESSION['message_type'] = "success";
        header("Location: ../A_View/main.php?page=profile");
        exit();
    }else {
        $_SESSION['message'] = "Failed to update profile";
        $_SESSION['message_type'] = "error";
        header("Location: ../A_View/main.php?page=profile");
        exit();
    }
}

?>
