$(document).ready(function() {
    $('.comment-form').on('submit', function(e) { // Changed from click to submit
        e.preventDefault();

        var $form = $(this); // Changed from $('.comment-form') to $(this)
        var content = $form.find('input[name="content"]').val().trim();
        var forumId = $form.data('forum-id'); // Get forum ID from button

        if(!content) return;

        $.ajax({
            url: '../A_Controller/add_album_comment.php',
            type: 'POST',
            data: {
                content: content,
                forum_id: forumId
            },
            success: function(response) {
                $(`#comments-${forumId}`).append(response);
                $form.find('input[name="content"]').val(''); // Clear input
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('An error occurred while posting the comment.');
            }
        });
    });
});