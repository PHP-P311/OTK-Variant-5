<?php

session_start();

if(empty($_COOKIE['id_user'])) {
    $_SESSION['errLogin'] = "Авторизуйтесь!";
    header("Location: ./login.php");
}

require_once("./db/db.php");

$select_vessels = mysqli_query($connect, "SELECT * FROM `vessels`");
$select_vessels = mysqli_fetch_all($select_vessels);
// print_r($select_vessels); // Пусто
$select_services = mysqli_query($connect, "SELECT * FROM `services`");
$select_services = mysqli_fetch_all($select_services);
// print_r($select_services); // Array ( [0] => Array ( [0] => 1 [1] => Проверка на прочность [2] => 100 ) [1] => Array ( [0] => 2 [1] => Проверка на теплоустойчивость [2] => 200 ) [2] => Array ( [0] => 3 [1] => Проверка на качество [2] => 500 ) [3] => Array ( [0] => 4 [1] => Проверка на ГОСТ [2] => 700 ) )
$select_legal_entities = mysqli_query($connect, "SELECT * FROM `legal_entities`");
$select_legal_entities = mysqli_fetch_all($select_legal_entities);
// print_r($select_legal_entities); // Array ( [0] => Array ( [0] => 1 [1] => Привет [2] => Привет [3] => 123123 [4] => 12312321 [5] => 3123123213 [6] => Иван Иванович Иванов [7] => Иван Иванович Иванов [8] => 11111111111 [9] => asd@asd ) )
$select_individuals = mysqli_query($connect, "SELECT * FROM `individuals`");
$select_individuals = mysqli_fetch_all($select_individuals);
// print_r($select_individuals); // Array ( [0] => Array ( [0] => 1 [1] => asd@asd [2] => Иван Иванович Иванов [3] => 2024-04-12 [4] => 1111 111111 [5] => 11111111111 ) )


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
    <br><br>
    <p class="create_client_p">Добавить клиента</p>
    <br>

    <div class="create_request">
        <h2>Создать заявку</h2>
        <form action="./vendor/create_request.php" class="request_form" method="post">
            <div class="request_item">
                <p>Код лабораторной посуды</p>
                <input type="text" name="vessel_code" id="vessel_code" placeholder="Код лабораторной посуды" required>
                <div class="selected_vessels">
                    <ul id="vessel_list"></ul>
                </div>
            </div>
        </form>
    </div>

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
                    <input type="email" name="email_fiz" placeholder="Email">
                </div>
                <div class="form_one_item">
                    <p>ФИО</p>
                    <input type="text" name="fullname" placeholder="ФИО">
                </div>
                <div class="form_one_item">
                    <p>Дата рождения</p>
                    <input type="date" name="birthdate">
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
                    <input type="email" name="email_yur" placeholder="Email">
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