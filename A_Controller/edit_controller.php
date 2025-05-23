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
        $target = '../uploads/';
        if (!is_dir($target)) {
            mkdir($target);
        }

        $filename = basename($_FILES['profile_pic']['name']);
        $destination = $target . $filename;

        if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $destination)) {
            $profile_pic = $filename;
        }
    }

    if(update_user_profile($user_id, $username, $bio, $profile_pic)){
        header("Location: ../A_View/main.php?page=profile");
        exit();
    }else {
        echo "Update failed: ".mysqli_error($con);
    }
}

?>
