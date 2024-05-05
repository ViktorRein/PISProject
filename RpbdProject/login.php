<!DOCTYPE html>
<html>
<head>
    <title>Страница Авторизации</title>
    <link rel="stylesheet" type="text/css" href="css/log.css">
</head>
<body>
<div class="tab-content tabs" id="error">
    <?php
    if(isset($_GET['error'])) {
        if($_GET['error'] == 'invalidlogin') {
            echo '<div class="alert alert-danger" role="alert">
                Вы ошиблись в логине или пароле
          </div>';
        }
    }
    ?>
    <form id="login-form" action="includes/login.inc.php" method="post">
        <h2>Авторизация</h2>
        <label for="username">Имя:</label>
        <input type="text" id="username" name="username">

        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password">

        <button type="submit" name="submit">Авторизоваться</button>
    </form>
            <div class="login-link">
        <p>Зарегистрироваться <a href="registr.php">Регистрация</a></p>
      </div>
</div>
</body>
</html>
