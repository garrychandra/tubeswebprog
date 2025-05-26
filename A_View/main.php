<?php
    require_once '../A_Model/config.php';
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
    <link rel="stylesheet" href="css/isiforum.css">

    <link rel="stylesheet" href="../css/members.css">
    <link rel="stylesheet" href="../css/responsive_member.css">

    <link rel="stylesheet" href="../css/discography.css">
    <link rel="stylesheet" href="../css/responsive-discography.css">

    <link rel="stylesheet" href="../css/updates.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <style>
        body {
            color: white;
            background-color: #1a1a1a;
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
                include 'forum1_revisi.html';
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