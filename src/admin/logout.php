<?php
$pdo = require __DIR__ . '/../../db/config/db.php';

session_start();
session_destroy();
$userID = $_SESSION['client_id'];
$stmt = $pdo->prepare("UPDATE User IsActive = 0 WHERE UserID = ?");
$stmt->execute([$userID]);
$stmt->fetch();
header("Location: login.html");
exit;