-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3307
-- Время создания: Фев 03 2020 г., 16:12
-- Версия сервера: 5.6.43-log
-- Версия PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `basket`
--

CREATE TABLE `basket` (
  `id` int(11) NOT NULL,
  `product_id` varchar(11) DEFAULT NULL,
  `count` varchar(45) DEFAULT NULL,
  `session_id` varchar(45) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_id` varchar(11) DEFAULT NULL,
  `is_in_order` tinyint(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `basket`
--

INSERT INTO `basket` (`id`, `product_id`, `count`, `session_id`, `price`, `user_id`, `order_id`, `is_in_order`) VALUES
(1, '2', '1', 'lk8cp65p4bm31dahlvqndusbvkfa1jnk', NULL, NULL, NULL, NULL),
(2, '3', '1', 'tegtthul8uap15pbtt4aakhu15hjfku7', NULL, NULL, NULL, NULL),
(43, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` text,
  `price` int(7) DEFAULT NULL,
  `img` varchar(45) DEFAULT NULL,
  `category` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `img`, `category`) VALUES
(1, 'Яблоки', 'Красные', 55, 'apples.jpg', 'fruits'),
(2, 'Груши', 'Сладкие', 60, 'pears.jpg', 'fruits'),
(3, 'Бананы', 'Жёлтые', 45, 'bananas.jpg', 'fruits'),
(4, 'Хлеб', 'Кирпич', 25, 'bread.jpg', 'bakery'),
(5, 'Пирожные', 'Цветные', 25, 'cake_mini.jpg', 'bakery'),
(6, 'Помидоры', 'Турецкие', 50, 'tomatos.jpg', 'vegetables'),
(7, 'Огурцы', 'Пупырчатые', 45, 'cucumbers.jpg', 'vegetables'),
(13, 'Тестовый продукт', 'необычный', 600, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(32) NOT NULL,
  `pass` varchar(45) DEFAULT NULL,
  `hash` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `pass`, `hash`) VALUES
(1, 'admin', '123', NULL),
(2, 'john', '123', NULL),
(3, 'alex', '123', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
