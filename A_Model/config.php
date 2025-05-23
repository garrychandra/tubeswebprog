<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "forum_project";
    $port = "3306";

    $con = mysqli_connect($servername,$username,$password,$dbname, $port);
    if(!$con){
        echo "Connection failed: " . mysqli_connect_error();
    }

?>