<?php
session_start(); // Add this - session wasn't started
include_once '../A_Model/config.php';

if (isset($_SESSION['user_id'], $_POST['forum_id'], $_POST['content'])) {
    $user_id = intval($_SESSION['user_id']);
    $forum_id = intval($_POST['forum_id']);
    $content = mysqli_real_escape_string($con, $_POST['content']);

    $sql = "INSERT INTO forum_posting (user_id, forum_id, content) VALUES ($user_id, $forum_id, '$content')";
    if(mysqli_query($con, $sql)) {
        $sql = "SELECT username FROM user WHERE id = $user_id"; 
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        
        echo "<div class='comment'><b>" . htmlspecialchars($row['username']) . ":</b> " . htmlspecialchars($content) . "</div>";
    } else {
        echo "Error posting comment";
    }
    mysqli_close($con);
    exit;
}
echo "Invalid request";
?>