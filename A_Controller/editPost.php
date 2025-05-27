<?php
include_once "../A_Model/config.php";

$admin = false;
if (isset($_SESSION['is_admin'])) {
    $admin = $_SESSION['is_admin'];
}

$post_id = $_POST['post_id'];
$content = mysqli_real_escape_string($con, $_POST['content']);
$sql = "UPDATE forum_posting SET content = '$content' WHERE post_id = $post_id";

// Handle new attachments if any
if (!empty($_FILES['new_attachments']['name'][0])) {
    $uploadDir = '../images/upload/';
    foreach ($_FILES['new_attachments']['tmp_name'] as $key => $tmp_name) {
        $fileName = basename($_FILES['new_attachments']['name'][$key]);
        $targetPath = $uploadDir . time() . "_" . $fileName;
        if (move_uploaded_file($tmp_name, $targetPath)) {
            $escapedPath = mysqli_real_escape_string($con, $targetPath);
            $insert_sql = "INSERT INTO attachment (post_id, attachment) VALUES ($post_id, '$escapedPath')";
            mysqli_query($con, $insert_sql);
        }
    }
}

if(mysqli_query($con, $sql)){
    $sql = "SELECT * FROM forum_posting fp LEFT JOIN forum f ON fp.forum_id = f.forum_id 
                    LEFT JOIN user u ON fp.user_id = u.id 
                    WHERE fp.post_id = " . $post_id;


   

    if ($result = mysqli_query($con, $sql)) {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        //print all forum posting here
        //display attachment
        //user image and name links to user page
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
        echo "<form class='editform' method='post'>";
        echo "<input type='hidden' name='post_id' value='" . $row['post_id'] . "'>";
        echo "<input type='hidden' name='forum_id' value='" . $row['forum_id'] . "'>";
        echo "<input type='submit' value='Edit'>";
        echo "</form>";
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
    }
} else {
    echo "Error updating post.";
}
?>