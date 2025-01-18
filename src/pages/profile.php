<?php
    $pdo = require __DIR__ . '/../../db/config/db.php';

    session_start();

    $client = null;
    if (!isset($_SESSION['client_id'])) {
        $isLogin = false;
    } else {
        $isLogin = true;
        $clientId = $_SESSION['client_id'];
        $stmt = $pdo->prepare("SELECT * FROM User WHERE UserID = :id");
        $stmt->execute(['id' => $clientId]);
        $client = $stmt -> fetch();
    }
    $name = $client != null ? $client['Name'] : 'Undefined';
    $userName = $client != null ? $client['Username'] : 'Undefined';
    $email = $client != null ? $client['Email'] : 'Undefined';
    $profileImage = $client != null ? $client['ProfileImage'] : 'Undefined';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/main.css">
    <title>Your profile</title>
</head>
<?php if ($isLogin): ?>
<header>
    <h1>Welcome <?= $name ?> to your personal page.</h1>
</header>
<body>
<div class="profile-data">
    <div class="profile-img">
        <img class="user-img" width="270" height="300" src="" alt="user-picture">
    </div>
    <div class="personal-data">
        <div class="user-info name">
            <h3><?= $name ?></h3>
        </div>
        <div class="user-info username">
            <h3><?= $userName ?></h3>
        </div>
        <div class="user-info email">
            <h3><?= $email ?></h3>
        </div>
    </div>
</div>
</body>
<?php endif; ?>
</html>