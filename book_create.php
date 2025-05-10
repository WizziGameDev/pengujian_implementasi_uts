<?php
require 'db.php';
session_start();

// Cek apakah user adalah admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    echo "<script>alert('Akses ditolak. Hanya admin yang dapat menambah buku.'); window.location.href='book_read.php';</script>";
    exit;
}

$success = false;
$error = '';

// Proses submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $year = (int)$_POST['year'];
    $category = trim($_POST['category']);

    // Validasi tahun
    if (!is_numeric($year) || $year < 1000 || $year > date("Y")) {
        $error = "Tahun tidak valid. Harap masukkan tahun yang benar.";
    } else {
        // Query untuk menyimpan buku
        $stmt = $conn->prepare("INSERT INTO books (title, author, year, category) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $title, $author, $year, $category);

        if ($stmt->execute()) {
            $success = true;
        } else {
            $error = "Gagal menambahkan buku: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <h2>Tambah Buku</h2>

    <?php if ($success): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Buku berhasil ditambahkan.',
                timer: 2000,
                showConfirmButton: false
            }).then(() => {
                window.location.href = 'book_read.php';
            });
        </script>
    <?php elseif ($error): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '<?= addslashes($error) ?>'
            });
        </script>
    <?php endif; ?>

    <!-- Form untuk menambah buku -->
    <form action="book_create.php" method="POST">
        <label for="title">Judul Buku:</label>
        <input type="text" name="title" id="title" required><br><br>

        <label for="author">Penulis:</label>
        <input type="text" name="author" id="author" required><br><br>

        <label for="year">Tahun Terbit:</label>
        <input type="number" name="year" id="year" required><br><br>

        <label for="category">Kategori:</label>
        <input type="text" name="category" id="category" required><br><br>

        <input type="submit" value="Tambah Buku">
    </form>

    <!-- Tombol untuk kembali ke book_read.php -->
    <form action="book_read.php" method="get">
        <button type="submit">Kembali</button>
    </form>
</body>
</html>
