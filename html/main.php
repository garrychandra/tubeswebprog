<?php
    session_start();

    if (isset($_SESSION['message'])) {
        echo '<div class="alert alert-' . $_SESSION['message_type'] . '">' . $_SESSION['message'] . '</div>';
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../css/home-main.css">
    <link rel="stylesheet" href="../css/responsive-navbar.css">
    <link rel="stylesheet" href="../css/responsive-home-main.css">
    <link rel="stylesheet" href="../css/forum1_revisi.css">
    
    <link rel="stylesheet" href="../css/members.css">
    <link rel="stylesheet" href="../css/responsive_member.css">
    
    
    <link rel="stylesheet" href="../css/discography.css">
    <link rel="stylesheet" href="../css/responsive-discography.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    
</head>

<body>
    <?php
    include 'header.php';

    $page = $_GET['page'] ?? 'home';

    switch($page){
        case "members":
            include 'members_view.html';
            break;
        case "discography";
            include 'discography.html';
        break;
        case "forum":
            include 'forum1_revisi.html';
        break;
        case "updates":
            include 'updates.html';
        break;
        case "login";
            include 'login_view.php';
        break;

        
        default: 
            include 'home_view.html';
    }

    include 'footer.html';
    ?>

    
</body>

</html>