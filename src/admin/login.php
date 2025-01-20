<?php
$pdo = require __DIR__ . '/../../db/config/db.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM User WHERE Email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['Password'])) {
        $_SESSION['client_id'] = $user['UserID'];
        header('Location: /index.php');
        exit();
    } else {
        echo "Invalid credentials.";
    }
}
