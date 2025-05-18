<?php
//delete post
include_once "koneksi.php";
$sql = "DELETE FROM forum_posting WHERE post_id = ".$_POST['post_id'].";";
$result = mysqli_query($con,$sql);
mysqli_close($con);

//option to ban(delete) user

?>