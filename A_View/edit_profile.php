<div class="edit-profile-container">
    <h2>Edit Your Profile</h2>

    <?php
    if (isset($_SESSION['message'])) {
        echo '<div class="alert alert-' . ($_SESSION['message_type'] ?? 'info') . '">' . htmlspecialchars($_SESSION['message']) . '</div>';
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
    }
    ?>

    <form action="../A_Controller/edit_controller.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['username'] ?? '') ?>" required>
        </div>

        <div class="form-group">
            <label for="bio">Bio:</label>
            <textarea id="bio" name="bio"><?= htmlspecialchars($user['bio'] ?? '') ?></textarea>
        </div>

        <div class="form-group">
            <label for="profilepic">Profile Picture:</label>
            <!-- cek user udh punya profilepic blm. kl ada ditampilin, kl gada dikasih yg default -->
            <?php if (!empty($user['profilepic'])): ?>
                <img src="../uploads/<?= htmlspecialchars($user['profilepic']) ?>" alt="Current Profile Picture" class="profile-pic-preview">
                <br>
            <?php else: ?>
                <img src="../uploads/default.png" alt="Default Profile Picture" class="profile-pic-preview">
                <br>
            <?php endif; ?>

            <input type="file" id="profilepic" name="profilepic" accept="image/jpeg, image/png, image/gif">

            <small>JPG, JPEG, PNG, GIF only.</small>
        </div>

        <button type="submit" class="btn-submit">Update Profile</button>
    </form>

    <a href="main.php?page=profile" class="back-link">Back to Profile</a>
</div>