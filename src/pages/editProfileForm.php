<?php
$pdo = require __DIR__ . '/../../db/config/db.php';
session_start();

$client = null;
if (isset($_SESSION['client_id'])) {
	$clientId = $_SESSION['client_id'];
	$stmt = $pdo->prepare("SELECT * FROM User WHERE UserID = :id");
	$stmt->execute(['id' => $clientId]);
	$client = $stmt -> fetch();
}
$name = $client != null ? $client['Name'] : 'Undefined';
$userName = $client != null ? $client['Username'] : 'Undefined';
$email = $client != null ? $client['Email'] : 'Undefined';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/main.css">
    <title>Document</title>
</head>
<body>
    <form action="/src/admin/editProfile.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?= $name ?>" required>
        <br>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?= $userName ?>" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= $email ?>" required>
        <br>
        <div class="confirm-button">
            <button class="pretty-button">Confirm changes</button>
        </div>
    </form>
    <div class="to-profile-button">
        <a href="/src/pages/profile.php">
            <button class="pretty-button">Return to profile</button>
        </a>
    </div>
</body>
</html>