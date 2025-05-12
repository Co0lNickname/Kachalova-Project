<?php
require_once __DIR__ . '/../../src/services/DatabaseService.php';
require_once __DIR__ . '/../../src/services/SessionService.php';

$sessionService = new SessionService();
$db = new DatabaseService();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $sessionService->setFlashMessage('error', 'Email and password are required');
        header('Location: /src/admin/login.html');
        exit();
    }

    $user = $db->getUserByEmail($email);

    if ($user && password_verify($password, $user['Password'])) {
        $sessionService->setUserId($user['UserID']);
        $sessionService->setFlashMessage('success', 'Login successful');
        header('Location: /index.php');
        exit();
    } else {
        $sessionService->setFlashMessage('error', 'Invalid email or password');
        header('Location: /src/admin/login.html');
        exit();
    }
} else {
    // Если не POST запрос, перенаправляем на форму входа
    header('Location: /src/admin/login.html');
    exit();
}
