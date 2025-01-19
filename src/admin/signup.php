<?php
$pdo = require __DIR__ . '/../../db/config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmtUser = $pdo->prepare("INSERT INTO User (Name, Username, Email, Password, IsAdmin, IsActive, IsBlocked) VALUES (?, ?, ?, ?, ?, ?, ?)");
	$stmtPicture = $pdo->prepare("INSERT INTO ProfilePictures (ProfileImage, MimeType) VALUES (?, ?)");
	$stmtRelation = $pdo->prepare("INSERT INTO UsersImages (UserID, ImageID) VALUES (?, ?)");
    try {
        $stmtUser->execute([$name, $username, $email, $password, 0, 1, 0]);
		$user = $stmtUser->fetch();
		$stmtPicture->execute([null, null]);
		$image = $stmtPicture -> fetch();
		$stmtRelation->execute([$user['UserID'], $image['ImageID']]);
        echo "
            <div>Signup successful.</div>
            <div>Back to <a href='/index.php'>main page</a></div>
        ";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}