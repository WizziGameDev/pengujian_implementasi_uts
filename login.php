<?php
session_start();
require 'db.php';

$email = $_POST['email'];
$password = $_POST['password'];

// Query check user email
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// Log activity
function log_activity($message) {
    error_log($message, 3, 'login_activity.log'); // Menulis log ke file 'login_activity.log'
}

if ($user) {
    $password_verified = password_verify($password, $user['password']) ? 'true' : 'false';
    log_activity("Login attempt: " . $email . " pass Hash " . $password_verified . " Dengan DB pass: " . $user['password'] . " role: " . $user['role'] . "\n");

    // Verifikasi password
    if (password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;

        // Log login sukses
        log_activity("Login sukses: " . $email . " pada " . date("Y-m-d H:i:s") . "\n");

        // Redirect berdasarkan role
        if ($user['role'] === 'admin') {
            header("Location: book_read.php");
        } else {
            header("Location: book_read.php");
        }
    } else {
        // Log login gagal
        log_activity("Login gagal: " . $email . " pada " . date("Y-m-d H:i:s") . "\n");
        echo "Login gagal. <a href='index.php'>Kembali</a>";
    }
} else {
    // Log jika email tidak ditemukan
    log_activity("Login gagal: Email tidak ditemukan untuk " . $email . " pada " . date("Y-m-d H:i:s") . "\n");
    echo "Login gagal. <a href='index.php'>Kembali</a>";
}
?>
