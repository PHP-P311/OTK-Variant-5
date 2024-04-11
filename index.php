<?php

session_start();

if(empty($_COOKIE['id_user'])) {
    $_SESSION['errLogin'] = "Авторизуйтесь!";
    header("Location: ./login.php");
}

require_once("./db/db.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <a href="./logout.php">Выйти</a>
    <p class="create_client_p">Добавить клиента</p>

    <?php if($_COOKIE['role'] == 1){
        
    } ?>
    <?php if($_COOKIE['role'] == 2){} ?>
    <?php if($_COOKIE['role'] == 3){} ?>

    <div class="modal_create_client">
        <div class="header" style="display: flex; gap: 10px; justify-content: space-between;">
            <h2>Добавить клиента</h2>
            <input type="button" class="close_modal_create_client" value="Закрыть">
        </div>
        
        <form action="./vendor/create_client.php" method="post">
            <div class="select_types_client">
                <label><input type="radio" class="type_one" id="type_one"> ФЛ</label>
                <label><input type="radio" class="type_two" id="type_two"> ЮР</label>
            </div>
            
            <div class="form_for_one" style="display: none;">
                <div class="form_one_item">
                    <p>Email</p>
                    <input type="email" name="email" placeholder="Email">
                </div>
                <div class="form_one_item">
                    <p>ФИО</p>
                    <input type="text" name="fullname" placeholder="ФИО">
                </div>
                <div class="form_one_item">
                    <p>Серия и номер паспорта</p>
                    <input type="text" name="passport" placeholder="Серия и номер паспорта (Пример: 1111 111111)">
                </div>
                <div class="form_one_item">
                    <p>Номер телефона</p>
                    <input type="text" name="phone" placeholder="Номер телефона">
                </div>
            </div>
            <div class="form_for_two" style="display: none;">
                <div class="form_two_item">
                    <p>Название компании</p>
                    <input type="text" name="company_name" placeholder="Название компании">
                </div>
                <div class="form_two_item">
                    <p>Адрес</p>
                    <input type="text" name="address" placeholder="Адрес">
                </div>
                <div class="form_two_item">
                    <p>ИНН</p>
                    <input type="text" name="INN" placeholder="ИНН">
                </div>
                <div class="form_two_item">
                    <p>Р/С</p>
                    <input type="text" name="r/s" placeholder="Р/С">
                </div>
                <div class="form_two_item">
                    <p>БИК</p>
                    <input type="text" name="BIK" placeholder="БИК">
                </div>
                <div class="form_two_item">
                    <p>ФИО Руководителя</p>
                    <input type="text" name="fullname_director" placeholder="ФИО Руководителя">
                </div>
                <div class="form_two_item">
                    <p>ФИО контактного лица</p>
                    <input type="text" name="fullname_contact_face" placeholder="ФИО контактного лица">
                </div>
                <div class="form_two_item">
                    <p>Телефон контактного лица</p>
                    <input type="text" name="phone_contact_face" placeholder="Телефон контактного лица">
                </div>
                <div class="form_two_item">
                    <p>Email</p>
                    <input type="email" name="email" placeholder="Email">
                </div>
            </div>

            <input type="submit" class="create_client" value="Добавить" style="display: none;">
        </form>
    </div>
    <div class="overlay"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./assets/js/main.js"></script>
</body>
</html>