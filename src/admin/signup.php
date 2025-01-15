<?php
$pdo = require __DIR__ . '/../../db/config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $wishes = $_POST['wishes'] ?? null;

    $stmt = $pdo->prepare("INSERT INTO Client (Name, Email, Password, Wishes, IsAdmin) VALUES (?, ?, ?, ?, ?)");
    try {
        $stmt->execute([$name, $email, $password, $wishes, 0]);
        echo "
            <div>Signup successful.</div>
            <div>Back to <a href='/index.php'>main page</a></div>
        ";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}