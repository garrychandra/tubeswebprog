<h2>Settings</h2>

<?php
$errors = $_SESSION['errors'] ?? [];
$success = $_SESSION['success'] ?? null;
unset($_SESSION['errors'], $_SESSION['success']);
?>

<?php if (!empty($errors)): ?>
    <div style="color: red;">
        <?php foreach ($errors as $err): ?>
            <p><?= htmlspecialchars($err) ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php if ($success): ?>
    <div style="color: green;">
        <?= htmlspecialchars($success) ?>
    </div>
<?php endif; ?>

<h2>Change Password</h2>
<form action="../A_Controller/changePass.php" method="POST">
    <label>Current Password:</label><br>
    <input type="password" name="curr_password"><br><br>
    <label>New Password:</label><br>
    <input type="password" name="new_password"><br><br>
</form>


<?php
$current_lang = $_COOKIE['lang'] ?? 'en';
?>
<p><?= $lang_data->welcome ?></p>

<form method="get" action="../A_Controller/language_controller.php">
    <label>Select Language:</label><br>
    <select name="lang">
        <option value="en" <?= $current_lang === 'en' ? 'selected' : '' ?>>English</option>
        <option value="id" <?= $current_lang === 'id' ? 'selected' : '' ?>>Indonesia</option>
        <option value="zh" <?= $current_lang === 'zh' ? 'selected' : '' ?>>中文</option>
        <option value="kr" <?= $current_lang === 'kr' ? 'selected' : '' ?>>Korea</option>
        <option value="jp" <?= $current_lang === 'jp' ? 'selected' : '' ?>>Japan</option>
    </select>
    <br><br>
    <button type="submit">Change Language</button>
</form>


<?php $theme = $_COOKIE['theme'] ?? 'dark'; ?>
<form method="get" action="../A_Controller/theme_controller.php">
    <label>Select Theme:</label><br>
    <select name="theme">
        <option value="dark" <?= $theme === 'dark' ? 'selected' : '' ?>>Dark</option>
        <option value="light" <?= $theme === 'light' ? 'selected' : '' ?>>Light</option>
    </select>
    <button type="submit">Change Theme</button>
</form>

<div class="download-section">
    <h2>Download Your Data</h2>
    <form class="downloadform" method="post">
        <button type="submit" class="download-btn">Generate Download</button>
    </form>
    <div id="downloadLink" style="display:none;"></div>
</div>
