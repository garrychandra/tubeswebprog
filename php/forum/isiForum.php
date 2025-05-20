<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
?>
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <title>Forum</title>
    <?php
    include "style.php";
    ?>
    <style>
        .forum-post {
            display: flex;
            margin-top: 10px;
            margin-bottom: 20px;
            width: 70%;
            border: 1px solid white;
            color: white;
            margin: auto;
        }

        .user-info {
            margin-right: 20px;
            float: left;
            border: 1px solid white;
        }

        .post-content {
            width: 100%;
        }

        .attachment-image {
            float: left;
            display: inline-block;
            width: 100px;
        }

        .attachments {
            display: flex;
            flex-wrap: wrap;
        }

        .attachment-block {
            display: flex;
            flex-direction: column;
            align-items: center; /* Center image & button */
            margin: 10px;
            width: fit-content;
            text-align: center;
        }

        .delete-attachment {
            margin-top: 5px;
        }


        .post-actions {
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
            align-items: right;
            float: right;

        }

        .reply {
            margin-top: 20px;
            width: 70%;
            border: 1px solid white;
            color: white;
            margin: auto;
        }

        
    </style>

    <!--delete post confirmation-->
    <script>
        $(document).ready(function () {
            $('.deleteform').on('submit', function (e) {
                e.preventDefault();
                if (confirm('Are you sure you want to delete this post?')) {
                    var post_id = $(this).find('input[name="post_id"]').val();
                    $.ajax({
                        type: 'POST',
                        url: "deletePost.php", // URL to your delete script
                        data: $("form").serialize(),
                        //or your custom data either as object {foo: "bar", ...} or foo=bar&...
                        success: function (response) {
                            // Handle success response
                            alert('Post deleted successfully');
                            alert("div['post_" + post_id + "']");
                            $("div#post_" + post_id).remove();
                        },
                    });
                }
            });
        });
    </script>

    <script>
        //edit post
        $(document).ready(function () {
            // EDIT BUTTON CLICK
            $('.editform').on('submit', function (e) {
                e.preventDefault(); // Prevent form submission
                var post_id = $(this).find('input[name="post_id"]').val();
                var contentDiv = $('#content_' + post_id);


                // Get original content (optional, better to store it elsewhere or via data attribute)
                var originalContent = contentDiv.html();
                

                // Fetch current content + attachments via AJAX (optional, or reuse what's already on the page)
                $.ajax({
                    url: 'getPost.php',
                    type: 'POST',
                    data: { post_id: post_id },
                    dataType: 'json',
                    success: function (data) {
                        
                        // Build textarea and buttons
                        var html = `
                    <textarea id='edit_content_${post_id}' rows='5' cols='60'>${data.content}</textarea><br>
                    <div id='attachments_${post_id}'>`;

                        data.attachments.forEach(function (attachment) {
                            html += `
                        <div class='attachment-block' data-file='${attachment}'>
                            <img src='${attachment}' class='attachment-image' style='max-width:100px;'>
                            <br><button type='button' class='delete-attachment' data-post-id='${post_id}' data-file='${attachment}'>Delete</button>
                        </div>`;
                        });

                        html += `</div>
                    <br>
                    <label>Add more attachments:</label>
                    <input type='file' name='new_attachments[]' id='new_attachments_${post_id}' multiple><br><br>
                    <button type='button' class='save-edit' data-post-id='${post_id}'>Save</button>
                    <button type='button' class='cancel-edit' data-post-id='${post_id}'>Cancel</button>
                `;

                        contentDiv.html(html);
                    }
                });
            });

            // SAVE CHANGES
            $(document).on('click', '.save-edit', function () {
                var post_id = $(this).data('post-id');
                var new_content = $('#edit_content_' + post_id).val();
                var files = $('#new_attachments_' + post_id)[0].files;

                var formData = new FormData();
                formData.append('post_id', post_id);
                formData.append('content', new_content);

                for (let i = 0; i < files.length; i++) {
                    formData.append('new_attachments[]', files[i]);
                }

                $.ajax({
                    url: 'editPost.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        $('#content_' + post_id).html(response); // Assume response is the updated HTML
                    }
                });
            });

            // CANCEL EDIT
            $(document).on('click', '.cancel-edit', function () {
                location.reload(); // Simplest way to reload original content
            });

            // DELETE ATTACHMENT
            $(document).on('click', '.delete-attachment', function () {
                var post_id = $(this).data('post-id');
                var file = $(this).data('file');
                var attachmentBlock = $(this).closest('.attachment-block');

                if (confirm("Delete this attachment?")) {
                    $.ajax({
                        url: 'deleteAttachment.php',
                        type: 'POST',
                        data: { post_id: post_id, file: file },
                        success: function (response) {
                            if (response == 'success') {
                                attachmentBlock.remove();
                            } else {
                                alert('Failed to delete attachment');
                            }
                        }
                    });
                }
            });
        });
    </script>

    <script>
        //follow button
        $(document).on('click', '.follow-btn', function() {
    var btn = $(this);
    var userId = btn.data('user-id');
    var follow = btn.data('follow'); // 1 = follow, 0 = unfollow
    
    $.ajax({
        url: 'follow.php',
        type: 'POST',
        dataType: 'json',
        data: {
            id_follow: userId,
            follow: follow
        },
        success: function(response) {
            if (response.status === 'success') {
                if (follow == '1') {
                    btn.text('Unfollow');
                    btn.data('follow', '0');
                } else {
                    btn.text('Follow');
                    btn.data('follow', '1');
                }
            } else {
                alert('Failed to update follow status.');
            }
        },
        error: function() {
            alert('AJAX request failed.');
        }
    });
});
    </script>

