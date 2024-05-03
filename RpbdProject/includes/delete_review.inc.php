<?php
require_once 'dbpdo1.inc.php'; // Подключение к базе данных

if (isset($_POST['delete_game_review'])) {
    // Получение идентификатора отзыва из формы
    $review_id = $_POST['review_id'];

    try {
        // Подготовка SQL-запроса для удаления отзыва
        $sql = "DELETE FROM reviews WHERE review_id = :review_id";

        // Подготовка и выполнение запроса
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':review_id', $review_id, PDO::PARAM_INT);
        $stmt->execute();
        header("Location: ../all_reviews.php");
        exit();
    } catch (PDOException $e) {
        // Обработка ошибок, если они возникнут при удалении отзыва
        echo "Error: " . $e->getMessage();
    }
} 


if (isset($_POST['delete_series_review'])) {
    // Получение идентификатора отзыва из формы
    $review_id = $_POST['review_id'];
    try {
        // Подготовка SQL-запроса для удаления отзыва
        $sql = "DELETE FROM series_reviews WHERE review_id = :review_id";

        // Подготовка и выполнение запроса
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':review_id', $review_id, PDO::PARAM_INT);
        $stmt->execute();
        header("Location: ../all_reviews.php");
        exit();
    } catch (PDOException $e) {
        // Обработка ошибок, если они возникнут при удалении отзыва
        echo "Error: " . $e->getMessage();
    }
    
}
if (isset($_POST['delete_films_review'])) {
    // Получение идентификатора отзыва из формы
    $review_id = $_POST['review_id'];

    try {
        $sql = "DELETE FROM films_reviews WHERE review_id = :review_id";

        // Подготовка и выполнение запроса
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':review_id', $review_id, PDO::PARAM_INT);
        $stmt->execute();
        header("Location: ../all_reviews.php");
        exit();
    } catch (PDOException $e) {
        // Обработка ошибок, если они возникнут при удалении отзыва
        echo "Error: " . $e->getMessage();
    }
}
?>
