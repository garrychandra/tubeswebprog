<?php 
    session_start();

    require_once '../A_Model/user_model.php';
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['log-btn'])){

        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        $user = get_user_by_email_password($email, $password);
        
        if($user){
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['is_admin'] = $user['is_admin'];

            if (isset($_POST['remember'])) {
                $token = bin2hex(random_bytes(32)); // bikin tokennya
                update_user_remember_token($user['id'], $token); // Fungsi ini perlu kamu buat di user_model.php
                setcookie('remember_token', $token, time() + 3600, "/");
            }
            header("Location: ../A_View/main.php?page=profile");
            exit();
        } else {
            echo "Invalid credentials";
        }
    }


?>