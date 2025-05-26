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

    function get_user_by_email($email)
    {
        global $con;
        $email = escape($email);
        $sql = "SELECT * FROM user WHERE email = '$email'";
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
    function add_follow($user_id, $id_follow) {
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
    function remove_follow($user_id, $id_follow) {
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

    function update_user_profile($id, $username, $bio, $profilepic){
        global $con;
        $id = (int)$id;
        $username = escape($username);
        $bio = escape($bio);
        $profilepic = escape($profilepic);

        if ($profilepic !== null) {
            $profilepic = escape($profilepic);
            $sql = "UPDATE user SET username='$username', bio='$bio', profilepic='$profilepic' WHERE id=$id";
        } else {
            $sql = "UPDATE user SET username='$username', bio='$bio'";
        }

        return mysqli_query($con, $sql);
    }

    // nyimpen token "remember me" ke database
    function update_user_remember_token($user_id, $token) {
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
    function get_user_by_remember_token($token) {
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
    function clear_user_remember_token($user_id) {
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
        $sql = "SELECT 1 FROM follow WHERE user_id = $user_id AND id_follow= $id_follow";
        $check = mysqli_query($con, $sql);
        return mysqli_num_rows($check) > 0;
    }

    //Follow
    function get_followers($user_id, $search = ''){
        global $con;
        $user_id = (int)$user_id;

        $search_sql = $search ? " AND u.username LIKE '%". escape($search). "%'" : '';
        $sql = "
        SELECT u.id, u.username, u.profilepic FROM follow AS f
        JOIN user AS u ON f.user_id = u.id
        WHERE f.id_follow = $user_id $search_sql";
        return mysqli_query($con, $sql);
    }

    function get_following($user_id, $search = ''){
        global $con;
        $user_id = (int)$user_id;
        $search_sql = $search ? " AND u.username LIKE '%" .escape($search) . "%'" : '';
        $sql = "
        SELECT u.id, u.username, u.profilepic FROM follow AS f
        JOIN user AS u ON f.id_follow = u.id
        WHERE f.user_id = $user_id $search_sql";
        return mysqli_query($con, $sql);
    }

    function loadDiscography() {
        $xml = simplexml_load_file('../xml/discography.xml');
        if ($xml === false) {
            die('Failed to load XML file');
        }
        return $xml;
    }

?>