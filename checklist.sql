-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 24 2021 г., 17:16
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `checklist_test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `checklist`
--

CREATE TABLE `checklist` (
  `user_id` int(11) NOT NULL,
  `user_login` varchar(30) NOT NULL,
  `item_name` varchar(32) NOT NULL,
  `item_child1` varchar(32) NOT NULL,
  `item_child2` varchar(32) NOT NULL,
  `item_child3` varchar(32) NOT NULL,
  `item_child4` varchar(32) NOT NULL,
  `item_child5` varchar(32) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_desc` mediumtext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `checklist`
--

INSERT INTO `checklist` (`user_id`, `user_login`, `item_name`, `item_child1`, `item_child2`, `item_child3`, `item_child4`, `item_child5`, `item_id`, `item_desc`) VALUES
(1, 'admin', 'n', 'no', 'no', 'n', 'n', 'n', 1, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto cum cupiditate doloremque eligendi id iure libero mollitia odit optio, pariatur saepe sed, ullam unde veniam!'),
(2, 'user', 'no', 'no', 'no', 'no', 'no', 'no', 1, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto cum cupiditate doloremque eligendi id iure libero mollitia odit optio, pariatur saepe sed, ullam unde veniam!'),
(1, 'admin', 'n', 'n', 'n', 'no', 'no', 'n', 2, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto cum cupiditate doloremque eligendi id iure libero mollitia odit optio, pariatur saepe sed, ullam unde veniam!');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
