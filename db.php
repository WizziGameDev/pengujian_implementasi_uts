<?php
$conn = new mysqli("127.0.0.1", "root", "example", "book_uts", 3306);
if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
}
?>