<?php
session_start();
require_once '../A_Model/config.php';

if (!isset($_SESSION['user_id'])) {
    die('Please login first');
}

$user_id = $_SESSION['user_id'];
$user = mysqli_fetch_assoc(mysqli_query($con, "SELECT username, email FROM user WHERE id = $user_id"));

$filename = "user_" . $user['username'] . "_" . date('Y-m-d') . ".txt";
$filepath = "../downloads/" . $filename;

if (!file_exists("../downloads")) {
    mkdir("../downloads", 0777, true);
}

$file = fopen($filepath, "w");

fwrite($file, "USER DATA EXPORT\n");
fwrite($file, "==============\n\n");
fwrite($file, "Username: " . $user['username'] . "\n");
fwrite($file, "Email: " . $user['email'] . "\n\n");

$result = mysqli_query($con, "SELECT f.name, fp.content, fp.date_posted 
                            FROM forum_posting fp 
                            JOIN forum f ON fp.forum_id = f.forum_id 
                            WHERE fp.user_id = $user_id");

fwrite($file, "FORUM POSTS\n");
fwrite($file, "===========\n\n");
while ($post = mysqli_fetch_assoc($result)) {
    fwrite($file, "Forum: " . $post['name'] . "\n");
    fwrite($file, "Date: " . $post['date_posted'] . "\n");
    fwrite($file, "Content: " . $post['content'] . "\n");
    fwrite($file, "----------------------------------------\n");
}

$result = mysqli_query($con, "SELECT u.username 
                                FROM follow f 
                                JOIN user u ON f.id_follow = u.id 
                                WHERE f.user_id = $user_id");

fwrite($file, "\nFOLLOWING USERS\n");
fwrite($file, "==============\n\n");
while ($follow = mysqli_fetch_assoc($result)) {
    fwrite($file, "- " . $follow['username'] . "\n");
}

$result = mysqli_query($con, "SELECT u.username 
                                FROM follow f 
                                JOIN user u ON f.user_id = u.id 
                                WHERE f.id_follow = $user_id");

fwrite($file, "\nFOLLOWERS\n");
fwrite($file, "=========\n\n");
while ($follower = mysqli_fetch_assoc($result)) {
    fwrite($file, "- " . $follower['username'] . "\n");
}


fclose($file);

if (file_exists($filepath)) {
    echo basename($filepath);
} else {
    echo "error";
}