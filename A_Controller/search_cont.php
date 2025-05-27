<?php
session_start();
include '../A_Model/user_model.php';

$term = $_GET['term'] ?? '';
$search_result = search_users($term);

$logged_in = isset($_SESSION['user_id']);
$my_id = $_SESSION['user_id'] ?? 0;

if (mysqli_num_rows($search_result) > 0):
    while ($row = mysqli_fetch_assoc($search_result)):
        $profile_id = $row['id'];
        if ($profile_id == $my_id) continue; // skip yourself

        $username = htmlspecialchars($row['username']);
        $role = $row['role'];
        $pp = htmlspecialchars($row['profilepic']);
        $is_following = $logged_in ? is_following($my_id, $profile_id) : false;
?>
    <li style="margin-bottom: 10px;">
        <img src="uploads/<?= $pp ?>" width="32" height="32" style="border-radius:50%; vertical-align:middle;">
        <?= $username ?>
        <?php if ($role === 'admin'): ?>
            <small style="color:red;">(admin)</small>
        <?php endif; ?>

        <?php if ($logged_in): ?>
            <form action="../A_Controller/follow_controller.php" method="POST" style="display:inline;">
                <input type="hidden" name="followed_id" value="<?= $profile_id ?>">
                <input type="hidden" name="action" value="<?= $is_following ? 'unfollow' : 'follow' ?>">
                <button type="submit"><?= $is_following ? 'Unfollow' : 'Follow' ?></button>
            </form>
        <?php endif; ?>
    </li>
<?php
    endwhile;
else:
    echo "<li>No users found.</li>";
endif;
?>
