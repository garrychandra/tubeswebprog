<?php
$user_id = $_POST['user_id'] ?? null;
$fid = $_POST['forum_id'] ?? null;
if($user_id){
    include_once "../A_Model/config.php";
    

    $sql = "UPDATE user SET `role` = 'banned' WHERE id = ?";
    mysqli_query($con, $sql);
    $sql = "SELECT name FROM forum where forum_id = $fid";
    $result = mysqli_query($con,$sql);
    $fname = mysqli_fetch_array($result)[0];
    header("Location: ../A_View/main.php?page=isiforum&forum_id=$fid&name=" . urlencode($fname));
}
?>