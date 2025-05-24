<?php
require_once '../A_Model/config.php';
$sql = "INSERT INTO forum VALUES (null, '$_POST[forum_name]', now())";
mysqli_query($con, $sql);
echo mysqli_insert_id($con); // Return the ID of the newly created forum
?>