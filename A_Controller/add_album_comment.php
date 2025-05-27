<?php
include_once '../A_Model/config.php';
session_start();

if (isset($_SESSION['user_id'], $_POST['forum_id'], $_POST['content'])) {
    $user_id = intval($_SESSION['user_id']);
    $forum_id = intval($_POST['forum_id']);
    $content = mysqli_real_escape_string($con, $_POST['content']);

    // Optional: get modal_id for redirect
    $modal_id = isset($_POST['modal_id']) ? $_POST['modal_id'] : '';

    $sql = "INSERT INTO forum_posting (user_id, forum_id, content) VALUES ($user_id, $forum_id, '$content')";
    mysqli_query($con, $sql);

    // Redirect back to the modal if modal_id is set
    $redirect = '../A_View/main.php?page=discography';
    if ($modal_id) {
        $redirect .= '#' . urlencode($modal_id);
    }
    header('Location: ' . $redirect);
    exit;
}

// Fallback redirect
header('Location: ../A_View/main.php?page=discography');
exit;
?>