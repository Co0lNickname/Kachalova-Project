<?php
function renderUserInfoCard($user)
{
    if (!$user) {
        return '<div class="error-message">User information not available</div>';
    }
    
    ob_start();
    ?>
    <div class="user-card">
        <h2 class="user-card-title">User Information</h2>
        <div class="user-card-content">
            <div class="user-info-item">
                <label>Name:</label>
                <span><?= htmlspecialchars($user['Name'] ?? 'Not specified') ?></span>
            </div>
            
            <div class="user-info-item">
                <label>Username:</label>
                <span><?= htmlspecialchars($user['Username'] ?? 'Not specified') ?></span>
            </div>
            
            <div class="user-info-item">
                <label>Email:</label>
                <span><?= htmlspecialchars($user['Email'] ?? 'Not specified') ?></span>
            </div>
        </div>
        
        <div class="user-card-actions">
            <a href="/src/pages/editProfileForm.php" class="btn btn-primary">Edit Profile</a>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
?> 