<!DOCTYPE html>
<html>
<head>
    <title>Активность</title>
    <link rel="stylesheet" type="text/css" href="admin.css">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Активность</h1>

    <table>
        <tr>
            <th>Таблица</th>
            <th>Действие</th>
            <th>Старые данные</th>
            <th>Новые данные</th>
            <th>Дата и время</th>
        </tr>
        <?php
        include 'includes/dbpdo1.inc.php';
        $query = "SELECT * FROM audit";
        $stmt = $conn->query($query);

        // Шаблон строки таблицы
        $rowTemplate = "<tr>
                            <td>%s</td>
                            <td>%s</td>
                            <td>%s</td>
                            <td>%s</td>
                            <td>%s</td>
                        </tr>";

        // Перебор результатов и создание строк таблицы
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $table = $row['table_name'];
            $action = $row['action_type'];
            $oldData = $row['old_data'];
            $newData = $row['new_data'];
            $changeTime = $row['change_time'];

            // Форматирование данных и добавление строки в таблицу
            $formattedRow = sprintf($rowTemplate, $table, $action, $oldData, $newData, $changeTime);
            echo $formattedRow;
        }
        ?>
    </table>
</body>
</html>