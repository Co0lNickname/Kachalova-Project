<?php
    $pdo = require __DIR__ . '/../../db/config/db.php';

    session_start();

    if (!isset($_SESSION['client_id'])) {
        $isLogin = false;
    } else {
        $isLogin = true;
        $clientId = $_SESSION['client_id'];
        $stmt = $pdo->prepare("SELECT * FROM Client WHERE ClientID = :id");
        $stmt->execute(['id' => $clientId]);
        $client = $stmt -> fetch();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/main.css">
    <title>Your profile</title>
</head>
<body>
    
</body>
</html>