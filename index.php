<?php
require_once __DIR__ . '/src/services/DatabaseService.php';
require_once __DIR__ . '/src/services/SessionService.php';
require_once __DIR__ . '/src/components/Header.php';
require_once __DIR__ . '/src/components/Footer.php';

$sessionService = new SessionService();
$isLoggedIn = $sessionService->isLoggedIn();

$client = null;
if ($isLoggedIn) {
    $db = new DatabaseService();
    $client = $db->getUserById($sessionService->getUserId());
}

// Вывод основной части
echo renderHeader('Home Page');
?>

<section class="home-section">
    <div class="hero-content">
        <h2 class="section-title">Welcome to our Application</h2>
        <p class="section-description">
            This is a simple application that allows users to register, log in, and manage their profiles.
            The application demonstrates basic web development practices using PHP.
        </p>
        
        <?php if (!$isLoggedIn): ?>
        <div class="cta-buttons">
            <a href="/src/admin/signup.html" class="btn btn-primary">Get Started</a>
            <a href="/src/admin/login.html" class="btn btn-secondary">Log In</a>
        </div>
        <?php else: ?>
        <div class="welcome-user">
            <p>Hello, <strong><?= htmlspecialchars($client['Name']) ?></strong>! Welcome back.</p>
            <a href="/src/pages/profile.php" class="btn btn-primary">Go to Profile</a>
        </div>
        <?php endif; ?>
    </div>
</section>

<section class="features-section">
    <h2 class="section-title">Features</h2>
    <div class="features-grid">
        <div class="feature-card">
            <h3>User Authentication</h3>
            <p>Secure login and registration system for users.</p>
        </div>
        <div class="feature-card">
            <h3>Profile Management</h3>
            <p>Users can view and edit their profile information.</p>
        </div>
        <div class="feature-card">
            <h3>Responsive Design</h3>
            <p>The application is optimized for various screen sizes.</p>
        </div>
    </div>
</section>

<style>
.home-section {
    text-align: center;
    padding: 40px 0;
}

.hero-content {
    max-width: 800px;
    margin: 0 auto;
}

.section-title {
    font-size: 2rem;
    color: var(--primary-color);
    margin-bottom: 20px;
}

.section-description {
    font-size: 1.1rem;
    margin-bottom: 30px;
    color: var(--text-light);
}

.cta-buttons, .welcome-user {
    margin-top: 30px;
}

.welcome-user {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: var(--box-shadow);
    margin-bottom: 30px;
}

.welcome-user p {
    margin-bottom: 15px;
}

.features-section {
    padding: 40px 0;
    background-color: white;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    margin-top: 30px;
}

.feature-card {
    padding: 25px;
    border-radius: 8px;
    box-shadow: var(--box-shadow);
    transition: transform 0.3s ease;
}

.feature-card:hover {
    transform: translateY(-5px);
}

.feature-card h3 {
    color: var(--primary-color);
    margin-bottom: 15px;
}

@media (max-width: 768px) {
    .features-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<?php
echo renderFooter();
?>