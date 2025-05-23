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
            <img src="../uploads/<?= htmlspecialchars($row['profile_pic']); ?>" alt="" width="40" height="40">
            <a href="main.php?page=profile&user_id=<?= $row['id'] ?>"><?= htmlspecialchars($row['username']) ?></a>

            <?php if ($logged_in_user && $logged_in_user != $row['id']): ?>
                <?php if (!is_following($logged_in_user, $row['id'])): ?>
                    <form action="../A_Controller/follow_cont.php" method="POST" style="display: inline;">
                        <input type="hidden" name="follow_id" value="<?= $row['id'] ?>">
                        <button type="submit" class="c-btn">Follow</button>
                    </form>
                <?php else: ?>
                    <form action="../A_Controller/unfollow_cont.php" method="POST" style="display: inline;">
                        <input type="hidden" name="unfollow_id" value="<?= $row['id'] ?>">
                        <button type="submit" class="c-btn">Unfollow</button>
                    </form>
                <?php endif; ?>
            <?php endif; ?>
        </li>
    <?php endwhile; ?>
</ul>