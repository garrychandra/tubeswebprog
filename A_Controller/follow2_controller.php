<?php

$my_id = (int)$_SESSION['user_id'];
$followed_id = isset($_POST['followed_id']) ? (int)$_POST['followed_id'] : 0;
$action = isset($_POST['action']) ? $_POST['action'] : '';

if ($followed_id <= 0 || ($action !== 'follow' && $action !== 'unfollow')) {
    // Invalid request
    header('Location: ../main.php');  // or show error
    exit;
}

if ($action === 'follow') {
    // Insert a follow relationship if not exists
    $sql_check = "SELECT 1 FROM follow WHERE user_id = $my_id AND id_follow = $followed_id LIMIT 1";
    $res_check = mysqli_query($conn, $sql_check);

    if (mysqli_num_rows($res_check) === 0) {
        $sql = "INSERT INTO follow (user_id, id_follow) VALUES ($my_id, $followed_id)";
        mysqli_query($conn, $sql);
    }
} else if ($action === 'unfollow') {
    // Delete the follow relationship
    $sql = "DELETE FROM follow WHERE user_id = $my_id AND id_follow = $followed_id";
    mysqli_query($conn, $sql);
}

// Redirect back to profile or wherever you want
header('Location: ../main.php?page=profile&user_id=' . $followed_id);
exit;
