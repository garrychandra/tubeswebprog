<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_logout'])) {
    session_unset();
    session_destroy();
    header("Location: ../A_View/main.php?page=login&logout=1");
    exit;
} else {
    // If accessed directly without confirmation, redirect to profile
    header("Location: ../front/main.php?page=profile");
    exit;
}
