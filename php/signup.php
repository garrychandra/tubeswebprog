<?php
require_once 'forum/koneksi.php';

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

$sql="insert into user VALUES (null,'$username','$password','$email',null,'member')";
mysqli_query($con,$sql);
header('location:../html/home.html')
?>
