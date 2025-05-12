<?php
require_once __DIR__ . '/../../src/services/DatabaseService.php';
require_once __DIR__ . '/../../src/services/SessionService.php';
require_once __DIR__ . '/../../src/components/Header.php';
require_once __DIR__ . '/../../src/components/Footer.php';
require_once __DIR__ . '/../../src/components/UserInfoCard.php';

$sessionService = new SessionService();
$isLoggedIn = $sessionService->isLoggedIn();

if (!$isLoggedIn) {
    // Перенаправляем на главную страницу, если пользователь не авторизован
    $sessionService->setFlashMessage('error', 'You need to be logged in to view this page');
    header('Location: /index.php');
    exit();
}

$db = new DatabaseService();
$user = $db->getUserById($sessionService->getUserId());

// Вывод основной части
echo renderHeader('Your Profile', true);
?>

<div class="profile-container">
    <?php echo renderUserInfoCard($user); ?>
    
    <div class="additional-actions">
        <a href="/index.php" class="btn btn-secondary">Back to Home</a>
    </div>
</div>

<style>
.profile-container {
    max-width: 800px;
    margin: 0 auto;
}

.additional-actions {
    text-align: center;
    margin-top: 20px;
}
</style>

<?php
echo renderFooter();
?>