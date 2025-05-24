<?php 

require_once '../A_Model/user_model.php';
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['log-btn'])){

    $email = trim($_POST['email']); // can be email or username
    $password = trim($_POST['password']);

    $user = get_user_by_email_password($email, $password);
    
    if($user){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['is_admin'] = $user['role'];
    
        header("Location: ../A_View/main.php?page=profile");
        exit();
    }else {
        echo "Invalid credentials";
    }
}
?>