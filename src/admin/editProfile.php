<?php
require_once __DIR__ . '/../../src/services/DatabaseService.php';
require_once __DIR__ . '/../../src/services/SessionService.php';

$sessionService = new SessionService();
$db = new DatabaseService();

if (!$sessionService->isLoggedIn()) {
	$sessionService->setFlashMessage('error', 'You need to be logged in to edit your profile');
	header('Location: /src/admin/login.html');
	exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$userId = $sessionService->getUserId();
	
	$data = [
		'Name' => $_POST['name'] ?? '',
		'Username' => $_POST['username'] ?? '',
		'Email' => $_POST['email'] ?? '',
	];
	
	// Добавляем пароль в обновляемые данные только если он был предоставлен
	if (!empty($_POST['password'])) {
		$data['Password'] = $_POST['password'];
	}
	
	if ($db->updateUser($userId, $data)) {
		$sessionService->setFlashMessage('success', 'Profile updated successfully');
	} else {
		$sessionService->setFlashMessage('error', 'Failed to update profile');
	}
	
	header('Location: /src/pages/profile.php');
	exit();
} else {
	// Если не POST запрос, перенаправляем на форму редактирования
	header('Location: /src/pages/editProfileForm.php');
	exit();
}