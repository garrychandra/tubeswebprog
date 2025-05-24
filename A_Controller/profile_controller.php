<?php 

    require_once '../A_Model/user_model.php';

    $logged_in = isset($_SESSION['user_id']);

    // Check whether user visit his own or other profile page
    if(isset($_GET['user_id'])) {
        $profile_id = (int)$_GET['user_id']; // user see other 
    }elseif ($logged_in){
        $profile_id = (int)$_SESSION['user_id']; // user see his own
    }else {
        die("You must be logged in");
    }

    $user = get_user_by_id($profile_id);
    if(!$user){
        die('User not found.');
    }

    $is_own_profile = $logged_in && $_SESSION['user_id'] == $profile_id; 
    $followers = get_followers_count($profile_id);
    $following = get_following_count($profile_id);

    $is_following = false;
    if ($logged_in && !$is_own_profile) {
        $is_following = is_following($_SESSION['user_id'], $profile_id); // ← typo fixed
    }
?>