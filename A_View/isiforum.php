 <?php
include_once "../A_Model/config.php";

if (!isset($_GET['forum_id'])) {
    echo "Forum not found.";
    exit;
}

$forum_id = (int)($_GET['forum_id'] ?? 0); // Cast to int for safety
$forum_name = $_GET['name'];
echo "<h1 style='text-align:left;color:white;'>$forum_name</h1>";
$admin = false;
if (isset($_SESSION['is_admin'])) {
    if ($_SESSION['is_admin'] == 'admin') {
        $admin = true;
    }
}

$id = $_SESSION['user_id'] ?? 0; // Ensure user_id is set, default to 0 if not logged in


$sql = "SELECT * FROM forum_posting fp 
        LEFT JOIN forum f ON fp.forum_id = f.forum_id 
        LEFT JOIN user u ON fp.user_id = u.id 
        WHERE f.forum_id = $forum_id
        ORDER BY fp.date_posted ASC";

$result = mysqli_query($con, $sql);

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    //print all forum posting here
    //display attachment
    //user image and name links to user page
    echo "<div class='forum-post' id='post_" . $row['post_id'] . "'>";
    echo "<div class='user-info'>";
    echo "<img src='../uploads/" . $row['profilepic'] . "' alt='User Image' class='user-image'><br>";
    
    echo "<a href='main.php?page=profile&id=" . $row['id'] . "'>" . $row['username'] . "</a><br>";
    echo $row['date_posted'];
    echo "<br>";
    if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != $row['user_id']) {
        $sql = "SELECT * FROM follow WHERE user_id = " . $_SESSION['user_id'] . " AND id_follow = " . $row['id'];
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
if (isset($_SESSION['user_id'])) {
    echo "<h2 style='text-align:left;color:white;'>Reply</h2>";
    echo "<form action='../A_Controller/replyForum.php' method='post' enctype='multipart/form-data'>";
    echo "<input type='hidden' name='user_id' value='" . $_SESSION['user_id'] . "'>";
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
