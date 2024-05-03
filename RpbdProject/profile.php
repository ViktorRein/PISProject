<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>
    <header>
        <h1>Личный кабинет</h1>
    </header>
    <div class="container">
        <div class="profile-info">
            <h2>Профиль пользователя: <?php echo $_SESSION['username']; ?></h2>
        </div>
        <div class="buttons">
            <a href="my-reviews.php" class="view-reviews-button">Посмотреть все мои отзывы</a>
            <a href="game.php" class="logout-button">Вернуться</a>
        </div>
    </div>
    <footer>
        <p>&copy; 2023 Re1n</p>
    </footer>
</body>
</html>
