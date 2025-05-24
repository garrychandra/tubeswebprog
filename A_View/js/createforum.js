$(document).ready(function(){
  $("#createbutton").click(function(){
    $("#createforum").slideToggle();
  });

  $(document).on('submit', '#createforumform', function (e) {
    e.preventDefault(); // Prevent form submission
    var forumName = $(this).find('input[name="forum_name"]').val();
    var formData = $(this).serialize(); // Serialize form data

    $.ajax({
      type: 'POST',
      url: '../A_Controller/createForum.php', // URL to your create forum script
      data: formData,
      success: function(response) {
        // Handle success response
        $("#createforum").slideUp(); // Hide the form after successful creation
        alert('Forum created successfully: ' + response);
        document.getElementById("forums").innerHTML += "<a href='main.php?page=isiforum&forum_id=" + response + "&name=" + forumName + "'>" + forumName + "</a><br>";

      },
      error: function() {
        alert('Error creating forum. Please try again.');
      }
    });
  });


});