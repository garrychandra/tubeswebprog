<style>
    html {
        color: white;
    }
    .alert {
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 5px;
        font-weight: bold;
    }
    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    .alert-error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
    .alert-info {
        background-color: #d1ecf1;
        color: #0c5460;
        border: 1px solid #bee5eb;
    }
</style>

<a href="search_view.php">Search Users</a>

<div class="profile-container">
    <div class="profile-header">
        <img src="../uploads/<?= htmlspecialchars($user['profilepic'] ?? 'default.png')?>" alt="Profile Picture" class="profile-pic" width='100' height="100">
        <div class="profile-info">
            <h2><?= htmlspecialchars($user['username'] ?? '') ?></h2>
            <?php if(isset($user['is_admin']) && $user['is_admin']): ?>
                <strong style="color:red">['ADMIN']</strong>
            <?php endif; ?>
            <p class="bio"><?= htmlspecialchars($user['bio'] ?? '') ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($user['email'] ?? '') ?></p>

            <div class="stats">
                <span><a href="main.php?page=followers&user_id=<?= htmlspecialchars($user['id']) ?>&type=followers">Followers: <?= htmlspecialchars($followers)?></a></span>
                <span><a href="main.php?page=following&user_id=<?= htmlspecialchars($user['id'])?>&type=following">Following: <?= htmlspecialchars($following)?></a></span>
            </div>
        </div>
    </div><?php
        // message sukses/error dr session
        if (isset($_SESSION['message'])) {
            echo '<div class="alert alert-' . ($_SESSION['message_type'] ?? 'info') . '">' . htmlspecialchars($_SESSION['message']) . '</div>';
            unset($_SESSION['message']);
            unset($_SESSION['message_type']);
        }
    ?>

    <div class="profile-actions">
        <?php if($is_own_profile): ?>
            <a href="main.php?page=edit_profile" class="edit-button">Edit Profile</a>
            <form action="../A_Controller/logout_controller.php" method="POST" style="display:inline;">
                <button type="submit" name="confirm_logout">Log out</button>
            </form>
        <?php else: ?>
            <?php if ($logged_in): ?>
                <?php if ($is_following): ?>
                    <form action="../A_Controller/follow_controller.php" method="POST" style="display:inline;">
                        <input type="hidden" name="action" value="unfollow">
                        <input type="hidden" name="followed_id" value="<?= htmlspecialchars($profile_id) ?>">
                        <button type="submit" name="unfollow_btn">Unfollow</button>
                    </form>
                <?php else: ?>
                    <form action="../A_Controller/follow_controller.php" method="POST" style="display:inline;">
                        <input type="hidden" name="action" value="follow">
                        <input type="hidden" name="followed_id" value="<?= htmlspecialchars($profile_id) ?>">
                        <button type="submit" name="follow_btn">Follow</button>
                    </form>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif ?>
    </div>

    <?php /*
    <div class="gallery">
        <div class="gallery-item"><img src="path/to/image1.jpg" alt="Gallery Image 1"></div>
        <div class="gallery-item"><img src="path/to/image2.jpg" alt="Gallery Image 2"></div>
        <div class="gallery-item"><img src="path/to/image3.jpg" alt="Gallery Image 3"></div>
        </div>
    */ ?>
</div>