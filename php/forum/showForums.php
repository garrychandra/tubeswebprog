<?php
include_once "koneksi.php";

$sql = "SELECT * FROM forum";
$result = mysqli_query($con,$sql);

while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    //link to forum here
}

mysqli_close($con);
?>