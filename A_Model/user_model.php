<?php
require 'config.php';

function escape($input)
{
    global $con;
    return mysqli_real_escape_string($con, $input);
}

// SIGN IN
function get_user_by_email_password($email_or_username, $password)
{
    global $con;
    $input = escape($email_or_username);
    $password = escape($password);

    $sql = "SELECT * FROM user WHERE (email = '$input' OR username = '$input') AND password = '$password'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) === 1) {
        return mysqli_fetch_assoc($result);
    }
    return false;
}

// SIGN UP
function insert_user($email, $password, $username, $profilepic, $role)
{
    global $con;
    $email = escape($email);
    $password = escape($password);
    $username = escape($username);
    $profilepic = escape($profilepic);
    $role = escape($role);

    $sql = "INSERT INTO user (email, password, username, profilepic, role)
            VALUES ('$email', '$password', '$username', '$profilepic', '$role')";

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

// Profile
function get_user_by_id($id)
{
    global $con;
    $id = (int)($id);
    $sql = "SELECT * FROM user WHERE id = $id";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_assoc($result);
}

// Followers count
function get_followers_count($id)
{
    global $con;
    $id = (int)$id;
    $sql = "SELECT COUNT(*) as total FROM follow WHERE id_follow = $id";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_assoc($result)['total'];
}

// Following count
function get_following_count($id)
{
    global $con;
    $id = (int)$id;
    $sql = "SELECT COUNT(*) as total FROM follow WHERE user_id = $id";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_assoc($result)['total'];
}

// Edit Profile
function update_user_profile($id, $username, $profilepic, $role){
    global $con;
    $id = (int)$id;
    $username = escape($username);
    $profilepic = escape($profilepic);
    $role = escape($role);

    $sql = "UPDATE user SET username='$username', profilepic='$profilepic', role='$role' WHERE id=$id";
    return mysqli_query($con, $sql);
}

// Check if following
function is_following($user_id, $id_follow)
{
    global $con;
    $user_id = (int)$user_id;
    $id_follow = (int)$id_follow;
    $sql = "SELECT 1 FROM follow WHERE user_id = $user_id AND id_follow = $id_follow";
    $check = mysqli_query($con, $sql);
    return mysqli_num_rows($check) > 0;
}

// Get followers
function get_followers($user_id){
    global $con;
    $user_id = (int)$user_id;
    $sql = "
    SELECT u.id, u.username, u.profilepic FROM follow AS f
    JOIN user AS u ON f.user_id = u.id
    WHERE f.id_follow = $user_id";
    return mysqli_query($con, $sql);
}

// Get following
function get_following($user_id){
    global $con;
    $user_id = (int)$user_id;
    $sql = "
    SELECT u.id, u.username, u.profilepic FROM follow AS f
    JOIN user AS u ON f.id_follow = u.id
    WHERE f.user_id = $user_id";
    return mysqli_query($con, $sql);
}
