<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
    <?php
        include "style.php";
    ?>
    <style>
    .forum-post {
        display: flex;
        margin-top: 10px;
        margin-bottom: 20px;
        width:70%;
        border: 1px solid white;
        color:white;
        margin:auto;
    }
    .user-info {
        margin-right: 20px;
        float: left;
        border: 1px solid white;
    }
    .post-content {
        width: 100%;
    }
    .attachment-image {
            float: left;
            display: inline-block;
            width: 100px;
    }
    .attachments {
        display: flex;
        flex-wrap: wrap;
    }
    .post-actions {
        margin-top: 10px;
        display: flex;
        justify-content: space-between;
        align-items: right;
        float: right;

    }

    .reply {
        margin-top: 20px;
        width:70%;
        border: 1px solid white;
        color:white;
        margin:auto;
    }
</style>
</head>

<body>



<?php
include_once "koneksi.php";
include "header.php";
session_start();

$forum_id = $_GET['forum_id'];
$forum_name = $_GET['name'];
echo "<h1 style='text-align:left;color:white;'>$forum_name</h1>";
$admin = false;
if(isset($_SESSION['role'])){
    if($_SESSION['role'] == 'admin'){
        $admin = true;
    }
}

$sql = "SELECT * FROM forum_posting fp LEFT JOIN forum f ON fp.forum_id = f.forum_id 
                    LEFT JOIN user u ON fp.user_id = u.id 
                    WHERE f.forum_id = ".$_GET['forum_id']."
                    ORDER BY fp.date_posted ASC";
                    
$result = mysqli_query($con,$sql);

while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    //print all forum posting here
    //display attachment
    //user image and name links to user page
    echo "<div class='forum-post'>";
        echo "<div class='user-info'>";
            echo "<img src='upload/".$row['profilepic']."' alt='User Image' class='user-image'><br>";
            echo "<a href='profile.php?id=".$row['id']."'>".$row['username']."</a><br>";
            echo $row['date_posted'];
        echo "</div>";
        echo "<div class='post-content'>";
            echo $row['content'];
            echo "<br>";
            $sql = "SELECT attachment FROM attachment WHERE post_id = ".$row['post_id'];
            $result2 = mysqli_query($con,$sql);
            echo "<div class='attachments'>";
            while($row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC)){
                echo "<img src='".$row2['attachment']."' alt='User Image' class='attachment-image'><br>";
            }
            echo "</div>";
            echo "<br>";
            echo "<div class='post-actions'>";
                echo "<form action='editPost.php' method='post'>";
                    echo "<input type='hidden' name='post_id' value='".$row['post_id']."'>";
                    echo "<input type='hidden' name='forum_id' value='".$row['forum_id']."'>";
                    echo "<input type='submit' value='Edit'>";
                echo "</form>";
            if($admin){
                echo "<form action='deletePost.php' method='post'>";
                    echo "<input type='hidden' name='post_id' value='".$row['post_id']."'>";
                    echo "<input type='hidden' name='forum_id' value='".$row['forum_id']."'>";
                    echo "<input type='hidden' name='user_id' value='".$row['user_id']."'>";
                    echo "<input type='submit' value='Delete'>";
                echo "</form>";
            }
            echo "</div>";
        echo "</div>";
    echo "</div>";
}
echo "<br>";
echo "<div class='reply'>";
//display reply form here
//if user is logged in, show reply form
if(isset($_SESSION['id'])){
    echo "<h2 style='text-align:left;color:white;'>Reply</h2>";
    echo "<form action='replyForum.php' method='post'>";
        echo "<input type='hidden' name='user_id' value='".$_SESSION['id']."'>";
        echo "<input type='hidden' name='forum_id' value='".$forum_id."'>";
        echo "<textarea name='msg' rows='5' cols='50'></textarea><br>";
        echo "<input type='file' name='upload[]' multiple>";
        echo "<input type='submit' value='Reply'>";
    echo "</form>";
} 
else{
    echo "<h2 style='text-align:left;color:white;'>You must login to post</h2>";
}
echo "</div>";
    

include "footer.php";
?>

</body>
</html>