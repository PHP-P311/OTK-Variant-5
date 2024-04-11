<?php
session_start(); // Начинаем сессию для работы с сессионными переменными

if(empty($_COOKIE['id_user'])) { // Проверяем, есть ли у пользователя кука с идентификатором
    $_SESSION['errLogin'] = "Авторизуйтесь!"; // Устанавливаем сообщение об ошибке в сессионную переменную
    header("Location: ./login.php"); // Перенаправляем пользователя на страницу входа
}

require_once("../db/db.php"); // Подключаем файл с настройками базы данных

$vessel_code = $_POST['vessel_code'];
$select_vessel = mysqli_query($connect, "SELECT `id` FROM `vessels` WHERE `vessel_name`='$vessel_code'");
$select_vessel = mysqli_fetch_assoc($select_vessel);
if(empty($select_vessel)) {
    mysqli_query($connect, "INSERT INTO `vessels` (`vessel_name`) VALUES ('$vessel_code')");
    $select_vessel = mysqli_insert_id($connect);
} else {
    $select_vessel = $select_vessel['id'];
}

$service = $_POST['service'];
// Проверка количества элементов в массиве
if (count($service) == 1) {
    // Если в массиве только один элемент, выводим его без разделения запятыми
    $service = $service[0];
} else {
    // Если в массиве несколько элементов, преобразуем его в строку, разделенную запятыми
    $service = implode(', ', $service);
}

// Проверка наличия значения fullname и company_name
if (!empty($_POST['fullname'])) {
    // Если fullname не пустое, делаем одно действие
    $fullname = $_POST['fullname'];
    $select_client = mysqli_query($connect, "SELECT `id` FROM `individuals` WHERE `fullname`='$fullname'");
    $select_client = mysqli_fetch_assoc($select_client);
    $select_client = $select_client['id'];

    mysqli_query($connect, "INSERT INTO `requests`
                            (`vessel_id`, `id_service`, `id_client`)
                            VALUES
                            ('$select_vessel', '$service', '$select_client')");
    
    header("Location: ../index.php");
} elseif (!empty($_POST['company_name'])) {
    // Если company_name не пустое, делаем другое действие
    $company_name = $_POST['company_name'];
    $select_client = mysqli_query($connect, "SELECT `id` FROM `legal_entities` WHERE `company_name`='$company_name'");
    $select_client = mysqli_fetch_assoc($select_client);
    $select_client = $select_client['id'];

    mysqli_query($connect, "INSERT INTO `requests`
                            (`vessel_id`, `id_service`, `id_client`)
                            VALUES
                            ('$select_vessel', '$service', '$select_client')");
    
    header("Location: ../index.php");
} else {
    header("Location: ../index.php");
}

