<?php
    require_once '../A_Model/config.php';
    require_once '../A_Model/user_model.php';

    // cek udh login blm
    if (!isset($_SESSION['user_id'])) {
        die("Unauthorized access");
    }

    // ngambil data user yg lagi login
    $user_id = $_SESSION['user_id'];
    $user = get_user_by_id($user_id);

    // cek usernya ketemu ga
    if (!$user) {
        $_SESSION['message'] = "User profile data not found";
        $_SESSION['message_type'] = "error";
        header("Location: ../A_View/main.php?page=profile");
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user_id = $_SESSION['user_id']; // ngambil id dari session
        $username = trim($_POST['username']);
        $bio = trim($_POST['bio']);
        $profilepic = null;

        // Validasi input
        if (empty($username)) {
            $_SESSION['message'] = "Username cannot be empty";
            $_SESSION['message_type'] = "error";
            header("Location: ../A_View/main.php?page=edit_profile"); // redirect ke form edit
            exit();
        }

        if (isset($_FILES['profilepic']) && $_FILES['profilepic']['error'] == 0) {
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

            // ngambil ext file, trs diubah jd lower
            $file_extension = strtolower(pathinfo($_FILES['profilepic']['name'], PATHINFO_EXTENSION));
            $file_size = $_FILES['profilepic']['size'];

            if (!in_array($file_extension, $allowed_extensions)) {
                $_SESSION['message'] = "File type not allowed. JPG, JPEG, PNG, GIF only.";
                $_SESSION['message_type'] = "error";
                header("Location: ../A_View/main.php?page=edit_profile");
                exit();
            }

            // nentuin directory, kl gaada baru bikin dirnya
            $target = '../uploads/';
            if (!is_dir($target)) {
                mkdir($target);
            }

            // ngambil nama file asli, trs bikin path lgkpnya di server
            $filename = basename($_FILES['profilepic']['name']);
            $destination = $target . $filename;

            // mindahin file dari temp ke $dest
            if (move_uploaded_file($_FILES['profilepic']['tmp_name'], $destination)) {
                $profilepic = $filename;
            } else {
                $_SESSION['message'] = "Failed to upload profile pic";
                $_SESSION['message_type'] = "error";
                header("Location: ../A_View/main.php?page=edit_profile");
                exit();
            }
        }

        // manggil function di user_model.php -> update usn, bio, foto
        if(update_user_profile($user_id, $username, $bio, $profilepic)){
            $_SESSION['message'] = "Profile updated successfully!";
            $_SESSION['message_type'] = "success";
            header("Location: ../A_View/main.php?page=profile");
            exit();
        }else {
            $_SESSION['message'] = "Failed to update profile";
            $_SESSION['message_type'] = "error";
            header("Location: ../A_View/main.php?page=edit_profile");
            exit();
        }
    }
?>
