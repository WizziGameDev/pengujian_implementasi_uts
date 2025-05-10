<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user'])) {
    echo "Login terlebih dahulu! <a href='index.php'>Kembali</a>";
    exit;
}

$user = $_SESSION['user'];
$isAdmin = $user['role'] === 'admin';

// Ambil data buku
$result = $conn->query("SELECT * FROM books");
$books = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #999;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #eee;
        }

        button {
            padding: 5px 10px;
            font-size: 14px;
        }

        .actions a {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="top-bar">
        <div>
            <h2>Selamat datang, <?= htmlspecialchars($user['username']) ?>!</h2>
        </div>
        <div>
            <a href="logout.php"><button>Logout</button></a>
        </div>
    </div>

    <h3>Daftar Buku</h3>

    <?php if ($isAdmin): ?>
        <a href="book_create.php"><button>Tambah Buku</button></a>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Tahun</th>
                <th>Kategori</th>
                <?php if ($isAdmin): ?>
                    <th>Aksi</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($books as $book): ?>
                <tr>
                    <td><?= htmlspecialchars($book['title']) ?></td>
                    <td><?= htmlspecialchars($book['author']) ?></td>
                    <td><?= htmlspecialchars($book['year']) ?></td>
                    <td><?= htmlspecialchars($book['category']) ?></td>
                    <?php if ($isAdmin): ?>
                        <td class="actions">
                            <a href="book_update.php?id=<?= $book['id'] ?>"><button>Edit</button></a>
                            <a href="book_delete.php?id=<?= $book['id'] ?>" onclick="return confirm('Yakin ingin menghapus buku ini?');"><button>Hapus</button></a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
