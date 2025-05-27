<?php
require 'config.php';

function escape($input)
{
    global $con;
    return mysqli_real_escape_string($con, $input);
}

//SIGN IN
function get_user_by_email_password($login, $password)
{
    global $con;
    $login = escape($login);
    $password = escape($password);

    // Check both email and username fields
    $sql = "SELECT * FROM user WHERE (email = '$login' OR username = '$login') AND password = '$password'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) === 1) {
        return mysqli_fetch_assoc($result);
    }
    return false;
}

//SIGN UP
function insert_user($email, $password, $username, $profilepic, $bio)
{

    global $con;
    $email = escape($email);
    $password = escape($password);
    $username = escape($username);
    $profilepic = escape($profilepic);
    $bio = escape($bio);

    $sql = "INSERT INTO user (email, password, username, profilepic, bio)
        VALUES ('$email', '$password', '$username', '$profilepic', '$bio')";

    return mysqli_query($con, $sql);
}

function get_user_by_email($login)
{
    global $con;
    $login = escape($login);
    $sql = "SELECT * FROM user WHERE (email = '$login' OR username = '$login')";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_assoc($result);
}

//Profile
function get_user_by_id($id)
{
    global $con;
    $id = (int)($id);
    $sql = "SELECT * FROM user WHERE id = $id";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_assoc($result);
}

function get_followers_count($id)
{
    global $con;
    $id = (int)$id;
    $sql = "SELECT COUNT(*) as total FROM follow WHERE id_follow = $id";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_assoc($result)['total'];
}

function get_following_count($id)
{
    global $con;
    $id = (int)$id;
    $sql = "SELECT COUNT(*) as total FROM follow WHERE user_id = $id";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_assoc($result)['total'];
}

// nambah relasi follow
function add_follow($user_id, $id_follow)
{
    global $con;
    if (is_following($user_id, $id_follow)) {
        return true;
    }

    $stmt = mysqli_prepare($con, "INSERT INTO follow (user_id, id_follow) VALUES (?, ?)");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ii", $user_id, $id_follow);
        $success = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $success;
    }
    return false;
}

// remove relasi follow
function remove_follow($user_id, $id_follow)
{
    global $con;
    $stmt = mysqli_prepare($con, "DELETE FROM follow WHERE user_id = ? AND id_follow = ?");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ii", $user_id, $id_follow);
        $success = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $success;
    }
    return false;
}

//Edit Profile

function update_user_profile($id, $username, $bio, $profilepic)
{
    global $con;
    $id = (int)$id;
    $username = escape($username);
    $bio = escape($bio);
    $profilepic = escape($profilepic);

    if ($profilepic !== null) {
        $sql = "UPDATE user SET username='$username', bio='$bio', profilepic='$profilepic' WHERE id=$id";
    } else {
        $sql = "UPDATE user SET username='$username', bio='$bio' WHERE id=$id"; // Tambahkan WHERE id=$id di sini juga
    }

    return mysqli_query($con, $sql);
}

// nyimpen token "remember me" ke database
function update_user_remember_token($user_id, $token)
{
    global $con;
    // Token akan berlaku selama 30 hari di database
    $expires_at = date('Y-m-d H:i:s', time() + 3600);

    $stmt = mysqli_prepare($con, "UPDATE user SET remember_token = ?, remember_token_expires = ? WHERE id = ?");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssi", $token, $expires_at, $user_id);
        $success = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $success;
    }
    return false;
}

// ngambil data user berdasarkan token "remember me" dari database
function get_user_by_remember_token($token)
{
    global $con;
    $stmt = mysqli_prepare($con, "SELECT id, username, is_admin, remember_token_expires FROM user WHERE remember_token = ?");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $token);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);

        // Cek apakah token ada dan belum kedaluwarsa
        if ($user && strtotime($user['remember_token_expires']) > time()) {
            return $user;
        }
    }
    return false;
}

