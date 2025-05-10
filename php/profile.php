<?php
    // connection
    $con = mysqli_connect("localhost", "root", "", "wte");

    // check con
    if (!$con) {
        die("Connection failed : " . mysqli_connect_error());
    }

    session_start();

    // query username, profilepic
    $id = $_SESSION['id'];
    $result = mysqli_query($con, "SELECT * FROM user WHERE id = '$id'");

    echo "Id : $id";

    $row = mysqli_fetch_array($result);
    $username = $row['username'];
    $profilepic = $row['profilepic'];

    // query followers
    $result = mysqli_query($con, "SELECT count(id_follow) FROM follow WHERE id_follow = '$id'");

    $row = mysqli_fetch_array($result);
    $followers = $row[0];

    // query following
    $result = mysqli_query($con, "SELECT count(user_id) FROM follow WHERE user_id = '$id'");

    $row = mysqli_fetch_array($result);
    $following = $row[0];

    // query posting
    $result = mysqli_query($con, "SELECT count(user_id) FROM forum_posting WHERE user_id = '$id'");

    $row = mysqli_fetch_array($result);
    $posting = $row[0];

    // nampilin 
    echo "<img src='$profilepic'>";
    echo "<br>";
    echo "Posts : $posting";
    echo "<br>";
    echo "Followers : $followers";
    echo "<br>";
    echo "Following : $following";

    // query attachment (postingan), kyk master query
    $result = mysqli_query($con, "SELECT attachment FROM attachment WHERE post_id IN (SELECT post_id FROM forum_posting WHERE user_id = '$id')");

    $count = 0;
    // pake while krn bisa lebih dari 1
    while ($row = mysqli_fetch_array($result)) {
        echo "<img src='$row[0]'>";
        $count++;

        if ($count == 3) {
            echo "<br>";
            $count = 0;
        }
    }

    
?>