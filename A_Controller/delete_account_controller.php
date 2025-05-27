<?php
    session_start();
    require_once '../A_Model/user_model.php';
    require_once '../A_Model/config.php';

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo "Invalid request method.";
        exit();
    }

    if (!isset($_SESSION['user_id'])) {
        echo "Not logged in.";
        exit();
    }

    // ngambil user_id dari data POST yg dikirim JS
    $user_id_from_post = $_POST['user_id'] ?? null;

    // convert ke integer untuk keamanan
    $user_id_from_post = (int)$user_id_from_post;
    $logged_in_user_id = $_SESSION['user_id'];

    // validasi : user_id yang dikirim == user_id yang login
    // mencegah user menghapus akun orang lain secara tidak sengaja/sengaja
    if ($user_id_from_post !== $logged_in_user_id) {
        echo "Unauthorized access: Mismatched user ID.";
        exit();
    }

    // manggil function di user_model.php
    $delete_success = delete_user($logged_in_user_id);

    if ($delete_success) {
        session_destroy();
        echo "success";
    } else {
        echo "failed";
    }
    exit();
?>