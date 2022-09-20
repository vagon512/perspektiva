-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 20 2022 г., 14:09
-- Версия сервера: 8.0.19
-- Версия PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `perspektiva`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `user_sirname` char(50) NOT NULL,
  `user_name` char(50) NOT NULL,
  `user_patronymic` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_login` char(30) NOT NULL,
  `user_email` text NOT NULL,
  `user_birthday` date NOT NULL,
  `user_password` text NOT NULL,
  `salt` text NOT NULL,
  `user_privileges` int NOT NULL DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `user_sirname`, `user_name`, `user_patronymic`, `user_login`, `user_email`, `user_birthday`, `user_password`, `salt`, `user_privileges`) VALUES
(1, 'Ivanov', 'Ivan', 'Ivanovich', 'm_9001', 'ivan@ii.ii', '2022-09-08', '$2y$10$0YAoRkMp6ZKVKR4mGmAHqegD4.BiyBtA2jexPcCVWcFa2wllDRcMO', 'l;k;kasjdfj;as', 3),
(2, 'petrov', 'petr', 'petrovich', 'm_9009', 'ppp@pp.pp', '1995-12-09', '$2y$10$ghphSPtH59gwRmdVL393AuVvM.jlmRYd//Lg7uyj8OrqJEjK8EPG2', 'l;k;kasjdfj;as', 3),
(3, 'Ivanov', 'petr', 'Ivanovich', 'User175', 'pp33p@pp.pp', '1988-05-09', '$2y$10$vyhRO1UxUtlRd/JBwjR4buYxFaTwLVo5CvE53xswnK.bYYUxY8DC6', 'l;k;kasjdfj;as', 3),
(4, 'Sidorov', 'Sidr', 'Sidorovich', 'sidr', 'ss@ss.ss', '1988-05-12', '$2y$10$RZwBkra6xQ5cdOI4u/OO8eO3ghPLyaKzRAF5nGpqzX7AaBaJJ2dkK', 'l;k;kasjdfj;as', 3);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
