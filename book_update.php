<?php
require 'db.php';
session_start();

// Cek apakah admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    echo "<script>alert('Akses ditolak'); window.location.href='book_read.php';</script>";
    exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Ambil data buku untuk ditampilkan di form
$stmt = $conn->prepare("SELECT * FROM books WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$book = $result->fetch_assoc();

if (!$book) {
    echo "<script>alert('Buku tidak ditemukan'); window.location.href='book_read.php';</script>";
    exit;
}

$success = false;
$error = '';

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $year = (int)$_POST['year'];
    $category = trim($_POST['category']);

    if (!$title || !$author || !$category || $year < 1000 || $year > date("Y")) {
        $error = "Data tidak valid.";
    } else {
        $stmt = $conn->prepare("UPDATE books SET title = ?, author = ?, year = ?, category = ? WHERE id = ?");
        $stmt->bind_param("ssisi", $title, $author, $year, $category, $id);

        if ($stmt->execute()) {
            $success = true;
        } else {
            $error = "Gagal mengupdate buku: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Buku</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <h2>Edit Buku</h2>

    <?php if ($success): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data buku berhasil diperbarui.',
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
                text: '<?php echo addslashes($error); ?>'
            });
        </script>
    <?php endif; ?>

    <form action="book_update.php?id=<?= $id ?>" method="POST">
        <label for="title">Judul Buku:</label><br>
        <input type="text" name="title" id="title" value="<?= htmlspecialchars($book['title']) ?>" required><br><br>

        <label for="author">Penulis:</label><br>
        <input type="text" name="author" id="author" value="<?= htmlspecialchars($book['author']) ?>" required><br><br>

        <label for="year">Tahun Terbit:</label><br>
        <input type="number" name="year" id="year" value="<?= htmlspecialchars($book['year']) ?>" required><br><br>

        <label for="category">Kategori:</label><br>
        <input type="text" name="category" id="category" value="<?= htmlspecialchars($book['category']) ?>" required><br><br>

        <input type="submit" value="Update Buku">
    </form>

    <br>
    <form action="book_read.php" method="get">
        <button type="submit">Kembali</button>
    </form>
</body>
</html>
