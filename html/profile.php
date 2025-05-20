<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../css/forum3.css">
    <link rel="stylesheet" href="../css/responsive-navbar.css">
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">
</head>

<body>
    <?php
    include_once '../php/profile.php';
    ?>

    <div class="profile-container">
        <div class="profile-header">
            <img src="<?php echo $profilepic; ?>" alt="Profile Picture" class="profile-pic">
            <div class="profile-info">
                <h2>@<?php echo htmlspecialchars($username); ?></h2>
                <div class="stats">
                    <span><strong><?php echo $posts; ?></strong> Posts</span>
                    <span><strong><?php echo $followers; ?></strong> Followers</span>
                    <span><strong><?php echo $following; ?></strong> Following</span>
                </div>
                <p class="bio"><?php echo htmlspecialchars($bio ?? ""); ?></p>
                <a href="edit_profile.php" class="edit-button">Edit Profile</a>
            </div>
        </div>

        <div class="gallery">
            <?php
            $count = 0;
            while ($row = mysqli_fetch_array($resAttachments)) {
                echo "<div class='gallery-item'><img src='{$row[0]}'></div>";
            }
            ?>
        </div>
    </div>

</body>

</html>