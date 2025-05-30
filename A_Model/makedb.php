<?php
$servername = "localhost";
$username = "root";
$password = "";
$con = mysqli_connect($servername,$username,$password);

$sql = "CREATE DATABASE IF NOT EXISTS wte";
if (mysqli_query($con, $sql)) {
    echo "Database 'wte' created<br>";
} else {
    die("Error creating database: " . mysqli_error($con));
}

if (!mysqli_select_db($con, 'wte')) {
    die("Error selecting database: " . mysqli_error($con));
}

$sql_file = file_get_contents('wte.sql');

$queries = array_filter(array_map('trim', explode(';', $sql_file)));

$success = true;
foreach ($queries as $query) {
    if (!empty($query)) {
        if (!mysqli_query($con, $query . ';')) {
            echo "Error executing query: " . mysqli_error($con) . "<br>";
            echo "Query was: " . $query . "<br><br>";
            $success = false;
        }
    }
}

if ($success) {
    echo "Database imported successfully!<br>";
    
    $result = mysqli_query($con, "SHOW TABLES");
    if ($result) {
        echo "<br>Created tables:<br>";
        while ($row = mysqli_fetch_row($result)) {
            echo "- " . $row[0] . "<br>";
        }
    }
}

mysqli_close($con);
?>