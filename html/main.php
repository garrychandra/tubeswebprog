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
</head>

<body>
    <?php
    echo "DEBUG";
    include 'header.php';

    $page = $_GET['page'] ?? 'home';

    switch($page){
        case "members":
            include 'members.html';
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

        case "signup";
            include '';
        case "sign"


        default: 
            include 'home2.html';
    }

    include 'footer.html';
    ?>

    
</body>

</html>