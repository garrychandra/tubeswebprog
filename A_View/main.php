<?php
session_start();
require_once '../A_Model/config.php';
require_once '../A_Controller/language_controller.php';
$theme = $_COOKIE['theme'] ?? 'dark';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>

    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../css/home-main.css">
    <link rel="stylesheet" href="../css/responsive-navbar.css">
    <link rel="stylesheet" href="../css/responsive-home-main.css">
    <link rel="stylesheet" href="../css/forum1_revisi.css">
    <link rel="stylesheet" href="../css/authors.css">
    <link rel="stylesheet" href="../css/members.css">
    <link rel="stylesheet" href="../css/responsive_member.css">
    <link rel="stylesheet" href="../css/discography.css">
    <link rel="stylesheet" href="../css/responsive-discography.css">
    <link rel="stylesheet" href="../css/updates.css">
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="../css/followers_view.css">
    <link rel="stylesheet" href="css/isiforum.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <style>
        :root {
            --main-color: #1a1a1a;
        }

        body.light-theme {
            --main-color: #faf0dc;
        }

        body {
            color: white;
            background-color: var(--main-color);
        }


        .navbar {
            background-color: var(--main-color);
        }

        .alert {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            font-weight: bold;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert-info {
            background-color: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="js/deletepost.js"></script>
    <script src="js/editpost.js"></script>
    <script src="js/follow.js"></script>
    <script src="js/createforum.js"></script>
    <script src="js/commentpost.js"></script>
    <script src="../script/discography.js"></script>
    <script src="../A_View/js/download.js"></script>

</head>

<body class="<?= $theme === 'light' ? 'light-theme' : '' ?>">
    <?php
    include 'header.php';
    include 'navbar.php';
    $page = $_GET['page'] ?? 'home';

    switch ($page) {
        case "members":
            include 'members_view.html';
            break;
        case "discography";
            include 'discography_view.php';
            break;
        case "single":
            include 'discography_view.php';
            echo "<script>location.hash = '#card_1';</script>"; // Scroll to the element
            break;
        case "eps";
            include 'discography_view.php';
            echo "<script>location.hash = '#card_2';</script>"; // Scroll to the element
            break;
        case "author":
            include 'authors.php';
            break;
        case "albums":
            include 'discography_view.php';
            echo "<script>location.hash = '#card_3';</script>"; // Scroll to the element
            break;
        case "forum":
            include 'showforums.php';
            break;
        case "isiforum":
            include 'isiforum.php';
            break;
        case "updates":
            include 'updates_view.html';
            break;
        case "login";
            include 'login_view.php';
            break;
        case "signup1":
            include 'signup1_view.php';
            break;
        case "signup2":
            include 'signup2_view.php';
            break;
        case "profile";
            include '../A_Controller/profile_controller.php';
            include 'profile_view.php';
            break;
        case "edit_profile":
            include '../A_Controller/edit_controller.php';
            include 'edit_profile.php';
            break;
        case "followers":
            include 'followers_view.php';
            break;
        case "following";
            include 'followers_view.php';
            break;
        case "logout":
            include 'logout_view.php';
            break;
        case "admin";
            include 'admin_view.php';
            break;
        case "settings":
            include 'settings_view.php';
            break;
        case 'searchall';
            include 'search_view.php';
            break;
        default:
            include 'home_view.html';
    }

    include 'footer.html';
    ?>
</body>

</html>