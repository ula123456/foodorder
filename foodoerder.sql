-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 17 2021 г., 18:27
-- Версия сервера: 5.7.29
-- Версия PHP: 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `foodoerder`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(95, 'ula', 'ula', '43cb6ab4a042b281ac5067a4cfc7ecfb'),
(97, '9777', '9777', '8f14e45fceea167a5a36dedd4bea2543'),
(98, '8', '8', 'c9f0f895fb98ab9159f51fd0297e236d'),
(99, 'asqar', 'gaziev', 'c4ca4238a0b923820dcc509a6f75849b');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(1, 'Burger', 'food_category347.jpg', 'Yes', 'Yes'),
(2, 'Piza', 'food_category489.jpg', 'Yes', 'Yes'),
(3, 'Momo', 'food_category456.jpg', 'Yes', 'Yes'),
(4, 'cat1', 'food_category149.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category` int(10) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category`, `featured`, `active`) VALUES
(8, 'cat2', 'dryhg', '1.00', 'food-Name-487.jpg', 1, 'No', 'No'),
(10, 'Buerger', 'Burger with Ham Peneaple and lots Cheese', '555.00', 'food_Name145.jpg', 3, 'Yes', 'Yes'),
(11, 'Momo', 'Chikcen Dumpling herbts Mountains', '1.00', 'food_Name687.jpg', 2, 'Yes', 'Yes'),
(12, 'Piza', 'Best Firewood pizza in Town', '65.00', 'food_Name802.jpg', 3, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(1, 'Burger', '56.00', 3, '168.00', '2021-05-14 06:59:34', 'Ordered', 'name', 'contact', 'mail', 'address'),
(2, 'Piza', '234.00', 5, '1170.00', '2021-05-20 10:47:59', 'Delivered', 'uma', '9799784515', 'god@wok.tu', 'Moskva'),
(3, 'Momo', '34.00', 3, '102.00', '2021-05-13 15:54:51', 'Delivered', 'Pawa', '4534534', 'erte@fg.ry', 'tashkent'),
(4, 'food', '5.00', 8, '40.00', '2021-05-13 15:58:19', 'On Deliver', 'macbooc', '4534534', 'jmh@kj.oi', 'uzbekistan'),
(5, 'Momo', '1.00', 1, '1.00', '2021-05-17 05:23:00', 'On Deliver', 'wer', '234', 'admin@gmail.com', '234'),
(6, 'Momo', '1.00', 1, '1.00', '2021-05-17 05:31:00', 'Delivered', 'wer', '234', 'admin@gmail.com', '234'),
(7, 'Buerger', '555.00', 1, '555.00', '2021-05-17 05:32:00', 'Canseled', '4', '56', 'admin@gmail.com', '542');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT для таблицы `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
