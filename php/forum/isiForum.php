<?php
include_once "koneksi.php";

$forum_id = $_GET['forum_id'];

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
        echo "</div>";
    echo "</div>";
}
mysqli_close($con);
?>