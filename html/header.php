<div id="header">
    <img src="../images/w2e_bg_image.jpg" id="gambarHome">
    <div id="textOverImage">
        <h1>Wave to Earth</h1>
    </div>
</div>

<div id="stickyHeader">
    <h1>Wave to Earth</h1>
</div>

<nav>
    <ul>
        <li><a href="main.php?page=home">HOME</a></li>
        <li><a href="main.php?page=members">MEMBERS</a></li>
        <li id="discography"><a href="main.php?page=discography">DISCOGRAPHY</a>
            <div id="discography-dropdown-content">
                <a href="main.php?page=singles">Singles</a>
                <a href="main.php?page=eps">EPs</a>
                <a href="main.php?page=albums">Albums</a>
            </div>
        </li>

        <?php if (!empty($_SESSION['user_id'])): ?>
            <li><a href="main.php?page=forum">FORUM</a></li>
        <?php endif; ?>

        <li><a href="main.php?page=updates">UPDATES</a></li>
        
        <li><a href="main.php?page=login">LOGIN</a></li>


        <?php if (!empty($_SESSION['user_id'])): ?>
            <?php if ($_SESSION['is_admin']): ?>
                <li><a href="">ADMIN</a></li>    
            <?php endif; ?>
            <li><a href="">PROFILE</a></li>
        <?php endif; ?>
        
    </ul>
</nav>