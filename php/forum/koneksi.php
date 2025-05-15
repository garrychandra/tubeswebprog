<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "wte";
    $port = "3307";

    $con = mysqli_connect($servername,$username,$password,$dbname);
    if(!$con){
        echo "Connection failed: " . mysqli_connect_error();
    }
?>