<?php
require_once __DIR__ . '/../../src/services/DatabaseService.php';
require_once __DIR__ . '/../../src/services/SessionService.php';
require_once __DIR__ . '/../../src/components/Header.php';
require_once __DIR__ . '/../../src/components/Footer.php';
require_once __DIR__ . '/../../src/components/FormElements.php';

$sessionService = new SessionService();
$isLoggedIn = $sessionService->isLoggedIn();

if (!$isLoggedIn) {
    $sessionService->setFlashMessage('error', 'You need to be logged in to edit your profile');
    header('Location: /index.php');
    exit();
}

$db = new DatabaseService();
$user = $db->getUserById($sessionService->getUserId());

// Обработка отправки формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'Name' => $_POST['name'] ?? '',
        'Username' => $_POST['username'] ?? '',
        'Email' => $_POST['email'] ?? '',
        'Password' => $_POST['password'] ?? ''
    ];
    
    if ($db->updateUser($sessionService->getUserId(), $data)) {
        $sessionService->setFlashMessage('success', 'Profile updated successfully');
        header('Location: /src/pages/profile.php');
        exit();
    } else {
        $sessionService->setFlashMessage('error', 'Failed to update profile');
    }
}

// Вывод страницы
echo renderHeader('Edit Profile', true);
?>

<div class="edit-profile-container">
    <h2 class="form-title">Edit Your Profile</h2>
    
    <?php
    // Формируем содержимое формы
    $formContent = 
        renderInput('text', 'name', 'Name', $user['Name'] ?? '', true) .
        renderInput('text', 'username', 'Username', $user['Username'] ?? '', true) .
        renderInput('email', 'email', 'Email', $user['Email'] ?? '', true) .
        renderInput('password', 'password', 'New Password', '', false, 'Leave empty to keep current password') .
        '<div class="form-actions">' .
            renderButton('Save Changes') .
            '<a href="/src/pages/profile.php" class="btn btn-secondary">Cancel</a>' .
        '</div>';
    
    // Рендерим форму
    echo renderForm('/src/admin/editProfile.php', 'post', $formContent);
    ?>
</div>

<style>
.edit-profile-container {
    max-width: 600px;
    margin: 0 auto;
}

.form-actions {
    display: flex;
    justify-content: space-between;
    margin-top: 30px;
}
</style>

<?php
echo renderFooter();
?>