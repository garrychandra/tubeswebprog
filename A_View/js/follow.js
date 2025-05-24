$(document).ready(function () {
    $(document).on('click', '.follow-btn', function() {
    var btn = $(this);
    var userId = btn.data('user-id');
    var follow = btn.data('follow'); // 1 = follow, 0 = unfollow
    
    $.ajax({
        url: '../A_Controller/follow.php',
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
});