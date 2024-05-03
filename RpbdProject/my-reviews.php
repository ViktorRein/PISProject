<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мои отзывы</title>
    <link rel="stylesheet" href="css/review.css">
</head>
<body>
    <header>
        <h1>Мои отзывы</h1>
        <div class="account-button">
            <a href = game.php><button name = 'quit'>Вернуться</button></a>
        </div>
    </header>
    <div class="container">
    <?php
    include 'includes/dbpdo1.inc.php';
    session_start();
    $username = $_SESSION['username'];

    // Получаем user_id по имени пользователя
    $sqlUserId = "SELECT user_id FROM users WHERE username = :username";
    $stmtUserId = $conn->prepare($sqlUserId);
    $stmtUserId->bindParam(':username', $username, PDO::PARAM_STR);
    $stmtUserId->execute();
    $user_id = $stmtUserId->fetchColumn();

    // Получаем отзывы пользователя о играх
    $sqlGamesReviews = "CALL GetUserReviews(:userId)";
    $stmtGames = $conn->prepare($sqlGamesReviews);
    $stmtGames->bindParam(':userId', $user_id, PDO::PARAM_INT);
    $stmtGames->execute();

    // Выводим отзывы о играх
    while ($row = $stmtGames->fetch(PDO::FETCH_ASSOC)) {
        echo '<div class="review">';
        echo '<h3>Игра: ' . $row['game_title'] . '</h3>';
        echo '<p><strong>Оценка:</strong> ' . $row['rating'] . '</p>';
        echo '<p><strong>Отзыв:</strong> ' . $row['comment'] . '</p>';
        echo '<p><strong>Дата:</strong> ' . $row['timestamp'] . '</p>';
        echo '</div>';
    }
    $stmtGames->closeCursor();

    // Получаем отзывы пользователя о сериалах
    $sqlSeriesReviews = "CALL GetUserSeriesReview(:userId)";
    $stmtSeries = $conn->prepare($sqlSeriesReviews);
    $stmtSeries->bindParam(':userId', $user_id, PDO::PARAM_INT);
    $stmtSeries->execute();

    // Выводим отзывы о сериалах
    while ($row = $stmtSeries->fetch(PDO::FETCH_ASSOC)) {
        echo '<div class="review">';
        echo '<h3>Сериал: ' . $row['series_title'] . '</h3>';
        echo '<p><strong>Оценка:</strong> ' . $row['rating'] . '</p>';
        echo '<p><strong>Отзыв:</strong> ' . $row['comment'] . '</p>';
        echo '<p><strong>Дата:</strong> ' . $row['timestamp'] . '</p>';
        echo '</div>';
    }
    $stmtSeries->closeCursor();

    // Получаем отзывы пользователя о фильмах
    $sqlFilmsReviews = "CALL GetUserFilmsReview(:userId)";
    $stmtFilms = $conn->prepare($sqlFilmsReviews);
    $stmtFilms->bindParam(':userId', $user_id, PDO::PARAM_INT);
    $stmtFilms->execute();

    // Выводим отзывы о фильмах
    while ($row = $stmtFilms->fetch(PDO::FETCH_ASSOC)) {
        echo '<div class="review">';
        echo '<h3>Фильм: ' . $row['film_title'] . '</h3>';
        echo '<p><strong>Оценка:</strong> ' . $row['rating'] . '</p>';
        echo '<p><strong>Отзыв:</strong> ' . $row['comment'] . '</p>';
        echo '<p><strong>Дата:</strong> ' . $row['timestamp'] . '</p>';
        echo '</div>';
    }
    $stmtFilms->closeCursor();
    ?>
</div>

    <footer>
        <p>&copy; 2023 Re1n</p>
    </footer>
</body>
</html>
