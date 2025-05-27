<?php
require_once '../A_Model/user_model.php';
require_once '../A_Model/config.php';

$is_ajax = isset($_GET['ajax']) && $_GET['ajax'] == '1'; // ngecek dari ajax bkn

$target_id = $_GET['user_id'] ?? null;
$type = $_GET['type'] ?? ''; // 'followers' atau 'following'
$search = $_GET['search'] ?? '';

// validasi dasar parameter URL
if (!isset($target_id) || !is_numeric($target_id) || empty($type) || ($type !== 'followers' && $type !== 'following')) {
    if ($is_ajax) {
        echo '<p style="color: red; text-align: center; width: 100%;">Invalid request parameters.</p>';
        exit();
    } else {
        header("Location: ../A_View/main.php?page=profile"); 
        exit();
    }
}

// get data user target
$user_data = get_user_by_id($target_id);
if (!$user_data) {
    if ($is_ajax) {
        echo '<p style="color: red; text-align: center; width: 100%;">User not found.</p>';
        exit();
    } else {
        header("Location: ../A_View/main.php?page=profile"); 
        exit();
    }
}

// manggil function
$result = null;
if ($type === 'followers') {
    $result = get_followers($target_id, $search);
} elseif ($type === 'following') {
    $result = get_following($target_id, $search);
} else {
    if ($is_ajax) {
        echo '<p style="color: red; text-align: center; width: 100%;">Invalid type specified.</p>';
        exit();
    } else {
        header("Location: ../A_View/main.php?page=profile");
        exit();
    }
}

if ($result === false) {
    echo '<p style="color: red; text-align: center; width: 100%;">An internal error occurred while fetching ' . htmlspecialchars($type) . '.</p>';
    exit();
}

if($is_ajax){
    ob_start();

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $logged_in_user = $_SESSION['user_id'] ?? null;
            ?>
            <div class="user-list-item">
                <img src="../uploads/<?= htmlspecialchars($row['profilepic'] ?? 'default.png'); ?>" alt="Profile Picture">
                <div class="user-info">
                    <a href="main.php?page=profile&id=<?= $row['id'] ?>"><?= htmlspecialchars($row['username']) ?></a>
                </div>

                <?php if ($logged_in_user && $logged_in_user != $row['id']): ?>
                    <div class="follow-button-wrapper">
                        <?php if (!is_following($logged_in_user, $row['id'])): ?>
                            <button class='follow-btn' data-user-id="<?= htmlspecialchars($row['id']) ?>" data-follow='1'>Follow</button>
                        <?php else: ?>
                            <button class='follow-btn' data-user-id="<?= htmlspecialchars($row['id']) ?>" data-follow='0'>Unfollow</button>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php
        }
    } else {
        echo '<p style="color: #ccc; text-align: center; width: 100%;">No ' . htmlspecialchars($type) . ' found for "' . htmlspecialchars($search) . '".</p>';
    }

    mysqli_free_result($result);

    $html_content = ob_get_clean();

    // send HTML ke browser sebagai respons AJAX
    echo $html_content;
    exit(); // stop eksekusi script setelah mengirim respons AJAX
}
?>