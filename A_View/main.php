<?php
session_start();
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

    <link rel="stylesheet" href="../css/updates.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <style>
        html {
            color: white;
        }
    </style>
</head>

<body>
    <?php
    include 'header.php';
    include 'navbar.php';
    $page = $_GET['page'] ?? 'home';

    switch ($page) {
        case "members":
            include 'members_view.html';
            break;
        case "discography";
            include 'discography_view.html';
            break;
        case "single":
            include 'discography_view.html';
            echo "<script>location.hash = '#card_1';</script>"; // Scroll to the element
            break;
        case "eps";
            include 'discography_view.html';
            echo "<script>location.hash = '#card_2';</script>"; // Scroll to the element
            break;
        case "albums":
            include 'discography_view.html';
            echo "<script>location.hash = '#card_3';</script>"; // Scroll to the element
            break;
        case "forum":
            include 'showforums.php';
            break;
        case "updates":
            include 'updates_view.html';
            break;
        case "login";
            include 'login_view.php';
            break;
        case "isiForum":
            include 'isiForum.php';
            break;
        case "signup1":
            include 'signup1_view.php';
            break;
        case "signup2":
            include 'signup2_view.php';
            break;
        case "profile";
            include 'profile_view.php';
            break;
        case "edit_profile":
            include 'edit_view.php';
            break;
        case "followers";
            include '../A_Controller/followers_controller.php';
            break;
            case "following";
            include '../A_Controller/followers_controller.php';
            break;
        default:
            include 'home_view.html';
    }

    include 'footer.html';
    ?>
</body>
</html>