<?php
include_once '../A_Model/config.php';

if (isset($_POST['unban_id'])) {
    $uid = intval($_POST['unban_id']);
    $con->query("UPDATE user SET role='member' WHERE id=$uid");
    // Optional: Redirect back to admin_view.php
    header("Location: ../A_View/main.php?page=admin");
    exit;
}
?>