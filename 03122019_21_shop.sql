-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Апр 13 2020 г., 12:49
-- Версия сервера: 10.4.11-MariaDB
-- Версия PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `03122019_21_shop`
--
CREATE DATABASE IF NOT EXISTS `03122019_21_shop` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `03122019_21_shop`;

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Женщинам'),
(2, 'Мужчинам'),
(3, 'Детям'),
(4, 'Новинки');

-- --------------------------------------------------------

--
-- Структура таблицы `orders_detail`
--

CREATE TABLE IF NOT EXISTS `orders_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orders_list_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_size` int(11) NOT NULL,
  `product_size_amount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders_detail`
--

INSERT INTO `orders_detail` (`id`, `orders_list_id`, `product_id`, `product_size`, `product_size_amount`) VALUES
(5, 7, 0, 40, 1),
(6, 7, 0, 41, 1),
(7, 7, 1, 50, 1),
(8, 7, 2, 34, 4),
(9, 7, 2, 35, 1),
(10, 8, 0, 41, 1),
(11, 9, 0, 48, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `orders_list`
--

CREATE TABLE IF NOT EXISTS `orders_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `adress` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `mail-index` int(11) NOT NULL,
  `payment` varchar(20) NOT NULL,
  `price` int(11) NOT NULL,
  `service` int(11) NOT NULL,
  `full-price` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders_list`
--

INSERT INTO `orders_list` (`id`, `name`, `lastname`, `phone`, `email`, `adress`, `city`, `mail-index`, `payment`, `price`, `service`, `full-price`) VALUES
(7, 'Иван', 'Петров', '84995525423', 'ivan@mail.ru', '5-ая улица Строителей', 'Москва', 112111, 'card', 21500, 500, 22000),
(8, 'Петр', 'Иванов', '89035214524', 'pishma@mail.ru', 'Болотная улица, д.5', 'Верхние Пупки', 665523, 'card', 999, 500, 1499),
(9, 'Иван', 'Грозный', '89262265125', 'tsar@azesm.ru', 'Палаты', 'Москва', 111111, 'card', 13500, 500, 14000);

-- --------------------------------------------------------

--
-- Структура таблицы `price_range`
--

CREATE TABLE IF NOT EXISTS `price_range` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `min` int(11) NOT NULL,
  `max` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `price_range`
--

INSERT INTO `price_range` (`id`, `min`, `max`) VALUES
(1, 0, 1000),
(2, 1000, 3000),
(3, 3000, 5000),
(4, 5000, 10000);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img_url` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `add_date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `img_url`, `name`, `description`, `type`, `price`, `add_date`) VALUES
(1, '/images/catalog/1.jpg', 'Куртка', 'Ой какая красивая куртка', 'Верхняя одежда', 4500, '2020-04-10 15:35:35'),
(2, '/images/catalog/9.jpg', 'Кеды', 'Хорошие кеды', 'Обувь', 999, '2020-04-10 15:24:47'),
(3, '/images/catalog/2.jpg', 'Куртка', 'Ой какая красивая куртка', 'Верхняя одежда', 2500, '2020-04-10 15:24:47'),
(4, '/images/catalog/8.jpg', 'Кеды', 'Хорошие кеды', 'Обувь', 3000, '2020-04-10 15:24:47'),
(5, '/images/catalog/3.png', 'Куртка', 'Ой какая красивая куртка', 'Верхняя одежда', 4500, '2020-04-10 15:24:47'),
(6, '/images/catalog/9.jpg', 'Кеды', 'Хорошие кеды', 'Обувь', 999, '2020-04-10 15:24:47'),
(7, '/images/catalog/4.jpg', 'Куртка', 'Ой какая красивая куртка', 'Верхняя одежда', 500, '2020-04-10 15:24:47'),
(8, '/images/catalog/10.jpg', 'Кеды', 'Хорошие кеды', 'Обувь', 3000, '2020-04-10 15:24:47'),
(9, '/images/catalog/4.jpg', 'Куртка кожаная', 'Ой какая красивая куртка', 'Верхняя одежда', 4500, '2020-04-10 15:24:47'),
(10, '/images/catalog/10.jpg', 'Ботинки', 'Качественные ботинки', 'Обувь', 2999, '2020-04-10 15:24:47'),
(11, '/images/catalog/6.jpg', 'Куртка', 'Ой какая красивая куртка', 'Верхняя одежда', 999, '2020-04-10 15:24:47'),
(12, '/images/catalog/11.jpg', 'Джинсы', 'Хорошие джинсы', 'Джинсы', 3000, '2020-04-10 15:24:47'),
(13, '/images/catalog/5.jpg', 'Куртка', 'Ой какая красивая куртка', 'Верхняя одежда', 4500, '2020-04-10 15:24:47'),
(14, '/images/catalog/12.jpg', 'Джинсы', 'Хорошие джинсы', 'Джинсы', 3999, '2020-04-10 15:24:47'),
(15, '/images/catalog/1.jpg', 'Куртка', 'Ой какая красивая куртка', 'Верхняя одежда', 500, '2020-04-10 15:24:47'),
(16, '/images/catalog/9.jpg', 'Кеды', 'Хорошие кеды', 'Обувь', 3000, '2020-04-10 15:24:47'),
(24, '/images/catalog/5.jpg', 'Жилетка', 'Очень годная жилетка', 'Верхняя одежда', 2000, '2020-04-10 18:40:30');

