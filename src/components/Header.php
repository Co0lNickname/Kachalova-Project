<?php
require_once __DIR__ . '/../services/SessionService.php';

function renderHeader($title = 'Welcome', $showBackButton = false)
{
    $sessionService = new SessionService();
    $isLoggedIn = $sessionService->isLoggedIn();
    
    ob_start();
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/assets/css/styles.css">
        <title><?= htmlspecialchars($title) ?></title>
    </head>
    <body>
        <header class="main-header">
            <div class="container">
                <div class="header-content">
                    <div class="logo">
                        <h1><?= htmlspecialchars($title) ?></h1>
                    </div>
                    <nav class="navigation">
                        <?php if ($showBackButton): ?>
                            <a href="/index.php" class="nav-link">
                                <button class="btn btn-secondary">Back Home</button>
                            </a>
                        <?php endif; ?>
                        
                        <?php if ($isLoggedIn): ?>
                            <div class="user-menu">
                                <a href="/src/pages/profile.php" class="profile-link">
                                    <img src="/assets/profile.png" alt="Profile" class="profile-icon">
                                </a>
                                <a href="/src/admin/logout.php" class="nav-link">
                                    <button class="btn btn-primary">Logout</button>
                                </a>
                            </div>
                        <?php else: ?>
                            <div class="auth-actions">
                                <a href="/src/admin/login.html" class="nav-link">
                                    <button class="btn btn-primary">Log In</button>
                                </a>
                                <a href="/src/admin/signup.html" class="nav-link">
                                    <button class="btn btn-secondary">Sign Up</button>
                                </a>
                            </div>
                        <?php endif; ?>
                    </nav>
                </div>
            </div>
        </header>
        <main class="main-content">
            <div class="container">
            <?php if ($sessionService->hasFlashMessage('success')): ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($sessionService->getFlashMessage('success')) ?>
                </div>
            <?php endif; ?>
            
            <?php if ($sessionService->hasFlashMessage('error')): ?>
                <div class="alert alert-error">
                    <?= htmlspecialchars($sessionService->getFlashMessage('error')) ?>
                </div>
            <?php endif; ?>
    <?php
    return ob_get_clean();
}
?> 