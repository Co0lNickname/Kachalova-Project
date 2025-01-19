<?php
$pdo = require __DIR__ . '/../../db/config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_SESSION['client_id'])) {
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
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	} else {
		echo 'You are not logged in';
		echo '<a href="login.php">Login</a>';
	}
}