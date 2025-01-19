<?php
    $pdo = require __DIR__ . '/../../db/config/db.php';

    session_start();

    $client = null;
    if (!isset($_SESSION['client_id'])) {
        $isLogin = false;
    } else {
        $isLogin = true;
        $clientId = $_SESSION['client_id'];

        //        $stmt = $pdo->prepare(
//                "SELECT Name, Username, Email, User.UserID, ProfileImage, MimeType
//                FROM User
//                    JOIN UsersImages ON User.UserID = UsersImages.UserID
//                    JOIN ProfilePictures on ProfilePictures.ImageID = UsersImages.ImageID
//                WHERE User.UserID = :id"
//        );

		$stmt = $pdo->prepare("SELECT * FROM User WHERE UserID = :id");
        $stmt->execute(['id' => $clientId]);
        $client = $stmt -> fetch();
    }
    $id = $client != null ? $client['UserID'] : 'Undefined';
    $name = $client != null ? $client['Name'] : 'Undefined';
    $userName = $client != null ? $client['Username'] : 'Undefined';
    $email = $client != null ? $client['Email'] : 'Undefined';

//    $profileImageBlob = $client != null ? $client['ProfileImage'] : 'Undefined';
//    $mimeType = $client != null ? $client['MimeType'] : 'Undefined';

//    $image = imagecreatefromstring($profileImageBlob);
//
//    ob_start();
//    imagejpeg($image, null, 80);
//    $data = ob_get_contents();
//    ob_end_clean();
//    echo '<img src="data:image/jpg;base64,' .  base64_encode($data)  . '" />';

    $stmt = $pdo->prepare("SELECT Username, Name FROM Friendship JOIN User ON User.UserID = Friendship.FriendID WHERE User.UserID = :id");
    $stmt->execute(['id' => $clientId]);
    $friends = $stmt -> fetch();

    $stmt = $pdo->prepare("SELECT Name, Username, IsAccepted FROM FriendshipRequests JOIN User ON User.UserID = FriendshipRequests.FromID WHERE FriendshipRequests.ToUser = :id");
    $stmt->execute(['id' => $clientId]);
    $requests = $stmt -> fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/main.css">
    <title>Your profile</title>
</head>
<?php if ($isLogin): ?>
<header class="profile-page-header">
    <h1>Welcome <?= $name ?> to your personal page.</h1>
    <div>
        <a href="/index.php">
            <button class="pretty-button">Back Home</button>
        </a>
    </div>
</header>
<body>
<div class="profile-data">
<!--    <div class="profile-img">-->
<!--        <img class="user-img" width="270" height="300" src="--><?php //= $profileImageBlob ?><!--" alt="user-picture">-->
<!--    </div>-->
    <div class="personal-data">
        <div class="user-info name">
            <h3>Your name</h3>
            <p class="right-placing"><?= $name ?></p>
        </div>
        <div class="user-info username">
            <h3>Your username</h3>
            <p class="right-placing"><?= $userName ?></p>
        </div>
        <div class="user-info email">
            <h3>Your email</h3>
            <p class="right-placing"><?= $email ?></p>
        </div>
    </div>
</div>
<div class="change-data">
    <a href="/src/pages/editProfileFrom.php">
        <button class="pretty-button">Change data</button>
    </a>
</div>
<div class="friends-data">
    <div class="friends-list">
        <?php
        foreach ($friend as $oneFriend) {
            printf(
            '
            <div class="friend-card">
                <p>%s</p>
                <p>%s</p>    
            </div>
            ',
                $oneFriend['Name'], $oneFriend['Username']
            );
        }
        ?>
        <div class="make-friends">
            <a href="/src/pages/addFriendForm.html" class="add-friend-ref">
                <button class="pretty-button">Add friend</button>
            </a>
        </div>
    </div>
    <div class="friends-requests">
        <div class="request">
            <p>Name: <?= $ ?></p>
            
        </div>
    </div>
</div>
</body>
<?php else: ?>
<body>
    <div>
        Back to <a href='/index.php'>main page</a>
    </div>
</body>
<?php endif; ?>
</html>