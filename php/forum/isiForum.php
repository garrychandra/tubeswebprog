<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
?>
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="deletepost.js"></script>
    <script src="editpost.js"></script>
    <script src="follow.js"></script>
    <link rel="stylesheet" href="isiForum.css">
    <title>Forum</title>
</head>

<body>

    <?php
    include_once "koneksi.php";
    include "header.php";
    

    $forum_id = $_GET['forum_id'];
    $forum_name = $_GET['name'];
    echo "<h1 style='text-align:left;color:white;'>$forum_name</h1>";
    $admin = false;
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'admin') {
            $admin = true;
        }
    }
   

    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];
    }



    $sql = "SELECT * FROM forum_posting fp LEFT JOIN forum f ON fp.forum_id = f.forum_id 
                    LEFT JOIN user u ON fp.user_id = u.id 
                    WHERE f.forum_id = " . $_GET['forum_id'] . "
                    ORDER BY fp.date_posted ASC";

    $result = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        //print all forum posting here
        //display attachment
        //user image and name links to user page
        echo "<div class='forum-post' id='post_" . $row['post_id'] . "'>";
        echo "<div class='user-info'>";
        echo "<img src='upload/" . $row['profilepic'] . "' alt='User Image' class='user-image'><br>";
        echo "<a href='profile.php?id=" . $row['id'] . "'>" . $row['username'] . "</a><br>";
        echo $row['date_posted'];
        echo "<br>";
        if (isset($_SESSION['id']) && $_SESSION['id'] != $row['user_id']) {
            $sql = "SELECT * FROM follow WHERE user_id = " . $_SESSION['id'] . " AND id_follow = " . $row['id'];
            $result2 = mysqli_query($con, $sql);
            //follow button
            if(mysqli_num_rows($result2) > 0){
                echo "<button class='follow-btn' data-user-id='".$row['id']."' data-follow='0'>Unfollow</button>";
            } else {
                echo "<button class='follow-btn' data-user-id='".$row['id']."' data-follow='1'>Follow</button>";
            }
        }
        echo "</div>";
        echo "<div class='post-content' id='content_" . $row['post_id'] . "'>";
        echo $row['content'];
        echo "<br>";
        $sql = "SELECT attachment FROM attachment WHERE post_id = " . $row['post_id'];
        $result2 = mysqli_query($con, $sql);
        echo "<div class='attachments'>";
        while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
            echo "<img src='" . $row2['attachment'] . "' alt='User Image' class='attachment-image'><br>";
        }
        echo "</div>";
        echo "<br>";
        echo "<div class='post-actions'>";
        if ($row['user_id'] == $id) {
            echo "<form class='editform' method='post'>";
            echo "<input type='hidden' name='post_id' value='" . $row['post_id'] . "'>";
            echo "<input type='hidden' name='forum_id' value='" . $row['forum_id'] . "'>";
            echo "<input type='submit' value='Edit'>";
            echo "</form>";
        }
        if ($admin) {
            echo "<form class='deleteform' method='post'>";
            echo "<input type='hidden' name='post_id' value='" . $row['post_id'] . "'>";
            echo "<input type='hidden' name='forum_id' value='" . $row['forum_id'] . "'>";
            echo "<input type='hidden' name='user_id' value='" . $row['user_id'] . "'>";
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
    if (isset($_SESSION['id'])) {
        echo "<h2 style='text-align:left;color:white;'>Reply</h2>";
        echo "<form action='replyForum.php' method='post' enctype='multipart/form-data'>";
        echo "<input type='hidden' name='user_id' value='" . $_SESSION['id'] . "'>";
        echo "<input type='hidden' name='forum_id' value='" . $forum_id . "'>";
        echo "<textarea name='msg' rows='5' cols='50'></textarea><br>";
        echo "<input type='file' name='upload[]' multiple>";
        echo "<input type='submit' value='Reply'>";
        echo "</form>";
    } else {
        echo "<h2 style='text-align:left;color:white;'>You must login to post</h2>";
    }
    echo "</div>";

    mysqli_close($con);
    ?>
</body>

</html>