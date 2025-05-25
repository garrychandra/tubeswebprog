<?php
    session_start();

    require_once '../A_Model/user_model.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup2-btn'])) {

        $email = $_SESSION['signup_email'];
        $pass = $_SESSION['signup_password'];
        $username = trim($_POST['username']);
        $bio = trim($_POST['bio']);
        $profilepic = 'default.png';

        if (isset($_FILES['profilepic']) && $_FILES['profilepic']['error'] === 0) {
            $target = "../uploads/";
            if (!is_dir($target)) {
                mkdir($target);
            }

            $filename = basename($_FILES['profilepic']['name']);
            $destination = $target . $filename;

            if (move_uploaded_file($_FILES['profilepic']['tmp_name'], $destination)) {
                $profilepic = $filename;
            }
        }

        if (insert_user($email, $pass, $username, $profilepic, $bio)) {
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