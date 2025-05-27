<?php
if (isset($_GET['theme'])) {
    $theme = $_GET['theme'];
    setcookie('theme', $theme, time() + 86400 * 30, '/'); // 30 days
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}