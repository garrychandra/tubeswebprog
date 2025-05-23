<style>
    html {
        color: #fff;
    }
</style>

<?php
require_once '../A_Model/user_model.php';

if (!isset($_SESSION['user_id'])) {
    die("You must be logged in");
}

$user_id = $_SESSION['user_id'];
$user = get_user_by_id($user_id);
?>

<h2>Edit Profile</h2>
<form action="../A_Controller/edit_controller.php" method="post">
    <div>
        <label for="">Username</label>
        <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>">
    </div>
    <div>
        <label for="">Bio</label>
        <textarea name="bio"><?= $user['bio']?></textarea>
    </div>
    <div>
        <label for="">Profile Picture</label>
        <input type="file" name="profile_pic">
    </div>
    <button type="submit" name="edit-btn">Update Profile</button>
</form>