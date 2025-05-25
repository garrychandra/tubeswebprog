<?php
require_once '../A_Model/config.php';
require_once '../A_Model/user_model.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../A_View/main.php?page=login");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $follower_id = (int)$_SESSION['user_id'];
    $followed_id = (int)$_POST['followed_id'];

    if ($follower_id === $followed_id) {
        $_SESSION['message'] = "You cannot follow or unfollow yourself";
        $_SESSION['message_type'] = "error";
        header("Location: ../A_View/main.php?page=profile&user_id=" . $followed_id);
        exit();
    }

    $action = $_POST['action'] ?? '';

    if ($action === 'follow') {
        if (add_follow($follower_id, $followed_id)) {
            $_SESSION['message'] = "Successfully followed user!";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "Failed to follow user.";
            $_SESSION['message_type'] = "error";
        }
    } elseif ($action === 'unfollow') {
        if (remove_follow($follower_id, $followed_id)) {
            $_SESSION['message'] = "Successfully unfollowed user!";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "Failed to unfollow user.";
            $_SESSION['message_type'] = "error";
        }
    } else {
        $_SESSION['message'] = "Invalid action.";
        $_SESSION['message_type'] = "error";
    }

    header("Location: ../A_View/main.php?page=profile&user_id=" . $followed_id);
    exit();

} else {
    header("Location: ../A_View/main.php?page=profile");
    exit();
}