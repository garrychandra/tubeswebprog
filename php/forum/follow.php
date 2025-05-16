<?php
    $id_follow = $_GET['id'];
    $follow = $_GET['follow'] == 1 ? true : false;

    session_start();
    $uid = $_SESSION['id'];

    include_once "koneksi.php";
    $sql;
    if($follow){
        $sql = "INSERT INTO follow VALUES ($uid, $id_follow);";
    } else {
        $sql = "DELETE FROM follow WHERE user_id = $uid AND id_follow = $id_follow;";
    }

    mysqli_query($con,$sql);

    $result = mysqli_query($con, "SELECT count(id_follow) FROM follow WHERE id_follow = '$id'");

    $row = mysqli_fetch_array($result);
    echo $row[0];

    

 ?>