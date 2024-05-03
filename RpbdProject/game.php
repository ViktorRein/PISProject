<?php
include 'includes/dbpdo1.inc.php';
// Запрос для получения последних отзывов об играх
$sqlGames = "CALL get_last_reviews";
$stmtGames = $conn->query($sqlGames);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Интерфейс сайта</title>
    <link rel="stylesheet" href="css/css2.css">
</head>
<body style="background-image: linear-gradient(to right, rgba(164, 32, 133, 1), rgba(82, 73, 184, 1));">
    <form action="includes\game.inc.php" method="post">
        <header>
            <h1>GeekHub</h1>
            <div class="account-button">
                <button name="profile">Личный кабинет</button></a>
                <button name='quit'>Выход</button></a>
            </div>
        </header>
        <nav>
            <ul>
                <li><a href="games.php">Игры</a></li>
                <li><a href="films.php">Фильмы</a></li>
                <li><a href="series.php">Сериалы</a></li>
            </ul>
        </nav>
        <section class="latest-reviews">
            <h2>Отзывы об играх</h2>
            <?php while ($row = $stmtGames->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="review">
                    <h3><?php echo $row['title']; ?></h3>
                    <p><strong>Пользователь:</strong> <?php echo $row['username']; ?></p>
                    <p><strong>Оценка:</strong> <?php echo $row['rating']; ?></p>
                    <p><strong>Отзыв:</strong> <?php echo $row['comment']; ?></p>
                    <p><strong>Дата:</strong> <?php echo $row['timestamp']; ?></p>
                </div>
            <?php endwhile; ?>
            <?php $stmtGames->closeCursor(); ?>

            <h2>Отзывы о сериалах</h2>
            <?php
            $sqlSeries = "CALL get_last_series_reviews";
            $stmtSeries = $conn->query($sqlSeries);
             while ($row = $stmtSeries->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="review">
                    <h3><?php echo $row['title']; ?></h3>
                    <p><strong>Пользователь:</strong> <?php echo $row['username']; ?></p>
                    <p><strong>Оценка:</strong> <?php echo $row['rating']; ?></p>
                    <p><strong>Отзыв:</strong> <?php echo $row['comment']; ?></p>
                    <p><strong>Дата:</strong> <?php echo $row['timestamp']; ?></p>
                </div>
            <?php endwhile; ?>
            <?php $stmtSeries->closeCursor(); ?>

            <h3>Отзывы о фильмах</h3>
            <?php
            $sqlFilms = "CALL get_last_films_reviews";
            $stmtFilms = $conn->query($sqlFilms);
             while ($row = $stmtFilms->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="review">
                    <h3><?php echo $row['title']; ?></h3>
                    <p><strong>Пользователь:</strong> <?php echo $row['username']; ?></p>
                    <p><strong>Оценка:</strong> <?php echo $row['rating']; ?></p>
                    <p><strong>Отзыв:</strong> <?php echo $row['comment']; ?></p>
                    <p><strong>Дата:</strong> <?php echo $row['timestamp']; ?></p>
                </div>
            <?php endwhile; ?>
            <?php $stmtFilms->closeCursor(); ?>
        </section>
    </form>

    <footer>
        <p>&copy; 2023 Re1n</p>
    </footer>
</body>
</html>
