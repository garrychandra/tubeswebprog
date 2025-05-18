<?php
include 'koneksi.php'; // Your DB connection
$post_id = $_POST['post_id'];

$response = [];

$sql = "SELECT content FROM forum_posting WHERE post_id = '$post_id'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$response['content'] = $row['content'];

$sql2 = "SELECT attachment FROM attachment WHERE post_id = '$post_id'";
$result2 = mysqli_query($con, $sql2);

$response['attachments'] = [];
while($row2 = mysqli_fetch_assoc($result2)){
    $response['attachments'][] = $row2['attachment'];
}

echo json_encode($response);
?>