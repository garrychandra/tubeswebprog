<?php
require 'config.php';

function escape($input)
{
    global $con;
    return mysqli_real_escape_string($con, $input);
}

//SIGN IN
function get_user_by_email_password($email, $password)
{
    global $con;
    $email = escape($email);
    $password = escape($password);

    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) === 1) {
        return mysqli_fetch_assoc($result);
    }
    return false;
}

//SIGN UP
function insert_user($email, $password, $username, $profile_pic, $bio)
{

    global $con;
    $email = escape($email);
    $password = escape($password);
    $username = escape($username);
    $profile_pic = escape($profile_pic);
    $bio = escape($bio);

    $sql = "INSERT INTO users (email, password, username, profile_pic, bio)
    VALUES ('$email', '$password', '$username', '$profile_pic', '$bio')";

    return mysqli_query($con, $sql);
}

function get_user_by_email($email)
{
    global $con;
    $email = escape($email);
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_assoc($result);
}

//Profile
function get_user_by_id($id)
{
    global $con;
    $id = (int)($id);
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_assoc($result);
}

function get_followers_count($id)
{
    global $con;
    $id = (int)$id;
    $sql = "SELECT COUNT(*) as total FROM follows WHERE followed_id = $id";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_assoc($result)['total'];
}

function get_following_count($id)
{
    global $con;
    $id = (int)$id;
    $sql = "SELECT COUNT(*) as total FROM follows WHERE follower_id = $id";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_assoc($result)['total'];
}

//Edit Profile

function update_user_profile($id, $username, $bio, $profile_pic){
    global $con;
    $id = (int)$id;
    $username = escape($username);
    $bio = escape($bio);
    $profile_pic = escape($profile_pic);

    if ($profile_pic !== null) {
        $profile_pic = escape($profile_pic);
        $sql = "UPDATE users SET username='$username', bio='$bio', profile_pic='$profile_pic' WHERE id=$id";
    } else {
        $sql = "UPDATE users SET username='$username', bio='$bio'";
    }

    return mysqli_query($con, $sql);
}

// User and Followers
function is_following($follower_id, $followed_id)
{
    global $con;
    $sql = "SELECT 1 FROM follows WHERE follower_id = $follower_id AND followed_id= $followed_id";
    $check = mysqli_query($con, $sql);
    return mysqli_num_rows($check) > 0;
}

//Follow
function get_followers($user_id, $search = ''){
    global $con;
    $user_id = (int)$user_id;

    $search_sql = $search ? " AND users.username LIKE '%". escape($search). "%'" : '';
    $sql = "
    SELECT u.id, u.username, u.profile_pic FROM follows AS f
    JOIN users AS u ON f.follower_id = u.id
    WHERE f.followed_id = $user_id $search_sql";
    return mysqli_query($con, $sql);
}

function get_following($user_id, $search = ''){
    global $con;
    $user_id = (int)$user_id;
    $search_sql = $search ? " AND u.username LIKE '%" .escape($search) . "%'" : '';
    $sql = "
    SELECT u.id, u.username, u.profile_pic FROM follows AS f
    JOIN users AS u ON f.followed_id = u.id
    WHERE f.follower_id = $user_id $search_sql";
    return mysqli_query($con, $sql);
}