// hapus token "remember me" dari database (logout)
function clear_user_remember_token($user_id)
{
    global $con;
    $stmt = mysqli_prepare($con, "UPDATE user SET remember_token = NULL, remember_token_expires = NULL WHERE id = ?");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        $success = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $success;
    }
    return false;
}

// User and Followers
function is_following($user_id, $id_follow)
{
    global $con;
    $stmt = mysqli_prepare($con, "SELECT 1 FROM follow WHERE user_id = ? AND id_follow = ?");
    if ($stmt === false) {
        error_log("Prepare failed: " . mysqli_error($con)); // Untuk debugging internal
        return false;
    }
    mysqli_stmt_bind_param($stmt, "ii", $user_id, $id_follow); // "ii" berarti dua integer
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $num_rows = mysqli_stmt_num_rows($stmt);
    mysqli_stmt_close($stmt);
    return $num_rows > 0;
}

//Follow
function get_followers($user_id, $search = ''){
    global $con;
    $user_id = (int)$user_id;

    $sql = "SELECT u.id, u.username, u.profilepic FROM follow AS f JOIN user AS u ON f.user_id = u.id WHERE f.id_follow = ?";
    $params = "i"; // Parameter untuk user_id

    if ($search) {
        $sql .= " AND u.username LIKE ?";
        $params .= "s"; // "s" untuk string
        $search_param = '%' . $search . '%'; // Tambahkan wildcard
    }

    $stmt = mysqli_prepare($con, $sql);

    if ($stmt === false) { // Penanganan error jika prepare gagal
        error_log("Error preparing statement for get_followers: " . mysqli_error($con));
        return false; // Mengembalikan false atau array kosong sebagai indikasi error
    }

    if ($search) {
        mysqli_stmt_bind_param($stmt, $params, $user_id, $search_param);
    } else {
        mysqli_stmt_bind_param($stmt, $params, $user_id);
    }

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt); // Ini akan mengembalikan mysqli_result object
    // Tidak perlu mysqli_stmt_close($stmt) di sini, biarkan pemanggil menutup jika perlu,
    // atau biarkan PHP membersihkannya setelah script selesai.
    return $result;
}

function get_following($user_id, $search = ''){
    global $con;
    $user_id = (int)$user_id;

    $sql = "SELECT u.id, u.username, u.profilepic FROM follow AS f JOIN user AS u ON f.id_follow = u.id WHERE f.user_id = ?";
    $params = "i";

    if ($search) {
        $sql .= " AND u.username LIKE ?";
        $params .= "s";
        $search_param = '%' . $search . '%';
    }

    $stmt = mysqli_prepare($con, $sql);

    if ($stmt === false) { // Penanganan error jika prepare gagal
        error_log("Error preparing statement for get_following: " . mysqli_error($con));
        return false; // Mengembalikan false atau array kosong sebagai indikasi error
    }

    if ($search) {
        mysqli_stmt_bind_param($stmt, $params, $user_id, $search_param);
    } else {
        mysqli_stmt_bind_param($stmt, $params, $user_id);
    }

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt); // Ini akan mengembalikan mysqli_result object
    return $result;
} 

function loadDiscography()
{
    $xml = simplexml_load_file('../xml/discography.xml');
    if ($xml === false) {
        die('Failed to load XML file');
    }
    return $xml;
}



// Search 
function search_users($term)
{
    global $con;
    $term = escape($term);
    if ($term !== '') {
        $sql = "SELECT id, username, profilepic, role FROM user WHERE username LIKE '%$term%' LIMIT 5";
    } else {
        $sql = "SELECT id, username, profilepic, role FROM user WHERE role = 'admin' LIMIT 5";
    }
    return mysqli_query($con, $sql);
}

