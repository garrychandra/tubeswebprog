<?php 
    session_start();

    require_once '../A_Model/user_model.php';

    echo "<pre> SESSION";
    echo print_r($_SESSION);
    echo "</pre>";
    echo "<pre> GET";
    echo print_r($_GET);
    echo "</pre>";

    if(!isset($_GET['user_id']) || !isset($_GET['type'])){
        die('Missing parameters.');
    }

    $target_id = (int)$_GET['user_id'];
    $type = ($_GET['type'] === 'following') ? 'following' : 'followers';
    $search = $_GET['search'] ?? '';

    $sql = "SELECT username FROM users WHERE id = $target_id";
    $user_q = mysqli_query($con, $sql);

    if(mysqli_num_rows($user_q) !== 1) die("User not found.");
    $user_data = mysqli_fetch_assoc($user_q);

    $result = ($type === 'followers') ? get_followers($target_id, $search) : get_following($target_id, $search);

    $logged_in_user = $_SESSION['user_id'] ?? null;

    include '../A_View/followers_view.php';

?>