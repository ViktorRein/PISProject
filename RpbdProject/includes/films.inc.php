<?php
    require_once 'function1.inc.php';
    require_once 'dbpdo1.inc.php';
    session_start();
if (isset($_POST['submit'])) {
    $username = $_SESSION['username'];
    $film_id = $_POST['film_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['review'];
    $timestamp = date('Y-m-d H:i:s');

    try {
        $stmtReview = $conn->prepare("CALL AddFilmsReview(:username, :film_id, :rating, :comment, :timestamp)");
        $stmtReview->bindParam(':username', $username, PDO::PARAM_STR);
        $stmtReview->bindParam(':film_id', $film_id, PDO::PARAM_INT);
        $stmtReview->bindParam(':rating', $rating, PDO::PARAM_INT);
        $stmtReview->bindParam(':comment', $comment, PDO::PARAM_STR);
        $stmtReview->bindParam(':timestamp', $timestamp, PDO::PARAM_STR);

        if ($stmtReview->execute()) {
            echo "Отзыв успешно добавлен. ";
            $gameId = $_POST['film_id'];
            $rating = $_POST['rating'];
            $comment = $_POST['review'];
        } else {
            echo "Ошибка при добавлении отзыва: " . $stmtReview->errorInfo()[2];
        }
    } catch (PDOException $e) {
        if ($e->getCode() == '45000' && strpos($e->getMessage(), 'Пользователь уже добавил отзыв с такой же оценкой для этого сериала') !== false) {
            echo "Ошибка: Пользователь уже добавил отзыв с такой же оценкой для этого сериала";
        } else {
            echo "Произошла ошибка при выполнении операции: " . $e->getMessage();
        }
    }
}
if (isset($_POST['update_review'])) 
{
    $film_id = $_POST['film_id'];
    $new_rating = $_POST['rating'];
    $new_comment = $_POST['review'];

    $stmt = $conn->prepare("UPDATE films_reviews SET rating = :rating, comment = :comment WHERE film_id = :film_id");
    $stmt->bindParam(':film_id', $film_id, PDO::PARAM_INT);
    $stmt->bindParam(':rating', $new_rating, PDO::PARAM_INT);
    $stmt->bindParam(':comment', $new_comment, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo "Отзыв успешно обновлен.";
        $gameId = $_POST['film_id'];
        $rating = $_POST['rating'];    
        $comment = $_POST['review'];
        
    } else {
        echo "Ошибка при обновлении отзыва: " . $stmt->errorInfo()[2];
    }
}
if (isset($_POST['delete_review'])) {
    $film_id = $_POST['film_id'];
    $username = $_SESSION['username'];

    try {
        $conn->beginTransaction();

        $stmt_delete_review = $conn->prepare("DELETE FROM films_reviews WHERE film_id = :film_id AND user_id = (SELECT user_id FROM users WHERE username = :username)");
        $stmt_delete_review->bindParam(':film_id', $film_id, PDO::PARAM_INT);
        $stmt_delete_review->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt_delete_review->execute();
        $conn->commit();
        
        echo "Отзыв успешно удалены.";
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