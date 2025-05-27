<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "wte";
    $port = "3307";

    $con = mysqli_connect($servername,$username,$password,$dbname, $port);
    if(!$con){
        echo "Connection failed: " . mysqli_connect_error();
    }

    // auto login (remember me)
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // cek : user blm login tp ada cookie remember_token
    if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_token'])) {
        require_once dirname(__DIR__) . '/A_Model/user_model.php'; 

        $token = $_COOKIE['remember_token'];
        $user = get_user_by_remember_token($token); // manggil function dr user_model.php

        if ($user) {
            // token blm kedaluwarsa, login user otomatis
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['is_admin'] = $user['is_admin'];
        } else { // token kedaluwarsa  -> hapus cookie
            setcookie('remember_token', '', time() - 3600, "/"); // waktu lalu buat ngehapus
        }
    }
?>