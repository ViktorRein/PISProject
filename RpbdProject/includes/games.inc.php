<?php
    require_once 'function1.inc.php';
    require_once 'dbpdo1.inc.php';
    session_start();
if (isset($_POST['submit'])) {
    $username = $_SESSION['username'];
    $game_id = $_POST['game_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['review'];
    $timestamp = date('Y-m-d H:i:s');

    try {
        // Подготовка и выполнение первой операции (AddReview)
        $stmtReview = $conn->prepare("CALL AddReview(:username, :game_id, :rating, :comment, :timestamp)");
        $stmtReview->bindParam(':username', $username, PDO::PARAM_STR);
        $stmtReview->bindParam(':game_id', $game_id, PDO::PARAM_INT);
        $stmtReview->bindParam(':rating', $rating, PDO::PARAM_INT);
        $stmtReview->bindParam(':comment', $comment, PDO::PARAM_STR);
        $stmtReview->bindParam(':timestamp', $timestamp, PDO::PARAM_STR);

        // Проверка выполнения первой операции
        if ($stmtReview->execute()) {
            echo "Отзыв успешно добавлен. ";
            $gameId = $_POST['game_id'];
            $rating = $_POST['rating'];
            $comment = $_POST['review'];
        } else {
            echo "Ошибка при добавлении отзыва: " . $stmtReview->errorInfo()[2];
        }
    } 
    catch (PDOException $e) {
        if ($e->getCode() == '45000' && strpos($e->getMessage(), 'Пользователь уже добавил отзыв с такой же оценкой для этой игры') !== false) {
            echo "Ошибка: Пользователь уже добавил отзыв с такой же оценкой для этой игры";
        } else {
            echo "Произошла ошибка при выполнении операции: " . $e->getMessage();
        }
    }
}
if (isset($_POST['update_review'])) 
{
    $game_id = $_POST['game_id'];
    $new_rating = $_POST['rating'];
    $new_comment = $_POST['review'];

    // Выполните SQL-запрос для обновления отзыва
    $stmt = $conn->prepare("UPDATE reviews SET rating = :rating, comment = :comment WHERE game_id = :game_id");
    $stmt->bindParam(':game_id', $game_id, PDO::PARAM_INT);
    $stmt->bindParam(':rating', $new_rating, PDO::PARAM_INT);
    $stmt->bindParam(':comment', $new_comment, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo "Отзыв успешно обновлен.";
        $gameId = $_POST['game_id'];
        $rating = $_POST['rating'];    
        $comment = $_POST['review'];
        
        $lastRatings = $_SESSION['last_ratings'] ?? [];
        $lastReview = $_SESSION['last_review'] ?? [];
        $lastRatings[$game_id] = $rating;
        $lastReview[$game_id] = $comment;
        $_SESSION['last_ratings'] = $lastRatings;
        $_SESSION['last_review'] = $lastReview;
    } else {
        echo "Ошибка при обновлении отзыва: " . $stmt->errorInfo()[2];
    }
}
if (isset($_POST['delete_review'])) {
    $game_id = $_POST['game_id'];
    $username = $_SESSION['username'];

    try {
        $conn->beginTransaction();

        $stmt_delete_review = $conn->prepare("DELETE FROM reviews WHERE game_id = :game_id AND user_id = (SELECT user_id FROM users WHERE username = :username)");
        $stmt_delete_review->bindParam(':game_id', $game_id, PDO::PARAM_INT);
        $stmt_delete_review->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt_delete_review->execute();
        $conn->commit();
        
        echo "Отзыв и рейтинг успешно удалены.";
    } catch (PDOException $e) {
        $conn->rollBack();
        echo "Ошибка при удалении отзыва и рейтинга: " . $e->getMessage();
    }
}
if (isset($_POST['quit']))
{       
        header(header: 'location: ../game.php');
}
if (isset($_POST['profile']))
{       
        header(header: 'location: ../profile.php');
}

?>