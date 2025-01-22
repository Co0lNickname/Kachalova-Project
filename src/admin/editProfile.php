<?php
$pdo = require __DIR__ . '/../../db/config/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (!isset($_SESSION['client_id'])) {
		echo 'You are not logged in ';
		echo '<a href="login.html">Login</a>';
	} else {
		$userID = $_SESSION['client_id'];
		$name = $_POST['name'];
		$username = $_POST['username'];
		$email = $_POST['email'];

		$stmt = $pdo->prepare("UPDATE User SET Name = :name, Username = :username, Email = :email WHERE UserID = :id");
		try {
			$stmt->execute([
				'name' => $name,
				'username' => $username,
				'email' => $email,
				'id' => $userID
			]);
			header("Location: /src/pages/profile.php");
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}
}