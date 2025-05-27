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
            <button id="deleteAccountBtn" class="delete-account-btn">Delete Account</button>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const deleteButton = document.getElementById('deleteAccountBtn');

    if (deleteButton) {
        deleteButton.addEventListener('click', function() {
            // Konfirmasi dengan pengguna sebelum menghapus
            const confirmDelete = confirm("Are you sure you want to delete your account? This action cannot be undone.");

            if (confirmDelete) {
                // Jika pengguna mengkonfirmasi, kirim permintaan POST ke controller hapus akun
                fetch('../A_Controller/delete_account_controller.php', {
                    method: 'POST', // Gunakan POST untuk operasi penghapusan
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    // Kirim user_id yang ingin dihapus melalui body POST
                    body: 'user_id=<?= htmlspecialchars($user['id'] ?? '') ?>' // Menggunakan $user['id'] sesuai dengan kode Anda
                })
                .then(response => response.text()) // Ambil respons dari server sebagai teks
                .then(data => {
                    console.log("Server Response:", data); // Untuk debugging: lihat apa yang dikembalikan server
                    if (data.trim() === 'success') { // Gunakan trim() untuk menghilangkan spasi/newline
                        alert("Your account has been successfully deleted.");
                        window.location.href = "main.php?page=logout"; // Redirect ke halaman logout/home
                    } else {
                        alert("Failed to delete account: " + data);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert("An error occurred while trying to delete your account. Please check console for details.");
                });
            }
        });
    }
});
</script>