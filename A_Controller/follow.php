<?php
    include_once "../A_Model/config.php";  
    // session_start();

    $id_follow = $_POST['id_follow'];
    $follow = $_POST['follow'];

    $uid = $_SESSION['user_id']; // ambil id user yg lg login

    $sql;

    if($follow == '1'){ // 1 tuh mau follow
        $sql = "INSERT INTO follow VALUES ('$uid', '$id_follow');";
    } else { // unfoll
        $sql = "DELETE FROM follow WHERE user_id = '$uid' AND id_follow = '$id_follow';";
    }

    // kl query berhasil ato gagal dieksekusi
    if (mysqli_query($con, $sql)) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error']);
    }

    mysqli_close($con);    

 ?>