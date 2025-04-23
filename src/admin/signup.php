<?php
require_once __DIR__ . '/../../src/services/DatabaseService.php';
require_once __DIR__ . '/../../src/services/SessionService.php';

$sessionService = new SessionService();
$db = new DatabaseService();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (empty($name) || empty($username) || empty($email) || empty($password)) {
        $sessionService->setFlashMessage('error', 'All fields are required');
        header('Location: /src/admin/signup.html');
        exit();
    }
    
    if ($db->createUser($name, $username, $email, $password)) {
        $sessionService->setFlashMessage('success', 'Account created successfully. Please log in.');
        header('Location: /src/admin/login.html');
        exit();
    } else {
        $sessionService->setFlashMessage('error', 'Failed to create account. Email or username may already exist.');
        header('Location: /src/admin/signup.html');
        exit();
    }
} else {
    // Если не POST запрос, перенаправляем на форму регистрации
    header('Location: /src/admin/signup.html');
    exit();
}