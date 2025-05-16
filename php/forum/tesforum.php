<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discography</title>
    <?php
        include "style.php";
    ?>
    <style>
    .forum-post {
        display: flex;
        margin-bottom: 20px;
        width:90%;
        border: 1px solid white;
        color:white;
    }
    .user-info {
        margin-right: 20px;
        float: left;
        border: 1px solid black;
    }
    .post-content {
        max-width: 600px;
    }
    .attachment-image {
            float: left;
            display: inline-block;
            width: 100px;
        
    }
</style>
</head>

<body>
    
<?php
    include "header.php";
    include "showForums.php";
    include "footer.php";
?>

</body>