<nav class="navbar">
    <ul>
        <li><a href="main.php?page=home"><?= $lang_data->nav->home ?></a></li>
        <li><a href="main.php?page=members"><?= $lang_data->nav->members ?></a></li>
        <li id="discography">
            <a href="main.php?page=discography"><?= $lang_data->nav->discography ?></a>
            <div id="discography-dropdown-content">
                <a href="main.php?page=single"><?= $lang_data->nav->singles ?></a>
                <a href="main.php?page=eps"><?= $lang_data->nav->eps ?></a>
                <a href="main.php?page=albums"><?= $lang_data->nav->albums ?></a>
            </div>
        </li>

        <?php if (!empty($_SESSION['user_id'])): ?>
            <li><a href="main.php?page=forum"><?= $lang_data->nav->forum ?></a></li>

            <?php if (!empty($_SESSION['is_admin'])): ?>
                <li><a href="main.php?page=admin"><?= $lang_data->nav->admin ?></a></li>    
            <?php endif; ?>

            <li><a href="main.php?page=profile"><?= $lang_data->nav->profile ?></a></li>
            <li><a href="main.php?page=logout"><?= $lang_data->nav->logout ?></a></li>

        <?php else: ?>
            <li><a href="main.php?page=updates"><?= $lang_data->nav->updates ?></a></li>
            <li><a href="main.php?page=login"><?= $lang_data->nav->login ?></a></li>
        <?php endif; ?>
    </ul>
</nav>
