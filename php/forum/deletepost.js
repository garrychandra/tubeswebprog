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