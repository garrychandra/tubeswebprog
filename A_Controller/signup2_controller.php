<?php
require_once '../A_Model/user_model.php';
session_start();

?>

<?php

var_dump($_SESSION);
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup2-btn'])) {

    $email = $_SESSION['signup_email'];
    $pass = $_SESSION['signup_password'];
    $username = trim($_POST['username']);
    $bio = trim($_POST['bio']);
    $profile_pic = $_FILES['profile_pic'] ?? null;

    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === 0) {
        $target = "../images/upload/";
        if (!is_dir($target)) {
            mkdir($target);
        }

        $filename = basename($_FILES['profile_pic']['name']);
        $destination = $target . $filename;

        if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $destination)) {
            $profile_pic = $filename; // Store only the filename
        }
    }

    if (insert_user($email, $pass, $username, $profile_pic, "member", $bio)) {
        unset($_SESSION['signup_email'], $_SESSION['signup_password']);
        $user = get_user_by_email($email);

        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['is_admin'] = $user['is_admin'];
        }

        header("Location: ../A_View/main.php?page=profile");
        exit();
    } else {
        echo "error: " . mysqli_error($con);
    }
}
?>