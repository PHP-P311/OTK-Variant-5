<?php
// Подключение к базе данных и другие необходимые настройки
session_start();

if(empty($_COOKIE['id_user'])) {
    $_SESSION['errLogin'] = "Авторизуйтесь!";
    header("Location: ./login.php");
}

require_once("../db/db.php");

// Получение кода из запроса
$code = $_POST['code'];

// Выполнение запроса к базе данных для поиска по коду
// Замените следующую строку на ваш запрос к базе данных
$query = "SELECT * FROM `individuals` WHERE `fullname` LIKE '%$code%'";
$result = mysqli_query($connect, $query);

// Создание массива для хранения результатов
$response = array();

// Проверка наличия результатов
if (mysqli_num_rows($result) > 0) {
    // Если есть результаты, добавляем их в массив
    while ($row = mysqli_fetch_assoc($result)) {
        $response[] = array('fullname' => $row['fullname']);
    }
} else {
    // Если результатов нет, добавляем пустой элемент в массив
    $response[] = array('fullname' => '');
}

// Отправка результата в формате JSON
header('Content-Type: application/json');
echo json_encode($response);
