<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "wte";
    $port = "3306";

    $con = mysqli_connect($servername,$username,$password,$dbname, $port);
    if(!$con){
        echo "Connection failed: " . mysqli_connect_error();
    }
?>