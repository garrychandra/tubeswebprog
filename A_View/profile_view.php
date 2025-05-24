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

<img src="../images/upload/<?= htmlspecialchars($user['profilepic'])?>" alt="" width="100" height="100">

<?php if($is_own_profile): ?>
    <br><a href="main.php?page=edit_profile">Edit Profile</a>
    <br><a href="logout_view.php">Log out</a><br>
<?php endif ?>

<p>
    <a href="main.php?page=followers&type=followers&user_id=<?= $user['id'] ?>">Followers: <?= $followers?></a>
    <a href="main.php?page=following&type=following&user_id=<?= $user['id']?>">Following: <?= $following?></a>
</p>