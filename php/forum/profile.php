<?php
    include_once "koneksi.php";

    session_start();

    // query username, profilepic
    $id = $_GET["id"];
    if(isset($_SESSION["id"])){
        $sesid = $_SESSION["id"];
    }
    
    $result = mysqli_query($con, "SELECT * FROM user WHERE id = '$id'");

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
    echo "<img src='$profilepic'><br>";
    echo "<h1>$username</h1>";  
    echo "<br>";
    echo "Posts : $posting";
    echo "<br>";
    echo "Followers : <span id='followers'>" . $followers ."</span>";
    echo "<br>";
    echo "Following : $following<br>";

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
    
    if(isset($_SESSION["id"])){
        $result = mysqli_query($con, "SELECT * FROM follow WHERE user_id = '$sesid' && id_follow = '$id'");
        if (mysqli_num_rows($result) == 0){
            echo "<button id='follow' value='" . $id . "' onClick='follow(this.value)'>Follow</button>";
        } else {
            echo "<button id='follow' value='" . $id . "' onClick='unfollow(this.value)'>Unfollow</button>";
        }
    }
    //tambah follow ajax
    echo "<script>
        function follow(str) {
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
                document.getElementById('followers').innerHTML=this.responseText;
            }
        }
        xmlhttp.open('GET','follow.php',true);
        xmlhttp.send(id='$id'&follow=1);
        }

        function unfollow(str) {
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
                document.getElementById('followers').innerHTML=this.responseText;
            }
        }
        xmlhttp.open('GET','follow.php',true);
        xmlhttp.send(id='$id'&follow=0);
        }

    </script>";
?>