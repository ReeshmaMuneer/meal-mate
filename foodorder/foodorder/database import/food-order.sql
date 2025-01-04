-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 22, 2024 at 05:49 PM
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
-- Database: `food-order`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

DROP TABLE IF EXISTS `tbl_admin`;
CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(12, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE IF NOT EXISTS `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(4, 'Breakfast', 'Food_Category_287.jpeg', 'Yes', 'Yes'),
(5, 'Lunch', 'Food_Category_314.jpeg', 'Yes', 'Yes'),
(6, 'Dinner', 'Food_Category_393.jpeg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

DROP TABLE IF EXISTS `tbl_food`;
CREATE TABLE IF NOT EXISTS `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(6, 'Noodles ', '', '100.00', 'Food-Name-7789.jpeg', 4, 'Yes', 'Yes'),
(11, 'parotta', '', '100.00', 'Food-Name-4428.jpeg', 4, 'Yes', 'Yes'),
(12, 'Bread', '', '60.00', 'Food-Name-9814.jpeg', 4, 'Yes', 'Yes'),
(13, 'Dosa', '', '100.00', 'Food-Name-8642.jpg', 4, 'Yes', 'Yes'),
(14, 'Rice And Curry', '', '120.00', 'Food-Name-3791.jpg', 5, 'Yes', 'Yes'),
(15, 'Fried Rice', '', '200.00', 'Food-Name-7884.jpeg', 5, 'Yes', 'Yes'),
(16, 'Biryani', '', '250.00', 'Food-Name-2064.jpg', 5, 'Yes', 'Yes'),
(19, 'koththu', '', '350.00', 'Food-Name-3691.jpeg', 6, 'Yes', 'Yes'),
(20, 'Nasi Briyani', '', '450.00', 'Food-Name-6771.jpg', 5, 'Yes', 'Yes'),
(21, 'Tea Coffee', '', '130.00', 'Food-Name-5153.jpeg', 4, 'Yes', 'Yes'),
(22, 'Sandwiches', '', '150.00', 'Food-Name-3680.webp', 4, 'Yes', 'Yes'),
(23, 'Chicken Dum biryani', '', '680.00', 'Food-Name-571.jpg', 5, 'Yes', 'Yes'),
(24, 'Roasted Chicken Biriyani', '', '880.00', 'Food-Name-334.jpg', 5, 'Yes', 'Yes'),
(25, 'Rice & Curry  ', '', '200.00', 'Food-Name-8647.jpg', 6, 'Yes', 'Yes'),
(26, 'Chicken Puttu Kottu', '', '450.00', 'Food-Name-8569.jpg', 6, 'Yes', 'Yes'),
(27, 'Mixed Puttu Kottu', '', '650.00', 'Food-Name-9364.jpg', 6, 'Yes', 'Yes'),
(28, 'Veg Kottu Paratha', '', '580.00', 'Food-Name-7920.jpg', 6, 'Yes', 'Yes'),
(29, 'Sea Food String Kottu', '', '780.00', 'Food-Name-4186.jpg', 6, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

DROP TABLE IF EXISTS `tbl_order`;
CREATE TABLE IF NOT EXISTS `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(6, 'Veg Kottu Paratha', '580.00', 1, '580.00', '2024-06-22 17:30:20', 'Delivered', 'werwew', '4423242', 'farhasaleem933@gmail.com', 'klnlnln');
COMMIT;




-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `fuculty` varchar(30) NOT NULL,
  `year` varchar(4) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `fuculty`, `year`, `email`, `password`) VALUES
(1, 'nafly', 'FOT', '2019', 'nafly@gmail.com', 'eb1322148d61a5be465d58a10cd7f6af');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
