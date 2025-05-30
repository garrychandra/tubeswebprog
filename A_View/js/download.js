$(document).ready(function() {
    $(document).on('submit', '.downloadform', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: '../A_Controller/generate_user_data.php',
            type: 'POST',
            success: function(response) {
                $('#downloadLink').html(
                    `<a href="../downloads/${response}" download>
                        <button class="download-btn">Download File</button>
                    </a>`
                );
                $('#downloadLink').show();
            },
            error: function(error) {
                console.error('Error:', error);
                alert('Failed to generate file');
            }
        });
    });
});