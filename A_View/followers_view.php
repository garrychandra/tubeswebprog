<?php
    include_once '../A_Controller/followers_controller.php';
    global $result, $target_id, $type, $search, $logged_in_user;
?>

<link rel="stylesheet" href="../A_View/css/profile.css">
<link rel="stylesheet" href="../A_View/css/followers_view.css">

<form id="searchForm" action="../A_Controller/followers_controller.php" method="get" class="search-form">
    <input type="hidden" name="user_id" value="<?= $target_id ?>">
    <input type="hidden" name="type" value="<?= $type ?>">
    <input type="text" name="search" placeholder="Search username..." value="<?= htmlspecialchars($search) ?>">
    <button type="submit">Search</button>
</form>
 
<div class="all-user-list">
    <div id="userListContainer" class="user-list-container">

        <!-- $result tuh hasil query db dari followers_controller.php. cek ada baris ga -->
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>

                <!-- ini nampilin profilepic sm usn -->
                <div class="user-list-item">
                    <img src="../uploads/<?= htmlspecialchars($row['profilepic'] ?? 'default.png'); ?>" alt="Profile Picture">
                    <div class="user-info">
                        <a href="main.php?page=profile&id=<?= $row['id'] ?>"><?= htmlspecialchars($row['username']) ?></a>
                    </div>

                    <!-- masuk kondisi kalo user lagi ga liat profile diri sendiri -->
                    <?php if ($logged_in_user && $logged_in_user != $row['id']): ?>
                        <div class="follow-button-wrapper">
                            <?php if (!is_following($logged_in_user, $row['id'])): ?>
                                <button class='follow-btn' data-user-id="<?= htmlspecialchars($row['id']) ?>"
                                    data-follow='1'>Follow</button>
                            <?php else: ?>
                                <button class='follow-btn' data-user-id="<?= htmlspecialchars($row['id']) ?>"
                                    data-follow='0'>Unfollow</button>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="color: #ccc; text-align: center; width: 100%;">No <?= htmlspecialchars($type) ?> found.</p>
        <?php endif; ?>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.getElementById('searchForm');
    const userListContainer = document.getElementById('userListContainer'); // div isi list foll

    if (searchForm && userListContainer) {
        searchForm.addEventListener('submit', async function(event) {
            event.preventDefault();

            const userId = searchForm.querySelector('input[name="user_id"]').value;
            const type = searchForm.querySelector('input[name="type"]').value;
            const searchQuery = searchForm.querySelector('input[name="search"]').value;

            const url = ../A_Controller/followers_controller.php?user_id=${encodeURIComponent(userId)}&type=${encodeURIComponent(type)}&search=${encodeURIComponent(searchQuery)}&ajax=1;

            try {
                const response = await fetch(url);

                if (!response.ok) {
                    console.error(`HTTP error! Status: ${response.status}`);
                    userListContainer.innerHTML = '<p style="color: red; text-align: center; width: 100%;">Server error. Please try again.</p>';
                    return; 
                }

                const htmlContent = await response.text();

                console.log("AJAX Response HTML:", htmlContent);

                userListContainer.innerHTML = htmlContent;

            } catch (error) {
                console.error('Error during search AJAX request:', error);
                userListContainer.innerHTML = '<p style="color: red; text-align: center; width: 100%;">Failed to load results. Please check your network connection.</p>';
            }
        });
    } else {
        console.warn("searchForm or userListContainer not found in the DOM.");
    }
});
</script>