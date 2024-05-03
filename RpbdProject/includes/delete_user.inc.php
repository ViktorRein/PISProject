<?php
require_once 'dbpdo1.inc.php'; // Подключение к базе данных

if (isset($_POST['delete_user'])) {
    $user_id = $_POST['user_id']; // Получение идентификатора пользователя из формы

    // Вызов процедуры для удаления пользователя и связанных с ним отзывов
    $stmt = $conn->prepare("CALL DeleteUserAndReviews(:user_id)");
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    
    // Попробуйте выполнить запрос
    try {
        $stmt->execute();
        header("Location: ../admin.php"); // Перенаправление после удаления
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage(); // Вывести ошибку, если что-то пошло не так
    }
}
?>
