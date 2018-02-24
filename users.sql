-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 02 2017 г., 04:55
-- Версия сервера: 5.5.50
-- Версия PHP: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `Bd`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role` enum('0','1') NOT NULL DEFAULT '0',
  `first_name` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  `avatar` varchar(256) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=174 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `first_name`, `name`, `avatar`) VALUES
(1, 'pavel', 'ef1652b79c940145b600de7a2fe0288e', '1', 'Kondratev', 'Pavel', '1.jpg'),
(115, 'sas1', 'a8a64cef262a04de4872b68b63ab7cd8', '0', 'sa_1', 'sa', 'sas1.jpg'),
(116, 'Ollegio', '202cb962ac59075b964b07152d234b70', '0', 'Ollegio', 'Oleg', 'Ollegio.jpg'),
(117, 'test', 'c4ca4238a0b923820dcc509a6f75849b', '0', 'test', 'test', 'test.jpg'),
(172, '1', 'c4ca4238a0b923820dcc509a6f75849b', '0', '1', '1', '172.jpg');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=174;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
