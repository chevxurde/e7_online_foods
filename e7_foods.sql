-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 26, 2024 at 12:17 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e7_foods`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(1, 'admin', '123'),
(9, 'Mengsrun', '1111'),
(10, 'Hong', '8888'),
(11, 'xurde', '1111');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) DEFAULT NULL,
  `pid` int(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `qty` int(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `price` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `number` varchar(100) DEFAULT NULL,
  `message` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(1, 3, 'Mengsrun', 'mengsrun99@gmail.com', '099887766', 'Hi there! I&#39;m here looking for some good foods, Could you help me?');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `number` varchar(12) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `method` varchar(50) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `total_products` varchar(1000) DEFAULT NULL,
  `total_price` int(100) DEFAULT NULL,
  `placed_on` datetime DEFAULT CURRENT_TIMESTAMP,
  `payment_status` varchar(20) DEFAULT 'pending',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(4, 4, 'tengteng', '088888555', 'tengteng8888@gmail.com', 'paypal', 'Street58, Blvdâ€‹ Hanoi, Sen Sok, Phnom Penh', 'drink 01 (4 x 3) - pizza 02 (6 x 4) - main dish 02 (15 x 2) - ', 66, '2024-04-26 04:02:35', 'pending'),
(5, 4, 'tengteng', '088888555', 'tengteng8888@gmail.com', 'paytm', 'Street58, Blvdâ€‹ Hanoi, Sen Sok, Phnom Penh', 'main dish 01 (10 x 2) - drink 02 (3 x 2) - ', 26, '2024-04-26 04:03:52', 'completed'),
(6, 4, 'tengteng', '088888555', 'tengteng8888@gmail.com', 'credit card', 'Street58, Blvdâ€‹ Hanoi, Sen Sok, Phnom Penh', 'drink 01 (4 x 1) - main dish 02 (15 x 2) - ', 34, '2024-04-26 05:06:04', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `price` int(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`, `image`) VALUES
(2, 'pizza 01', 'fast food', 50, 'pizza-1.png'),
(3, 'pizza 02', 'fast food', 6, 'pizza-2.png'),
(4, 'main dish 01', 'main dish', 10, 'dish-1.png'),
(5, 'main dish 02', 'main dish', 15, 'dish-2.png'),
(6, 'drink 01', 'drinks', 4, 'drink-1.png'),
(7, 'drink 02', 'drinks', 3, 'drink-2.png'),
(8, 'dessert 01', 'desserts', 7, 'dessert-1.png'),
(9, 'dessert 02', 'desserts', 5, 'dessert-2.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(12) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `number`, `password`, `address`) VALUES
(2, 'henghong', 'hong8899@gmail.com', '099887766', 'fea7f657f56a2a448da7d4b535ee5e279caf3d9a', 'Street58, Blvdâ€‹ Hanoi, Sen Sok, Phnom Penh'),
(3, 'Xurde', 'xurde9889@gmail.com', '077889999', '92f2fd99879b0c2466ab8648afb63c49032379c1', 'Street58, Blvdâ€‹ Hanoi, Sen Sok, Phnom Penh'),
(4, 'tengteng', 'tengteng8888@gmail.com', '088888555', '0ddb5877c896f43e8734e10b001e7f1eb92889cd', 'Street58, Blvdâ€‹ Hanoi, Sen Sok, Phnom Penh');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
