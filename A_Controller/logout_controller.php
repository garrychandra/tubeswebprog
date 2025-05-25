<?php
    require_once '../A_Model/config.php';
    require_once '../A_Model/user_model.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_logout'])) {
        if (isset($_SESSION['user_id'])) {
            clear_user_remember_token($_SESSION['user_id']);
        }
        session_unset();
        session_destroy();

        setcookie('remember_token', '', time() - 3600, "/");
        
        header("Location: ../A_View/main.php?page=login&logout=1");
        exit;
    } else {
        // If accessed directly without confirmation, redirect to profile
        header("Location: ../A_View/main.php?page=profile");
        exit;
    }
?>