</head>

<body>



    <?php
    include_once "koneksi.php";
    include "header.php";
    

    $forum_id = $_GET['forum_id'];
    $forum_name = $_GET['name'];
    echo "<h1 style='text-align:left;color:white;'>$forum_name</h1>";
    $admin = false;
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'admin') {
            $admin = true;
        }
    }
   

    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];
    }



    $sql = "SELECT * FROM forum_posting fp LEFT JOIN forum f ON fp.forum_id = f.forum_id 
                    LEFT JOIN user u ON fp.user_id = u.id 
                    WHERE f.forum_id = " . $_GET['forum_id'] . "
                    ORDER BY fp.date_posted ASC";

    $result = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        //print all forum posting here
        //display attachment
        //user image and name links to user page
        echo "<div class='forum-post' id='post_" . $row['post_id'] . "'>";
        echo "<div class='user-info'>";
        echo "<img src='upload/" . $row['profilepic'] . "' alt='User Image' class='user-image'><br>";
        echo "<a href='profile.php?id=" . $row['id'] . "'>" . $row['username'] . "</a><br>";
        echo $row['date_posted'];
        echo "<br>";
        if (isset($_SESSION['id']) && $_SESSION['id'] != $row['user_id']) {
            $sql = "SELECT * FROM follow WHERE user_id = " . $_SESSION['id'] . " AND id_follow = " . $row['id'];
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
    if (isset($_SESSION['id'])) {
        echo "<h2 style='text-align:left;color:white;'>Reply</h2>";
        echo "<form action='replyForum.php' method='post' enctype='multipart/form-data'>";
        echo "<input type='hidden' name='user_id' value='" . $_SESSION['id'] . "'>";
        echo "<input type='hidden' name='forum_id' value='" . $forum_id . "'>";
        echo "<textarea name='msg' rows='5' cols='50'></textarea><br>";
        echo "<input type='file' name='upload[]' multiple>";
        echo "<input type='submit' value='Reply'>";
        echo "</form>";
    } else {
        echo "<h2 style='text-align:left;color:white;'>You must login to post</h2>";
    }
    echo "</div>";


    include "footer.php";
    ?>

</body>

</html>