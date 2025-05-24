<?php
require_once '../A_Controller/profile_controller.php';
?>

<style>
    html {
        color: white;
    }
</style>

<h2>Profile</h2>
<?php if($user['role'] === 'admin'): ?>
    <strong style="color:red">[ADMIN]</strong>
<?php endif; ?>

<p>
    <strong>Username:</strong>
    <?= htmlspecialchars($user['username']) ?>
</p>

<p>
    <strong>Email:</strong>
    <?= htmlspecialchars($user['email']) ?>
</p>

<p>
    <strong>Bio:</strong>
    <?= htmlspecialchars($user['bio']) ?>
</p>

<p>
    <a href="main.php?page=followers&type=followers&user_id=<?= $user['id'] ?>">Followers: <?= $followers?></a>
    <a href="main.php?page=following&type=following&user_id=<?= $user['id']?>">Following: <?= $following?></a>
</p>

<img src="../images/upload/<?= htmlspecialchars($user['profilepic'])?>" alt="" style="max-width:200px; max-height:200px; width:auto; height:auto; object-fit:cover; cursor:pointer;" onclick="openImageModal(this.src)">

<script>
function openImageModal(src) {
    document.getElementById('modalImg').src = src;
    document.getElementById('imgModal').style.display = 'flex';
}
function closeImageModal() {
    document.getElementById('imgModal').style.display = 'none';
}
</script>

<?php if($is_own_profile): ?>
    <br><a href="main.php?page=edit_profile">Edit Profile</a>
    <br><a href="logout_view.php">Log out</a><br>
<?php endif ?>


<?php
include_once "../A_Model/config.php";
$sql = "SELECT * FROM follow WHERE user_id = " . $_SESSION['user_id'] . " AND id_follow = " . $user['id'];
$result2 = mysqli_query($con, $sql);
//follow button
if(mysqli_num_rows($result2) > 0){
    echo "<button class='follow-btn' data-user-id='".$user['id']."' data-follow='0'>Unfollow</button>";
} else {
    echo "<button class='follow-btn' data-user-id='".$user['id']."' data-follow='1'>Follow</button>";
}

?>

<!-- Modal HTML (place near the bottom of your file, before </body>) -->
<div id="imgModal" style="display:none; position:fixed; z-index:9999; left:0; top:0; width:100vw; height:100vh; background:rgba(0,0,0,0.8); align-items:center; justify-content:center;">
    <span onclick="closeImageModal()" style="position:absolute; top:20px; right:40px; color:white; font-size:40px; cursor:pointer;">&times;</span>
    <img id="modalImg" src="" style="max-width:90vw; max-height:90vh; display:block; margin:auto;">
</div>