-- --------------------------------------------------------

--
-- Структура таблицы `product_category`
--

CREATE TABLE IF NOT EXISTS `product_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product_category`
--

INSERT INTO `product_category` (`id`, `product_id`, `category_id`) VALUES
(1, 1, 2),
(2, 2, 1),
(3, 2, 2),
(4, 3, 1),
(5, 4, 3),
(6, 5, 1),
(7, 6, 1),
(8, 7, 1),
(9, 8, 1),
(10, 9, 1),
(11, 10, 1),
(12, 12, 1),
(13, 13, 1),
(14, 14, 1),
(15, 15, 1),
(16, 16, 1),
(17, 11, 1),
(32, 22, 3),
(33, 23, 3),
(34, 24, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `product_sizes`
--

CREATE TABLE IF NOT EXISTS `product_sizes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `product_sizes` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product_sizes`
--

INSERT INTO `product_sizes` (`id`, `product_id`, `product_sizes`) VALUES
(1, 1, '[43,44,45,46]'),
(2, 2, '[41,42,43]'),
(3, 3, '[42,44,46,47,48,49,50,51,52,58]'),
(4, 4, '[38,39,40,41,44,45]'),
(5, 5, '[46,48,50,52,54,56]'),
(6, 6, '[34,37,38,41,43,44]'),
(7, 7, '[48,52,54,56,58]'),
(8, 8, '[34,35,42,43,44,45,46]'),
(9, 9, '[48,50,52,54]'),
(10, 10, '[34,38,39,41,42,43,44]'),
(11, 11, '[42,44,50,52,56,58]'),
(12, 12, '[43,44,45]'),
(13, 13, '[46,52,54,58]'),
(14, 14, '[41,42,43,44,45,46]'),
(15, 15, '[42,44,45,47,48,50,54,56,58]'),
(16, 16, '[38,39,40,41,42,45]'),
(17, 24, '[38,39,40]');

-- --------------------------------------------------------

--
-- Структура таблицы `subscribers`
--

CREATE TABLE IF NOT EXISTS `subscribers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subscriber` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `subscribers`
--

INSERT INTO `subscribers` (`id`, `subscriber`) VALUES
(81, 'asd@sad'),
(82, 'asd@asdasd'),
(83, 'asd@asd');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `is_admin`) VALUES
(7, 'Михаил', 'Борунов', 'borunow.m@gmail.com', 'prfqPTTTRUVLc', 1),
(8, 'Михаил', 'Студицкий', 'studitskiymv@yandex.ru', 'prfqPTTTRUVLc', 1),
(10, 'San', 'E4ek', 'awesom@awesome.com', 'prfqPTTTRUVLc', 1),
(11, 'test', 'test', 'test@test', 'prfqPTTTRUVLc', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
