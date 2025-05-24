<?php
include_once "../A_Model/config.php";

$post_id = $_POST['post_id'];
$file = $_POST['file'];

$sql = "DELETE FROM attachment WHERE post_id = $post_id AND attachment = '$file'";
if(mysqli_query($con, $sql)){
    if(file_exists($file)) {
        unlink($file); // Remove file from server
    }
    echo "success";
} else {
    echo "error";
}
?>