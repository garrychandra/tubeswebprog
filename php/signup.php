<?php
$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];

require_once 'forum/koneksi.php';
$sql="insert into user values(null,'$username','$password','$email',null,'member')";
mysqli_query($con,$sql);
header('location:../html/home.html')
?>