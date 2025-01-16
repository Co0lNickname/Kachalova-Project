<?php
$pdo = require __DIR__ . '/../../db/config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO Client (Name, Username, Email, Password, IsAdmin, IsActive, IsBlocked) VALUES (?, ?, ?, ?, ?, ?, ?)");
    try {
        $stmt->execute([$name, $username, $email, $password, 0, 1, 0]);
        echo "
            <div>Signup successful.</div>
            <div>Back to <a href='/index.php'>main page</a></div>
        ";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}