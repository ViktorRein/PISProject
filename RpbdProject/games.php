<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список игр</title>
    <link rel="stylesheet" href="css/games.css">
    <script>
    function setRating(value, gameId) {
        var stars = document.querySelectorAll('.star-rating-' + gameId + ' label');
        for (var i = 0; i < stars.length; i++) {
            if (i < value) {
                stars[i].classList.add('selected');
            } else {
                stars[i].classList.remove('selected');
            }
        }
        document.getElementById('rating-' + gameId).value = value;
    }
</script>
</head>
<body style="background-image: linear-gradient(to right, #8d42be, rgba(214, 40, 173, 0.6));">
    <header>
        <h1>GeekHub</h1>
        <div class="account-button">
            <a href="profile.php"><button name="profile">Личный кабинет</button></a>
            <a href="game.php"><button name='quit'>Вернуться</button></a>
        </div>
    </header>
    <div class="games-container">
        <form action="" method="post" class="search-form">
            <input type="text" name="search" placeholder="Поиск по названию">
            <button type="submit" name="searching">Искать</button>
        </form>
        <?php
        session_start();
        include 'includes/dbpdo1.inc.php';

        if (isset($_POST['searching'])) {
            $searchTerm = $_POST['search'];
            // Формируем SQL-запрос с условием поиска
            $sql = "SELECT * FROM games WHERE title LIKE :searchTerm";
            // Подготавливаем запрос
            $stmt = $conn->prepare($sql);
            // Добавляем знаки % для поиска по части названия
            $searchTerm = "%$searchTerm%";
            // Привязываем значение параметра запроса и выполняем запрос
            $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
            $stmt->execute();
        } else {
            // Если поисковый запрос не был отправлен, просто выполним стандартный запрос для вывода всех игр
            $sql = "SELECT * FROM games";
            $stmt = $conn->query($sql);
        }

        // Перебираем результаты запроса
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<table class="game-table">';
            echo '<tr>';
            echo '<td class="game-details">';
            echo '<h2>' . $row['title'] . '</h2>';
            echo '<p><strong>Жанр:</strong> ' . $row['genre'] . '</p>';
            echo '<p><strong>Дата выпуска:</strong> ' . $row['release_date'] . '</p>';
            echo '<p><strong>Платформа:</strong> ' . $row['platform'] . '</p>';
            echo '<p><strong>Разработчик:</strong> ' . $row['developer'] . '</p>';

            $gameId = $row['game_id'];
            $avgRating = $conn->query("SELECT CalculateAverageRating($gameId) AS avg_rating")->fetch(PDO::FETCH_ASSOC)['avg_rating'];
            echo '<p><strong>Средняя оценка:</strong> ' . ($avgRating ?? 'Нет оценки') . '</p>';
            echo '</td>';
            // Путь к обложке
            $coverPath = $row['cover'] ?? 'default_cover.jpg';
            // Вывод картинки с использованием стилей CSS
            echo '<td class="cover-cell">';
            echo '<img src="' . $coverPath . '" alt="Обложка игры" class="cover-image">';
            echo '</td>';
            echo '</tr>';
            echo '</table>';
            // Форма для добавления оценки и отзыва
            echo '<form action="includes/games.inc.php" method="post">';
            echo '<input type="hidden" name="game_id" value="' . ($row['game_id'] ?? '') . '">';
            echo '<div class="star-rating star-rating-' . $gameId . '">';
            for ($i = 1; $i <= 10; $i++) {
                echo '<input type="button" id="star' . $gameId . '-' . $i . '" name="star" value="' . $i . '" onclick="setRating(' . $i . ', ' . $gameId . ')">';
                echo '<label for="star' . $gameId . '-' . $i . '"></label>';
            }
            echo '</div>';
            echo '<input type="hidden" id="rating-' . $gameId . '" name="rating" value="">';
            echo '<label for="review">Отзыв:</label>';
            echo '<textarea name="review" rows="4" cols="50" placeholder="Введите отзыв"></textarea>';
            echo '<button type="submit" name ="submit">Добавить оценку и отзыв</button>';
            echo '<button type="submit" name="update_review">Обновить отзыв</button>';
            echo '<button type="submit" name="delete_review">Удалить отзыв</button>';
            echo '</form>';
        }
        $conn = null;
        ?>
    </div>

    <footer>
        <p>&copy; 2024 Re1n</p>
    </footer>
</body>
</html>
