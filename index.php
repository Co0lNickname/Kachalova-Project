<?php
  session_start();

  if (!isset($_SESSION['client_id'])) {
    header('Location: ./src/admin/login.html');
    exit();
  }
  
  $pages = array(
     // 'form`s page' => 'forms.php',
     // 'another page' => 'another.php',
  );
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
      <a href="/src/admin/logout.php">
        <button class="pretty-button">Logout</button>
      </a>
    </div>
  </div>
  <h2>Choose what you want to do</h2>
  <div>
    <ol>
      <?php
        $pdo = require __DIR__ . '/db/config/db.php';
        $stmt = $pdo->prepare("SELECT * FROM Client WHERE ClientID = :id");
        $stmt->execute(['id' => $_SESSION['client_id']]);
        $client = $stmt->fetch();
        $is_admin = $client['IsAdmin'];
        if ($is_admin) {
            $pages['admin'] = './../admin/index.php';
            $pages['forms'] = './../templates.php';
        }

        foreach ($pages as $key => $page) {
          printf(
            '<strong><li><a href="./src/pages/%s">%s</a></li></strong>',
             $page, $key
            );
        }
      ?>
    </ol>
  </div>
</body>
</html>