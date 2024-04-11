-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Апр 11 2024 г., 19:37
-- Версия сервера: 10.4.28-MariaDB
-- Версия PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `otk_var_5`
--

-- --------------------------------------------------------

--
-- Структура таблицы `individuals`
--

CREATE TABLE `individuals` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `fullname` text NOT NULL,
  `birthdate` date NOT NULL,
  `passport` text NOT NULL,
  `phone` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `individuals`
--

INSERT INTO `individuals` (`id`, `email`, `fullname`, `birthdate`, `passport`, `phone`) VALUES
(1, 'asd@asd', 'Иван Иванович Иванов', '2024-04-12', '1111 111111', '11111111111');

-- --------------------------------------------------------

--
-- Структура таблицы `legal_entities`
--

CREATE TABLE `legal_entities` (
  `id` int(11) NOT NULL,
  `company_name` text NOT NULL,
  `address` text NOT NULL,
  `INN` text NOT NULL,
  `r/s` text NOT NULL,
  `BIK` text NOT NULL,
  `fullname_director` text NOT NULL,
  `fullname_contact_face` text NOT NULL,
  `phone_contact_face` text NOT NULL,
  `email_contact_face` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `legal_entities`
--

INSERT INTO `legal_entities` (`id`, `company_name`, `address`, `INN`, `r/s`, `BIK`, `fullname_director`, `fullname_contact_face`, `phone_contact_face`, `email_contact_face`) VALUES
(1, 'Привет', 'Привет', '123123', '12312321', '3123123213', 'Иван Иванович Иванов', 'Иван Иванович Иванов', '11111111111', 'asd@asd');

-- --------------------------------------------------------

--
-- Структура таблицы `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `vessel_id` int(11) NOT NULL,
  `id_service` text NOT NULL,
  `id_client` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `requests`
--

INSERT INTO `requests` (`id`, `vessel_id`, `id_service`, `id_client`) VALUES
(1, 1, '1', 1),
(2, 2, '1', 1),
(3, 2, '2', 1),
(4, 2, '1, 2, 3, 4', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_general_ci;

--
-- Дамп данных таблицы `services`
--

INSERT INTO `services` (`id`, `service_name`, `price`) VALUES
(1, 'Проверка на прочность', 100),
(2, 'Проверка на теплоустойчивость', 200),
(3, 'Проверка на качество', 500),
(4, 'Проверка на ГОСТ', 700);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `role`, `login`, `password`) VALUES
(1, 1, 'manager', 'manager'),
(2, 2, 'assistant', 'assistant'),
(3, 3, 'controller', 'controller');

-- --------------------------------------------------------

--
-- Структура таблицы `vessels`
--

CREATE TABLE `vessels` (
  `id` int(11) NOT NULL,
  `vessel_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `vessels`
--

INSERT INTO `vessels` (`id`, `vessel_name`) VALUES
(1, 'asd'),
(2, 'авпрв');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `individuals`
--
ALTER TABLE `individuals`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `legal_entities`
--
ALTER TABLE `legal_entities`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `vessels`
--
ALTER TABLE `vessels`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `individuals`
--
ALTER TABLE `individuals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `legal_entities`
--
ALTER TABLE `legal_entities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `vessels`
--
ALTER TABLE `vessels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
