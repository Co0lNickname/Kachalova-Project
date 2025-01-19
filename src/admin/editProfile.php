<?php
$pdo = require __DIR__ . '/../../db/config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$name = $_POST['name'];
	$username = $_POST['username'];
	$email = $_POST['email'];
}