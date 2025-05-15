<style>
    .forum-post {
        display: flex;
        margin-bottom: 20px;
    }
    .user-info {
        margin-right: 20px;
        float: left;
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

<?php
    $_GET['forum_id'] = 1;
    include "isiForum.php";
?>