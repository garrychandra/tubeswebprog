<div class="profile-container">
    <div class="profile-header">

        <img src="../uploads/<?= htmlspecialchars($user['profilepic'] ?? 'default.png')?>" alt="Profile Picture" class="profile-pic" width='100' height="100">

        <div class="profile-info">
            <h2><?= htmlspecialchars($user['username'] ?? '') ?></h2>

            <!-- kalo dia admin nnt ada tulisan ADMIN nya -->
            <?php if(isset($user['is_admin']) && $user['is_admin']): ?>
                <strong style="color:red">['ADMIN']</strong>
            <?php endif; ?>

            <p class="bio"><?= htmlspecialchars($user['bio'] ?? '') ?></p>

            <p><strong>Email:</strong> <?= htmlspecialchars($user['email'] ?? '') ?></p>

            <!-- munculin jumlah following followers -->
            <div class="stats">
                <span><a href="main.php?page=followers&user_id=<?= htmlspecialchars($user['id']) ?>&type=followers">Followers: <?= htmlspecialchars($followers)?></a></span>
                <span><a href="main.php?page=following&user_id=<?= htmlspecialchars($user['id'])?>&type=following">Following: <?= htmlspecialchars($following)?></a></span>
            </div>
        </div>
    </div>
    
    <?php
        // message sukses/error dr session
        if (isset($_SESSION['message'])) {
            echo '<div class="alert alert-' . ($_SESSION['message_type'] ?? 'info') . '">' . htmlspecialchars($_SESSION['message']) . '</div>';
            unset($_SESSION['message']);
            unset($_SESSION['message_type']);
        }
    ?>

    <div class="profile-actions">
        <!-- liat profile diri sendiri, nnt ada button edit, delete, logout -->
        <?php if($is_own_profile): ?>
            <a href="main.php?page=edit_profile" class="edit-button">Edit Profile</a>
            <a href="main.php?page=settings">Settings</a>
            <button id="deleteAccountBtn" class="delete-account-btn">Delete Account</button>
            <form action="../A_Controller/logout_controller.php" method="POST" style="display:inline;">
                <button type="submit" name="confirm_logout">Log out</button>
            </form>
        <!-- liat profile org lain, nnt ada button follow unfoll -->
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

</div>

<script>
document.addEventListener('DOMContentLoaded', function() { // js jalan stlh semua struktur html selesai diload
    const deleteButton = document.getElementById('deleteAccountBtn'); // ada di atas bagian delete acc

    if (deleteButton) {
        deleteButton.addEventListener('click', function() {
            // tanya confirm sblm bnrn delete acc 
            const confirmDelete = confirm("Are you sure you want to delete your account?.");

            if (confirmDelete) {
                // ini ngirim request POST ke delete_account_controller
                fetch('../A_Controller/delete_account_controller.php', {
                    method: 'POST',
                    // kek ngasitau server klo data yg dikirim di body formatnya kyk data form html
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    // ngirim user_id yg mau del acc lewat POST
                    body: 'user_id=<?= htmlspecialchars($user['id'] ?? '') ?>'
                })
                .then(response => response.text()) // ngambil response trs jadiin teks
                .then(data => {
                    console.log("Server Response:", data); // liat apa yg direturn server

                    if (data.trim() === 'success') {
                        alert("Your account has been successfully deleted.");
                        window.location.href = "main.php?page=logout"; // redirect ke page logout/home
                    } else {
                        alert("Failed to delete account: " + data);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert("An error occurred while trying to delete your account");
                });
            }
        });
    }
});
</script>