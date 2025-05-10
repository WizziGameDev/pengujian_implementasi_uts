<?php
require 'db.php';
session_start();

$message = '';
$success = false;

// Cek apakah user adalah admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    $message = "Akses ditolak. Hanya admin yang dapat menghapus buku.";
} elseif (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $message = "ID buku tidak valid.";
} else {
    $id = (int) $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM books WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $success = true;
        $message = "Buku berhasil dihapus.";
    } else {
        $message = "Gagal menghapus buku: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hapus Buku</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <script>
        Swal.fire({
            icon: '<?= $success ? "success" : "error" ?>',
            title: '<?= $success ? "Berhasil" : "Gagal" ?>',
            text: '<?= addslashes($message) ?>',
            showConfirmButton: false,
            timer: 2000
        }).then(() => {
            window.location.href = 'book_read.php';
        });
    </script>
</body>
</html>
