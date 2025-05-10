<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'user')");
    $stmt->bind_param("sss", $username, $email, $password);
    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>
<form method="POST">
    Username: <input name="username"><br>
    Email: <input name="email"><br>
    Password: <input name="password" type="password"><br>
    <button type="submit">Register</button>
</form>

<!-- Tombol Back -->
<form action="index.php" method="get">
    <button type="submit">Back</button>
</form>
