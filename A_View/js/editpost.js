//edit post
$(document).ready(function () {
    // EDIT BUTTON CLICK
    $(document).on('submit', '.editform', function (e) {
        e.preventDefault(); // Prevent form submission
        var post_id = $(this).find('input[name="post_id"]').val();
        var contentDiv = $('#content_' + post_id);


        // Get original content (optional, better to store it elsewhere or via data attribute)
        var originalContent = contentDiv.html();
        

        // Fetch current content + attachments via AJAX (optional, or reuse what's already on the page)
        $.ajax({
            url: '../A_Controller/getPost.php',
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
            url: '../A_Controller/editPost.php',
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
                url: '../A_Controller/deleteAttachment.php',
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