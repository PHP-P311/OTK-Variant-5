<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="container_content">
            <h2>Авторизация</h2>
            <form action="" method="post" class="auth_form">
                <div class="auth_form_item">
                    <p>Логин</p>
                    <input type="text" name="login" placeholder="Логин" required>
                </div>
                <div class="auth_form_item">
                    <p>Пароль</p>
                    <input type="password" id="password-input" placeholder="Пароль" name="password" required>
                    <label><input type="checkbox" class="password-checkbox"> Показать пароль</label>
                </div>
                <div class="auth_form_button">
                    <input type="submit" value="Войти">
                </div>
            </form>
            <br>
            <a href="./reg.php">Зарегистрироваться</a>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./assets/js/main.js"></script>
</body>
</html>