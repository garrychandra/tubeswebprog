<?php
include_once "koneksi.php";

$sql = "SELECT * FROM forum";
$result = mysqli_query($con,$sql);

while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    //link to forum here
    echo "<a href='isiforum.php?forum_id=".$row['forum_id']."&name=".$row['name'] ."'>" . $row['name'] . "<br>";
}

mysqli_close($con);
?>