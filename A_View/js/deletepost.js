$(document).ready(function () {
    $(document).on('submit', '.deleteform', function (e) {
        e.preventDefault();
        if (confirm('Are you sure you want to delete this post?')) {
            var post_id = $(this).find('input[name="post_id"]').val();
            $.ajax({
                type: 'POST',
                url: "../A_Controller/deletePost.php", // URL to your delete script
                data: $("form").serialize(),
                success: function (response) {
                    // Handle success response
                    alert('Post deleted successfully');
                    $("div#post_" + post_id).remove();
                },
            });
        }
    });
});