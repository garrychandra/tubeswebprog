
<nav>
    <ul>
        <li><a href="main.php?page=home">HOME</a></li>
        <li><a href="main.php?page=members">MEMBERS</a></li>
        <li id="discography"><a href="main.php?page=discography">DISCOGRAPHY</a>
            <div id="discography-dropdown-content">
                <a href="main.php?page=single">Singles</a>
                <a href="main.php?page=eps">EPs</a>
                <a href="main.php?page=albums">Albums</a>
            </div>
        </li>

        <?php if (!empty($_SESSION['user_id'])): ?>
            <li><a href="main.php?page=forum">FORUM</a></li>
        <?php endif; ?>

        <li><a href="main.php?page=updates">UPDATES</a></li>
        
        <?php if(empty($_SESSION['user_id'])): ?>
        <li><a href="main.php?page=login">LOGIN</a></li>
        <?php else: ?>
        <li><a href="main.php?page=logout">LOGOUT</a></li>
        <?php endif; ?>

        <?php if (!empty($_SESSION['user_id'])): ?>
            <?php if ($_SESSION['is_admin'] == 'admin'): ?>
                <li><a href="">ADMIN</a></li>    
            <?php endif; ?>
            <li><a href="main.php?page=profile">PROFILE</a></li>
        <?php endif; ?>
        
    </ul>
</nav>