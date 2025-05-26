<style>

    .c-btn {
        width: fit-content;
        padding: 0.5rem;
        background-color: none;
    }
</style>

<h2><?= ucfirst($type) ?> of <?= htmlspecialchars($user_data['username']) ?></h2>

<form action="../A_Controller/followers_controller.php" method="get">
    <input type="hidden" name="user_id" value="<?= $target_id ?>">
    <input type="hidden" name="type" value="<?= $type ?>">
    <input type="text" name="search" placeholder="Search username..." value="<?= htmlspecialchars($search) ?>">
    <button type="submit" class="c-btn">Search</button>
</form>

<ul>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <li>
            <img src="../uploads/<?= htmlspecialchars($row['profilepic']); ?>" alt="" width="40" height="40">
            <a href="main.php?page=profile&id=<?= $row['id'] ?>"><?= htmlspecialchars($row['username']) ?></a>

            <?php if ($logged_in_user && $logged_in_user != $row['id']): ?>
                <button 
                    class="follow-btn c-btn" 
                    data-user-id="<?= htmlspecialchars($row['id']) ?>" 
                    data-follow="<?= !is_following($logged_in_user, $row['id']) ? '1' : '0' ?>"
                >
                    <?= !is_following($logged_in_user, $row['id']) ? 'Follow' : 'Unfollow' ?>
                </button>
            <?php endif; ?>
        </li>
    <?php endwhile; ?>
</ul>