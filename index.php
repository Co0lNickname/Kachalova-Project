<?php
  session_start();

  $isLogin = false;

  if (!isset($_SESSION['client_id'])) {
    $isLogin = false;
  } else {
    $isLogin = true;
  }

  $pdo = require __DIR__ . '/db/config/db.php';
  if ($isLogin) {
    $stmt = $pdo->prepare("SELECT * FROM User WHERE UserID = :id"); 
    $stmt->execute(['id' => $_SESSION['client_id']]);
    $client = $stmt->fetch();
    $is_admin = $client['IsAdmin'];
  } else {
    $is_admin = false;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/main.css">
    <style>
        .header {
          display: flex;
          justify-content: space-between;
        }
    </style>
  <title>Document</title>
</head>
<body>
  <div class="header">
    <h1>Hello, glad to see You on our home page</h1>
    <div class="auth">
      <?php if ($isLogin): ?>
        <div class="auth-complete">
          <a class="profile-btn" href="/src/pages/profile.php">
            <img width="43" src="/assets/profile.png" alt="profile-png">
          </a>
          <a class="center-item" href="/src/admin/logout.php">
            <button class="pretty-button">Logout</button>
          </a>
        </div>
      <?php else: ?>
        <div class="auth-choose">
          <a class="center-item" href="/src/admin/login.html">
            <button class="pretty-button">Log In</button>
          </a>
          <div class="delimiter center-item">/</div>
          <a class="center-item" href="/src/admin/signup.html">
          <button class="pretty-button">Sign Up</button>
        </a>
        </div>
      <?php endif; ?>
    </div>
  </div>
  <div>
    WOOOW INFO ABOUT SITE
  </div>
</body>
</html>