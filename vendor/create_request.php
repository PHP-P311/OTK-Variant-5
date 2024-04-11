<?php
session_start(); // Начинаем сессию для работы с сессионными переменными

if(empty($_COOKIE['id_user'])) { // Проверяем, есть ли у пользователя кука с идентификатором
    $_SESSION['errLogin'] = "Авторизуйтесь!"; // Устанавливаем сообщение об ошибке в сессионную переменную
    header("Location: ./login.php"); // Перенаправляем пользователя на страницу входа
}

require_once("../db/db.php"); // Подключаем файл с настройками базы данных

$vessel_code = $_POST['vessel_code']; // Получаем код сосуда из формы

// Проверяем, существует ли сосуд с таким кодом в базе данных
$select_vessel = mysqli_query($connect, "SELECT `id` FROM `vessels` WHERE `vessel_name`='$vessel_code'");
$select_vessel = mysqli_fetch_assoc($select_vessel);

if(empty($select_vessel)) { // Если сосуд не найден в базе данных
    mysqli_query($connect, "INSERT INTO `vessels` (`vessel_name`) VALUES ('$vessel_code')"); // Вставляем новый сосуд
    $select_vessel = mysqli_insert_id($connect); // Получаем идентификатор только что вставленного сосуда
} else { // Если сосуд найден в базе данных
    $select_vessel = $select_vessel['id']; // Получаем идентификатор сосуда
}

$service = $_POST['service']; // Получаем выбранные услуги из формы

// Проверяем количество выбранных услуг
if (count($service) == 1) {
    // Если выбрана только одна услуга, оставляем ее без разделения
    $service = $service[0];
} else {
    // Если выбрано несколько услуг, преобразуем массив в строку, разделенную запятыми
    $service = implode(', ', $service);
}

// Проверяем, заполнено ли поле "ФИО клиента" или "Название компании"
if (!empty($_POST['fullname'])) { // Если заполнено поле "ФИО клиента"
    // Получаем ФИО клиента из формы
    $fullname = $_POST['fullname'];
    // Проверяем, существует ли клиент с таким ФИО в базе данных
    $select_client = mysqli_query($connect, "SELECT `id` FROM `individuals` WHERE `fullname`='$fullname'");
    $select_client = mysqli_fetch_assoc($select_client);
    $select_client = $select_client['id']; // Получаем идентификатор клиента

    // Вставляем новую заявку в базу данных
    mysqli_query($connect, "INSERT INTO `requests` (`vessel_id`, `id_service`, `id_client`)
                            VALUES ('$select_vessel', '$service', '$select_client')");
    
    header("Location: ../index.php"); // Перенаправляем пользователя на главную страницу
} elseif (!empty($_POST['company_name'])) { // Если заполнено поле "Название компании"
    // Получаем название компании из формы
    $company_name = $_POST['company_name'];
    // Проверяем, существует ли компания с таким названием в базе данных
    $select_client = mysqli_query($connect, "SELECT `id` FROM `legal_entities` WHERE `company_name`='$company_name'");
    $select_client = mysqli_fetch_assoc($select_client);
    $select_client = $select_client['id']; // Получаем идентификатор компании

    // Вставляем новую заявку в базу данных
    mysqli_query($connect, "INSERT INTO `requests` (`vessel_id`, `id_service`, `id_client`)
                            VALUES ('$select_vessel', '$service', '$select_client')");
    
    header("Location: ../index.php"); // Перенаправляем пользователя на главную страницу
} else {
    header("Location: ../index.php"); // Перенаправляем пользователя на главную страницу
}