// hapus akun
function delete_user($user_id) {
    global $con; // Pastikan $con tersedia di sini

    if (!isset($con) || !is_object($con) || !mysqli_ping($con)) {
        error_log("Koneksi database tidak valid di delete_user()");
        return false;
    }

    $user_id = (int)$user_id;

    // Mulai transaksi (tetap bagus untuk praktik terbaik, meskipun hanya satu DELETE)
    mysqli_begin_transaction($con);

    try {
        // Dapatkan nama file profil picture sebelum menghapus user
        $profilepic_name = null;
        $stmt_pic = mysqli_prepare($con, "SELECT profilepic FROM user WHERE id = ?");
        if ($stmt_pic === false) throw new Exception("Prepare failed for profilepic select: " . mysqli_error($con));
        mysqli_stmt_bind_param($stmt_pic, "i", $user_id);
        mysqli_stmt_execute($stmt_pic);
        mysqli_stmt_bind_result($stmt_pic, $profilepic_name_from_db);
        mysqli_stmt_fetch($stmt_pic);
        mysqli_stmt_close($stmt_pic);
        $profilepic_name = $profilepic_name_from_db;

        // Hapus user dari tabel 'user'
        $stmt = mysqli_prepare($con, "DELETE FROM user WHERE id = ?");
        if ($stmt === false) throw new Exception("Prepare failed for user delete: " . mysqli_error($con));
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $deleted_rows = mysqli_stmt_affected_rows($stmt);
        mysqli_stmt_close($stmt);

        // Jika user berhasil dihapus dari tabel user dan memiliki gambar profil non-default, hapus file gambar
        if ($deleted_rows > 0 && $profilepic_name && $profilepic_name !== 'default.png') {
            $file_path = '../uploads/' . $profilepic_name; // Pastikan path ini benar!
            if (file_exists($file_path)) {
                unlink($file_path);
                error_log("Profile picture deleted: " . $file_path); // Untuk debugging
            } else {
                error_log("Profile picture not found for deletion: " . $file_path);
            }
        }

        // Commit transaksi jika semua operasi berhasil
        mysqli_commit($con);
        return true; // Berhasil dihapus
    } catch (Exception $e) {
        // Rollback transaksi jika ada operasi yang gagal
        mysqli_rollback($con);
        error_log("Error deleting user " . $user_id . ": " . $e->getMessage()); // Log error ke log server
        return false; // Gagal dihapus
    }
}


function render_discography_comments($forum_name, $con) {
    $forum_q = mysqli_query($con, "SELECT forum_id FROM forum WHERE name='" . mysqli_real_escape_string($con, $forum_name) . "'");
    $forum_row = mysqli_fetch_assoc($forum_q);
    $forum_id = $forum_row ? $forum_row['forum_id'] : null;

    if ($forum_id) {
        echo "<div style='display: flex; flex-direction: column; align-items: center; width: 100%;'>";
        // Fetch comments
        $comments = mysqli_query($con, "SELECT fp.*, u.username FROM forum_posting fp JOIN user u ON fp.user_id = u.id WHERE fp.forum_id = $forum_id AND u.role NOT LIKE 'banned' ORDER BY fp.date_posted ASC");
        echo "<div class='album-comments' id='comments-{$forum_id}'>";
        echo "<h2>" . htmlspecialchars($forum_name) . "</h2>";
        while ($c = mysqli_fetch_assoc($comments)) {
            echo "<div class='comment'><b>" . htmlspecialchars($c['username']) . ":</b> " . htmlspecialchars($c['content']) . "</div>";
        }
        echo "</div>";
        
        // AJAX Comment form
        if (isset($_SESSION['user_id'])) {
            echo "<form class='comment-form' data-forum-id='{$forum_id}'>";
            echo "<input type='text' name='content' required style='background-color:white;'>";
            echo "<button type='submit'>Comment</button>";
            echo "</form>";
        }
        echo "</div>";
    } else {
        echo "<div class='album-comments'>No comment forum found for this item.</div>";
    }
}

function loadAuthors() {
    $xml = simplexml_load_file('../xml/authors.xml');
    if ($xml === false) {
        die('Failed to load authors XML file');
    }
    return $xml;
}
?>