<?php

session_start(); // Начинаем сессию для работы с сессионными переменными

if(empty($_COOKIE['id_user'])) { // Проверяем, есть ли у пользователя кука с идентификатором
    $_SESSION['errLogin'] = "Авторизуйтесь!"; // Устанавливаем сообщение об ошибке в сессионную переменную
    header("Location: ./login.php"); // Перенаправляем пользователя на страницу входа
}

require_once("../db/db.php"); // Подключаем файл с настройками базы данных

var_dump($_POST); // Выводим содержимое массива $_POST для отладки (может быть удалено в продакшене)

// Проверяем наличие значений для определенных ключей
if (!empty($_POST['email_fiz']) && !empty($_POST['fullname']) && !empty($_POST['birthdate']) && !empty($_POST['passport']) && !empty($_POST['phone'])) {
    // Если значения для email_fiz, fullname, passport и phone есть, выполняется один блок кода
    $email = $_POST['email_fiz'];
    $fullname = $_POST['fullname'];
    $birthdate = $_POST['birthdate'];
    $passport = $_POST['passport'];
    $phone = $_POST['phone'];

    // Формируем запрос для поиска клиента в таблице individuals
    $query = "SELECT * FROM `individuals` WHERE `email`='$email'
          UNION
          SELECT * FROM `individuals` WHERE `fullname`='$fullname'
          UNION
          SELECT * FROM `individuals` WHERE `birthdate`='$birthdate'
          UNION
          SELECT * FROM `individuals` WHERE `passport`='$passport'
          UNION
          SELECT * FROM `individuals` WHERE `phone`='$phone'";

    // Выполняем запрос к базе данных
    $select_client = mysqli_query($connect, $query);
    $select_client = mysqli_fetch_assoc($select_client);

    // Проверяем, найден ли клиент
    if(!empty($select_client)) {
        header("Location: ../index.php"); // Перенаправляем пользователя на главную страницу
    } else {
        // Если клиент не найден, выполняем вставку данных о клиенте в таблицу individuals
        mysqli_query($connect, "INSERT INTO `individuals` 
                                (`email`, `fullname`, `birthdate`, `passport`, `phone`)
                                VALUES
                                ('$email','$fullname','$birthdate','$passport','$phone')
        ");

        header("Location: ../index.php"); // Перенаправляем пользователя на главную страницу
    }
    
} elseif(!empty($_POST['company_name']) && !empty($_POST['address']) && !empty($_POST['INN']) && !empty($_POST['r/s']) && !empty($_POST['BIK']) && !empty($_POST['fullname_director']) && !empty($_POST['fullname_contact_face']) && !empty($_POST['phone_contact_face']) && !empty($_POST['email_yur'])) {
    // Если значения для других ключей также присутствуют, выполняется другой блок кода
    $company_name = $_POST['company_name'];
    $address = $_POST['address'];
    $INN = $_POST['INN'];
    $rs = $_POST['r/s'];
    $BIK = $_POST['BIK'];
    $fullname_director = $_POST['fullname_director'];
    $fullname_contact_face = $_POST['fullname_contact_face'];
    $phone_contact_face = $_POST['phone_contact_face'];
    $email_yur = $_POST['email_yur'];

    // Формируем запрос для поиска клиента в таблице legal_entities
    $query = "SELECT * FROM `legal_entities` WHERE `company_name`='$company_name'
          UNION
          SELECT * FROM `legal_entities` WHERE `address`='$address'
          UNION
          SELECT * FROM `legal_entities` WHERE `INN`='$INN'
          UNION
          SELECT * FROM `legal_entities` WHERE `r/s`='$rs'
          UNION
          SELECT * FROM `legal_entities` WHERE `BIK`='$BIK'
          UNION
          SELECT * FROM `legal_entities` WHERE `fullname_director`='$fullname_director'
          UNION
          SELECT * FROM `legal_entities` WHERE `fullname_contact_face`='$fullname_contact_face'
          UNION
          SELECT * FROM `legal_entities` WHERE `phone_contact_face`='$phone_contact_face'
          UNION
          SELECT * FROM `legal_entities` WHERE `email_contact_face`='$email_yur'";

    // Выполняем запрос к базе данных
    $select_client = mysqli_query($connect, $query);
    $select_client = mysqli_fetch_assoc($select_client);

    // Проверяем, найден ли клиент
    if(!empty($select_client)) {
        header("Location: ../index.php"); // Перенаправляем пользователя на главную страницу
    } else {
        // Если клиент не найден, выполняем вставку данных о клиенте в таблицу legal_entities
        mysqli_query($connect, "INSERT INTO `legal_entities` 
                                (`company_name`, `address`, `INN`, `r/s`, `BIK`, `fullname_director`, `fullname_contact_face`, `phone_contact_face`, `email_contact_face`)
                                VALUES
                                ('$company_name','$address','$INN','$rs','$BIK','$fullname_director','$fullname_contact_face','$phone_contact_face','$email_yur')
        ");

        header("Location: ../index.php"); // Перенаправляем пользователя на главную страницу
    }

    echo "Данные для юридического лица присутствуют"; // Этот текст никогда не будет выведен, так как сразу происходит перенаправление
} else {
    header("Location: ../index.php"); // Перенаправляем пользователя на главную страницу, если не были получ
}
