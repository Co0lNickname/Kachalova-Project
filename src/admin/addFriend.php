<?php
$pdo = require __DIR__ . '/../../db/config/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (!isset($_SESSION['client_id'])) {
		echo 'You are not logged in ';
		echo '<a href="login.html">Login</a>';
	} else {
        $id = $_SESSION['client_id'];
        $username = $_POST['username'];
        try {
            $stmt = $pdo->prepare("SELECT * FROM User WHERE Username = ?");
            $stmt->execute([$username]);
            $friend = $stmt -> fetch();
            $friendID = $friend['UserID'];

            $stmt = $pdo->prepare("INSERT INTO FriendshipRequests (ToUser, FromUser, IsAccepted) VALUES (?, ?, ?)");
            $stmt->execute([$friendID, $id, 0]);
        } catch (PDOException $exception) {
            echo "Can not find friend with username " . $username . "with error: " . $e->getMessage();
        }
    }
}