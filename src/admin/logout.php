<?php
$pdo = require __DIR__ . '/../../db/config/db.php';

session_start();
session_destroy();
header("Location: login.html");
exit;