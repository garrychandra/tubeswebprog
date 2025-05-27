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
<form action="../back/changePass.php" method="POST">
    <label>Current Password:</label><br>
    <input type="password" name="curr_password"><br><br>

    <label>New Password:</label><br>
    <input type="password" name="new_password"><br><br>

    <button type="submit" name="change-btn">Change Password</button>
</form>

<?php if(file_exists("../A_Controller/language_controller.php")): ?>
    <?= "Say Yes";?>
<?php endif; ?>

<?php
$current_lang = $_COOKIE['lang'] ?? 'en';
?>
<p><?= $lang_data->welcome ?></p>
<form method="get" action="../A_Controller/language_controller.php">
    <label>Select Language:</label><br>
    <select name="lang">
        <option value="en" <?= $current_lang === 'en' ? 'selected' : '' ?>>English</option>
        <option value="zh" <?= $current_lang === 'zh' ? 'selected' : '' ?>>中文</option>
    </select>
    <button type="submit">Change</button>
</form>

<!-- Theme Preference -->
<form method="get" action="../A_Controller/theme_controller.php">
    <label>Select Theme:</label><br>
    <select name="theme">
        <option value="dark">Dark</option>
        <option value="light">Light</option>
    </select>
    <button type="submit">Change Theme</button>
</form>
