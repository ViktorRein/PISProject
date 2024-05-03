<!DOCTYPE html>
<html>
<head>
    <title>Список пользователей</title>
    <link rel="stylesheet" type="text/css" href="css/admin.css">
</head>
<body>
    <h1>Список пользователей</h1>

    <table>
        <?php
            include 'includes/dbpdo1.inc.php';

            // Получение списка всех пользователей
            $stmt = $conn->query("CALL GetAllUsers()");
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Перебор пользователей и создание строк таблицы
            foreach ($users as $user) {
                echo "<tr>";
                echo "<td>" . $user['username'] . "</td>";
                echo "<td>";
                echo '<form action="includes/delete_user.inc.php" method="post">';
                echo '<input type="hidden" name="user_id" value="' . $user['user_id'] . '">';
                echo '<button type="submit" class="delete-button" name="delete_user">Удалить пользователя</button>';
                echo "<button class='change-role-button'>Поменять роль на админ</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        ?>
    </table>
</body>
</html>
