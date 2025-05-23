
<style>
    html {
        color: white;
    }
</style>
<?php require_once '../A_Controller/profile_controller.php';?>

<h2>Profile</h2>
<?php if($user['is_admin']): ?>
    <strong style="color:red">['ADMIN']</strong>
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

<img src="../uploads/<?= htmlspecialchars($user['profile_pic'])?>" alt="" width="100" height="100">

<?php if($is_own_profile): ?>
    <a href="main.php?page=edit_profile">Edit Profile</a>
    <a href="logout_view.php">Log out</a>
<?php endif ?>

<p>
    <a href="main.php?page=followers&type=followers&user_id=<?= $user['id'] ?>">Followers: <?= $followers?></a>
    <a href="main.php?page=following&type=following&user_id=<?= $user['id']?>">Following: <?= $following?></a>
</p>