<?php
include_once "../A_Model/config.php";

$sql = "SELECT * FROM forum WHERE name NOT LIKE '%comment%'";
$result = mysqli_query($con,$sql);

echo "<div id='forums' style='color:white;'>"; 
while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    //link to forum here
    
    echo "<a href='main.php?page=isiforum&forum_id={$row['forum_id']}&name=" . urlencode($row['name']) . "'>" . htmlspecialchars($row['name']) . "</a><br>";
}
echo "</div>";

mysqli_close($con);

if($_SESSION['is_admin'] == 'admin'):
?>
<br>
<button id="createbutton">Create Forum</button>
<div id="createforum" style="display: none;">
    <form method="post" id="createforumform">
        <label for="forum_name" style="color:white;">Forum Name:</label>
        <input type="text" id="forum_name" name="forum_name" style="background-color: white;" required>
        <input type="submit" value="Create Forum">
    </form>
</div>

<?php endif; ?>