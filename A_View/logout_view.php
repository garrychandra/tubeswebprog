<?php require '../A_Model/user_model.php'; ?>
<?php session_start(); ?>

<h2>Are you sure you want to log out?</h2>

<form action="../A_Controller/logout_controller.php" method="POST">
    <button type="submit" name="confirm_logout">Yes, log me out</button>
</form>

<form action="main.php?page=profile" method="GET">
    <button type="submit">Cancel</button>
</form>
