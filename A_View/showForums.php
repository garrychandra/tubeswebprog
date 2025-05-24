<?php
include_once "../A_Model/config.php";

$sql = "SELECT * FROM forum";
$result = mysqli_query($con,$sql);

while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    //link to forum here
    echo "<a href='main.php?page=isiforum&forum_id={$row['forum_id']}&name=" . urlencode($row['name']) . "'>" . htmlspecialchars($row['name']) . "</a><br>";
}

mysqli_close($con);
?>

