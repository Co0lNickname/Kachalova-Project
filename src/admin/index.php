<?php
$pdo = require __DIR__ . '/../../db/config/db.php';

session_start();
if (!isset($_SESSION['client_id'])) {
    header('Location: login.html');
    exit();
}
$clientId = $_SESSION['client_id'];
$stmt = $pdo->prepare("SELECT * FROM Client WHERE ClientID = :id");
$stmt->execute(['id' => $clientId]);
$client = $stmt -> fetch();

if (!$client['IsAdmin']) {
    header('Location: /index.php');
    exit;
}

echo "<h1>Welcome to Admin Panel, {$client['Name']}!</h1>";
echo "<a href=''>Manage Movies</a> | <a href=''>Manage Users</a> | <a href='logout.php'>Logout</a>";
echo "<div>Back to <a href='/index.php'>main page</a></div>";
