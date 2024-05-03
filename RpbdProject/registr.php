<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация на сайте отзывов о видеоиграх</title>
    <link rel="stylesheet" href="css/css1.css">
</head>
<body>
    <div class="tab-content tabs" id="error">
        <?php
            if(isset($_GET['error'])) {
                $errormessage = '<div class="alert alert-danger" role="alert">%s</div>';
                if($_GET['error'] == 'emptyinput') {
                    echo sprintf($errormessage, 'Введите все поля!');
                }
                if($_GET['error'] == 'notvalidpasswoard') {
                    echo sprintf($errormessage, 'Пароль должен быть длиннее 8 символов и содержать спецзнаки');
                }
                if($_GET['error'] == 'UserExist') {
                    echo sprintf($errormessage, 'Пользователь с таким именем уже существует');
                }
            }
        ?>
    </div>

    <form action="includes\registr.inc.php" method="post">
        <h2>Регистрация</h2>
        <label for="name">Имя:</label>
        <input type="text" id="name" name="name">

        <label for="email">Электронная почта:</label>
        <input type="email" id="email" name="email">

        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password">
        <button type="submit" name="submit">Зарегистрироваться</button>
    </form>

    <div class="login-link">
        <p>Уже есть аккаунт? <a href="login.php">Войти</a></p>
    </div>
</body>
</html>
