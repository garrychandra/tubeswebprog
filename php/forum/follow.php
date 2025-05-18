<?php
    $id_follow = $_POST['id_follow'];
    $follow = $_POST['follow'];

    session_start();
    $uid = $_SESSION['id'];
    include_once "koneksi.php";
    $sql;
    if($follow == '1'){
        $sql = "INSERT INTO follow VALUES ('$uid', '$id_follow');";
    } else {
        $sql = "DELETE FROM follow WHERE user_id = '$uid' AND id_follow = '$id_follow';";
    }

    if (mysqli_query($con, $sql)) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error']);
    }

    mysqli_close($con);    

    

 ?>