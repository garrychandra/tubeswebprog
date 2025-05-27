<?php 
    require_once '../A_Model/config.php';
    require_once '../A_Model/user_model.php';

    // cek ada yg login ga (true false)
    $logged_in = isset($_SESSION['user_id']);

    // cek usernya lg liat profile diri sendiri ato user lain
    if(isset($_GET['id'])) {
        $profile_id = (int)$_GET['id']; // liat yg user lain 
    }elseif ($logged_in){
        $profile_id = (int)$_SESSION['user_id']; // liat yg diri sendiri
    }else {
        header("Location: ../A_View/main.php?page=login");
        exit();
    }

    // manggil function dr user_model.php buat ngambil semua data proifle
    $user = get_user_by_id($profile_id);
    if(!$user){
        header("Location: ../A_View/main.php?page=404_not_found");
        exit();
    }

    // cek profile yg lg diliat punya sendiri bukan (buat view button edit profile / delete account)
    $is_own_profile = $logged_in && $_SESSION['user_id'] == $profile_id; 

    // manggil function dr user_model.php buat dapet jumlah foll dari profile yg lg diliat
    $followers = get_followers_count($profile_id);
    $following = get_following_count($profile_id);

    $is_following = false;
    // manggil function dr user_model.php buat cek usernya follow user yg lg diliat ga. btw logicnya berlaku kalo user lg ga liat profile diri sendiri
    if ($logged_in && !$is_own_profile) {
        $is_following = is_following($_SESSION['user_id'], $profile_id); // ← typo fixed
    }
?>