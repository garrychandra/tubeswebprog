<?php
session_start(); // Perlu session di sini untuk memeriksa user_id yang sedang login
require_once '../A_Model/user_model.php';
require_once '../A_Model/config.php';

// Pastikan ini adalah permintaan POST (lebih aman untuk operasi penghapusan)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Invalid request method.";
    exit();
}

// Pastikan user sedang login
if (!isset($_SESSION['user_id'])) {
    echo "Not logged in.";
    exit();
}

// Ambil user_id dari data POST yang dikirim oleh JavaScript
$user_id_from_post = $_POST['user_id'] ?? null;

// Convert ke integer untuk keamanan
$user_id_from_post = (int)$user_id_from_post;
$logged_in_user_id = (int)$_SESSION['user_id'];

// Validasi tambahan: Pastikan user_id yang dikirim sama dengan user_id yang login
// Ini mencegah user menghapus akun orang lain secara tidak sengaja/sengaja
if ($user_id_from_post !== $logged_in_user_id) {
    echo "Unauthorized access: Mismatched user ID.";
    exit();
}

// Panggil fungsi model untuk menghapus user
$delete_success = delete_user($logged_in_user_id); // Gunakan $logged_in_user_id untuk memastikan user yang benar dihapus

if ($delete_success) {
    // Hancurkan sesi setelah akun berhasil dihapus
    session_destroy();
    // Berikan respons 'success' ke JavaScript
    echo "success";
} else {
    // Berikan respons 'failed' ke JavaScript jika penghapusan gagal
    echo "failed";
}
exit();
?>