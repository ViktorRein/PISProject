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
<body style="background-color:grey">
        <section class="latest-reviews">
            <h2>Отзывы об играх</h2>
            <?php while ($row = $stmtGames->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="review">
                    <h3><?php echo $row['title']; ?></h3>
                    <p><strong>Пользователь:</strong> <?php echo $row['username']; ?></p>
                    <p><strong>Оценка:</strong> <?php echo $row['rating']; ?></p>
                    <p><strong>Отзыв:</strong> <?php echo $row['comment']; ?></p>
                    <p><strong>Дата:</strong> <?php echo $row['timestamp']; ?></p>
                    <form action="includes/delete_review.inc.php" method="post">
                    <input type="hidden" name="review_id" value="<?php echo $row['review_id']; ?>">
                    <button type="submit" name="delete_game_review">Удалить отзыв</button>
                </form>
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
                    <form action="includes/delete_review.inc.php" method="post">
                    <input type="hidden" name="review_id" value="<?php echo $row['review_id']; ?>">
                    <button type="submit" name="delete_series_review">Удалить отзыв</button>
                </form>
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
                    <form action="includes/delete_review.inc.php" method="post">
                    <input type="hidden" name="review_id" value="<?php echo $row['review_id']; ?>">
                    <button type="submit" name="delete_films_review">Удалить отзыв</button>
                </form>
                </div>
            <?php endwhile; ?>
            <?php $stmtFilms->closeCursor(); ?>
        </section>
    <footer>
        <p>&copy; 2023 Re1n</p>
    </footer>
</body>
</html>
