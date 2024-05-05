<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список сериалов</title>
    <link rel="stylesheet" href="css/games.css">
</head>
<body style="background-image: linear-gradient(to right, #3368b7bc 2%, #2bc2ab 70%);">
<header>
        <h1>GeekHub</h1>
        <div class="account-button">
            <a href = profile.php><button name = "profile">Личный кабинет</button></a>
            <a href = game.php><button name = 'quit'>Вернуться</button></a>
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
            $sql = "SELECT * FROM films WHERE title LIKE :searchTerm";
            // Подготавливаем запрос
            $stmt = $conn->prepare($sql);
            // Добавляем знаки % для поиска по части названия
            $searchTerm = "%$searchTerm%";
            // Привязываем значение параметра запроса и выполняем запрос
            $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
            $stmt->execute();
        } else {
            // Если поисковый запрос не был отправлен, просто выполним стандартный запрос для вывода всех игр
            $sql = "SELECT * FROM films";
            $stmt = $conn->query($sql);
        }

      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<table class="game-table">';
        echo '<tr>';
        echo '<td class="game-details">';
        echo '<h2>' . $row['title'] . '</h2>';
        echo '<p><strong>Жанр:</strong> ' . $row['genre'] . '</p>';
        echo '<p><strong>Дата выпуска:</strong> ' . $row['release_date'] . '</p>';
        echo '<p><strong>Режиссер:</strong> ' . $row['director'] . '</p>';
        $film_id = $row['film_id'];
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
        echo '<form action="includes/films.inc.php" method="post">';
        echo '<input type="hidden" name="film_id" value="' . ($row['film_id'] ?? '') . '">';
        echo '<label for="rating">Оценка:</label>';
        echo '<input type="number" id="rating" name="rating" min="1" max="10" step="1" value="' .  '">';
        echo '<label for="review">Отзыв:</label>';
        echo '<textarea name="review" rows="4" cols="50" placeholder="Введите отзыв">' . '</textarea>';
        echo '<button type="submit" name ="submit">Добавить оценку и отзыв</button>';
        echo '<button type="submit" name="update_review">Обновить отзыв</button>'; 
        echo '<button type="submit" name="delete_review">Удалить отзыв</button>';  
        echo '</form>';
    }
        $conn = null;
        ?>
    </div>
    <footer>
        <p>&copy; 2023 Re1n</p>
    </footer>
</body>
</html>
