-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 07, 2023 at 03:22 AM
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
-- Database: `spaza`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `product_id` int(60) NOT NULL,
  `user_id` int(60) NOT NULL,
  `store_id` int(60) NOT NULL,
  `quantity` int(2) NOT NULL,
  `time_added` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `user_id`, `store_id`, `quantity`, `time_added`) VALUES
(2, 1, 1, 1, 24, '2023-09-04 17:34:06'),
(3, 2, 1, 1, 9, '2023-09-04 14:52:22'),
(4, 2, 1, 2, 4, '2023-09-06 17:12:05'),
(5, 4, 1, 2, 2, '2023-09-06 17:10:46'),
(6, 5, 1, 2, 3, '2023-09-06 17:10:58');

-- --------------------------------------------------------

--
-- Table structure for table `csv_uploads_for_product_creation`
--

DROP TABLE IF EXISTS `csv_uploads_for_product_creation`;
CREATE TABLE IF NOT EXISTS `csv_uploads_for_product_creation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `csv` text NOT NULL,
  `time_uploaded` datetime NOT NULL,
  `uploaded_by` int(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `csv_uploads_for_product_creation`
--

INSERT INTO `csv_uploads_for_product_creation` (`id`, `csv`, `time_uploaded`, `uploaded_by`) VALUES
(1, '1753123product_import_sales_channels_edit3.csv', '2023-09-01 16:18:49', 1),
(2, '75123product_import_sales_channels_edit3.csv', '2023-09-01 16:19:37', 1),
(3, '7701123product_import_sales_channels_edit3.csv', '2023-09-01 16:21:11', 1),
(4, '4395123product_import_sales_channels_edit3.csv', '2023-09-01 16:22:38', 1),
(5, '6850123product_import_sales_channels_edit3.csv', '2023-09-01 16:43:33', 1),
(6, '4217123product_import_sales_channels_edit3.csv', '2023-09-01 16:43:49', 1),
(7, '8907123product_import_sales_channels_edit3.csv', '2023-09-01 16:44:58', 1),
(8, '8311123product_import_sales_channels_edit3.csv', '2023-09-01 16:46:57', 1),
(9, '7410123product_import_sales_channels_edit3.csv', '2023-09-01 16:48:29', 1),
(10, '8147123product_import_sales_channels_edit3.csv', '2023-09-01 16:55:11', 1),
(11, '3775business-operations-survey-2022-business-finance.csv', '2023-09-01 16:58:24', 1),
(12, '8827123product_import_sales_channels_edit3.csv', '2023-09-01 17:01:02', 1),
(13, '4591business-operations-survey-2022-business-finance.csv', '2023-09-01 17:02:17', 1),
(14, '2151123product_import_sales_channels_edit3.csv', '2023-09-01 17:08:08', 1),
(15, '6516bbaaazzz.csv', '2023-09-04 21:35:54', 1),
(16, '9119bbaaazzz.csv', '2023-09-04 21:37:28', 1),
(17, '4220bbaaazzz.csv', '2023-09-04 21:39:28', 1),
(18, '4804bbaaazzz.csv', '2023-09-04 21:42:49', 1),
(19, '8523bbaaazzz.csv', '2023-09-04 21:43:53', 1),
(20, '8774bbaaazzz.csv', '2023-09-04 21:46:20', 1),
(21, '5249bbaaazzz.csv', '2023-09-04 21:48:07', 1),
(22, '8122bbaaazzz.csv', '2023-09-04 21:48:57', 1),
(23, '2530bbaaazzz.csv', '2023-09-04 21:50:16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_category_ids`
--

DROP TABLE IF EXISTS `menu_category_ids`;
CREATE TABLE IF NOT EXISTS `menu_category_ids` (
  `id` int(60) NOT NULL AUTO_INCREMENT,
  `menu` text NOT NULL,
  `description` text NOT NULL,
  `time_added` datetime NOT NULL,
  `added_by` int(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_category_ids`
--

INSERT INTO `menu_category_ids` (`id`, `menu`, `description`, `time_added`, `added_by`) VALUES
(1, 'SPECIALS', 'small description here please', '2023-09-03 13:00:48', 1),
(2, 'FRUIT & VEG', 'small description here please', '2023-09-03 13:00:48', 1),
(3, 'MEAT', 'small description here please', '2023-09-03 13:00:48', 1),
(4, 'FRESH FOOD', 'small description here please', '2023-09-03 13:00:48', 1),
(5, 'MORE FOOD', 'small description here please', '2023-09-03 13:00:48', 1),
(6, 'MORE FOOD', 'small description here please', '2023-09-03 13:00:48', 1),
(7, 'MORE FOOD', 'small description here please', '2023-09-03 13:00:48', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(60) NOT NULL,
  `menu_catalogue_id` int(60) NOT NULL,
  `product_handle` varchar(100) NOT NULL,
  `product_title` text NOT NULL,
  `product_subtitle` text NOT NULL,
  `product_description` text NOT NULL,
  `product_status` text NOT NULL,
  `product_thumbnail` text NOT NULL,
  `product_weight` text NOT NULL,
  `product_length` text NOT NULL,
  `product_width` text NOT NULL,
  `product_height` text NOT NULL,
  `product_hs_code` varchar(100) NOT NULL,
  `product_origin_country` varchar(100) NOT NULL,
  `product_material` text NOT NULL,
  `product_collection_title` text NOT NULL,
  `product_collection_handle` text NOT NULL,
  `product_type` text NOT NULL,
  `product_tags` text NOT NULL,
  `product_discountable` varchar(100) NOT NULL,
  `product_profile_name` text NOT NULL,
  `product_profile_type` text NOT NULL,
  `variant_title` text NOT NULL,
  `variant_sku` varchar(100) NOT NULL,
  `variant_barcode` varchar(60) NOT NULL,
  `variant_inventory_quantity` varchar(60) NOT NULL,
  `variant_manage_inventory` varchar(60) NOT NULL,
  `price_usd` text NOT NULL,
  `option_1_name` varchar(60) NOT NULL,
  `option_1_value` varchar(60) NOT NULL,
  `option_2_name` varchar(60) NOT NULL,
  `option_2_value` varchar(60) NOT NULL,
  `sales_channel_1_name` varchar(60) NOT NULL,
  `time_added` datetime NOT NULL,
  `query_by` int(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `store_id`, `menu_catalogue_id`, `product_handle`, `product_title`, `product_subtitle`, `product_description`, `product_status`, `product_thumbnail`, `product_weight`, `product_length`, `product_width`, `product_height`, `product_hs_code`, `product_origin_country`, `product_material`, `product_collection_title`, `product_collection_handle`, `product_type`, `product_tags`, `product_discountable`, `product_profile_name`, `product_profile_type`, `variant_title`, `variant_sku`, `variant_barcode`, `variant_inventory_quantity`, `variant_manage_inventory`, `price_usd`, `option_1_name`, `option_1_value`, `option_2_name`, `option_2_value`, `sales_channel_1_name`, `time_added`, `query_by`) VALUES
(1, 2, 1, 'dsfsdfdsf', 'rice', 'rice', 'anty caroline rice 10kg', 'A', 'wqwewqeewqewq', '10kg', '12ml', '45ml', '00023324324545', 'SA', 'bcvbcv cvbcvb cvbcvb cvbvbcv', '', '', 'cvbcvbbcvbcvbcvb', 'N', '', 'N', '', '', '123123123000', '1', '3c32', '10kgg', 'cxvxcvcx', '70.54', '', '', '', '', '', '2023-09-04 19:52:32', 1),
(2, 2, 2, 'dsfsdfdsf', 'rice', 'rice', 'Fufu nigerian to zim transformation food 10s', 'A', 'wqwewqeewqewq', '10s', '12ml', '45ml', '00023324324545', 'SA', 'bcvbcv cvbcvb cvbcvb cvbvbcv', '', '', 'cvbcvbbcvbcvbcvb', 'Y', '', 'Y', '', '', '123123123000', '1', '3c32', '10kg', 'cxvxcvcx', '123.02', '', '', '', '', '', '2023-09-04 19:52:32', 1),
(3, 2, 3, 'dsfsdfdsf', 'Sugar', 'Sugar', 'White Sugar SA product Nola Aid 1g', 'A', 'wqwewqeewqewq', '1g', '12ml', '45ml', '00023324324545', 'SA', 'bcvbcv cvbcvb cvbcvb cvbvbcv', '', '', 'cvbcvbbcvbcvbcvb', 'N', '', 'N', '', '', '123123123000', '1', '3c32', '10kg', 'cxvxcvcx', '142.3', '', '', '', '', '', '2023-09-04 19:52:32', 1),
(4, 2, 4, 'dsfsdfdsf', 'rice', 'rice', 'naloSole go milk 10ltr', 'A', 'wqwewqeewqewq', '10ltr', '12ml', '45ml', '00023324324545', 'SA', 'bcvbcv cvbcvb cvbcvb cvbvbcv', '', '', 'cvbcvbbcvbcvbcvb', 'Y', '', 'Y', '', '', '123123123000', '1', '3c32', '2kg', 'cxvxcvcx', '22', '', '', '', '', '', '2023-09-04 19:52:32', 1),
(5, 2, 1, 'dsfsdfdsf', 'Flour', 'Flour', 'Baking Flour 10kg', 'A', 'wqwewqeewqewq', '10kg', '12ml', '45ml', '00023324324545', 'SA', 'bcvbcv cvbcvb cvbcvb cvbvbcv', '', '', 'cvbcvbbcvbcvbcvb', 'Y', '', 'Y', '', '', '123123123000', '1', '3c32', '10kg', 'cxvxcvcx', '37.52', '', '', '', '', '', '2023-09-04 19:52:32', 1);

-- --------------------------------------------------------

--
-- Table structure for table `store_menu_category_ids`
--

DROP TABLE IF EXISTS `store_menu_category_ids`;
CREATE TABLE IF NOT EXISTS `store_menu_category_ids` (
  `id` int(60) NOT NULL AUTO_INCREMENT,
  `store_id` int(60) NOT NULL,
  `menu_category_id` int(60) NOT NULL,
  `added_by` int(60) NOT NULL,
  `time_added` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store_menu_category_ids`
--

INSERT INTO `store_menu_category_ids` (`id`, `store_id`, `menu_category_id`, `added_by`, `time_added`) VALUES
(1, 2, 1, 1, '2023-09-06 11:17:25'),
(2, 2, 2, 1, '2023-09-06 11:17:25'),
(3, 2, 3, 1, '2023-09-06 11:17:25'),
(4, 2, 4, 1, '2023-09-06 11:17:25'),
(5, 2, 5, 1, '2023-09-06 11:17:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(60) NOT NULL AUTO_INCREMENT,
  `usermail` varchar(100) NOT NULL,
  `security` varchar(100) NOT NULL,
  `name` text NOT NULL,
  `background` int(1) NOT NULL DEFAULT '0',
  `surname` text NOT NULL,
  `user_type` text NOT NULL,
  `store_id` int(11) NOT NULL,
  `app_version` text NOT NULL,
  `phone_number` text NOT NULL,
  `dob` date NOT NULL,
  `gender` text NOT NULL,
  `time_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `usermail`, `security`, `name`, `background`, `surname`, `user_type`, `store_id`, `app_version`, `phone_number`, `dob`, `gender`, `time_added`, `added_by`) VALUES
(1, 'abc@gmail.com', 'hk2IAlkl2C2ihh28tWuiNWuWtiGuWiGtl2uWGu', 'Test', 0, 'surname', 'app', 2, '', '0123456789', '2023-08-09', 'male', '2023-08-09 03:51:02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_history`
--

DROP TABLE IF EXISTS `user_history`;
CREATE TABLE IF NOT EXISTS `user_history` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `prev_id` int(100) NOT NULL,
  `url` text NOT NULL,
  `obj_class` text NOT NULL,
  `user_id` int(60) NOT NULL,
  `date_time_nav` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=102 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_history`
--

INSERT INTO `user_history` (`id`, `prev_id`, `url`, `obj_class`, `user_id`, `date_time_nav`) VALUES
(9, 8, '../model/cart.php?store_id=1', '.rollover-dash', 1, '2023-09-06 12:44:51'),
(8, 7, '../model/orderHistory.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 12:44:19'),
(7, 6, '../model/homeLoad.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 12:43:57'),
(6, 6, '../model/homeLoad.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 12:43:46'),
(10, 9, '../model/homeLoad.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 12:44:53'),
(11, 10, '../model/homeLoad.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 13:14:13'),
(12, 11, '../model/homeLoad.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 13:16:34'),
(13, 12, '../model/homeLoad.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 13:19:11'),
(15, 13, '../model/orderHistory.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 13:20:57'),
(16, 15, '../model/homeLoad.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 13:21:49'),
(17, 16, '../model/catergotyMenuSelector.php?menuId=1&clientId=2&storeId=2', '.rollover-dash', 1, '2023-09-06 13:21:51'),
(18, 17, '../model/orderHistory.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 13:56:19'),
(19, 18, '../model/cart.php?store_id=1', '.rollover-dash', 1, '2023-09-06 13:57:21'),
(20, 19, '../model/homeLoad.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 13:58:14'),
(21, 20, '../model/cart.php?store_id=1', '.rollover-dash', 1, '2023-09-06 13:58:31'),
(22, 21, '../model/homeLoad.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 14:02:19'),
(23, 22, '../model/cart.php?store_id=1', '.rollover-dash', 1, '2023-09-06 14:02:21'),
(24, 23, '../model/homeLoad.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 14:16:21'),
(25, 24, '../model/catergotyMenuSelector.php?menuId=1&clientId=2&storeId=2', '.rollover-dash', 1, '2023-09-06 14:16:25'),
(26, 25, '../model/cart.php?store_id=1', '.rollover-dash', 1, '2023-09-06 14:16:30'),
(27, 26, '../model/homeLoad.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 14:17:14'),
(28, 27, '../model/creditCard.php', '.rollover-dash', 1, '2023-09-06 14:17:46'),
(29, 28, '../model/orderHistory.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 14:17:48'),
(30, 29, '../model/settings.php', '.rollover-dash', 1, '2023-09-06 14:17:49'),
(31, 30, '../model/homeLoad.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 14:17:53'),
(32, 31, '../model/cart.php?store_id=1', '.rollover-dash', 1, '2023-09-06 14:18:05'),
(33, 32, '../model/homeLoad.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 14:35:43'),
(34, 33, '../model/cart.php?store_id=1', '.rollover-dash', 1, '2023-09-06 14:35:46'),
(35, 34, '../model/orderHistory.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 14:36:35'),
(36, 35, '../model/creditCard.php', '.rollover-dash', 1, '2023-09-06 14:36:37'),
(37, 36, '../model/settings.php', '.rollover-dash', 1, '2023-09-06 14:36:39'),
(38, 37, '../model/cart.php?store_id=1', '.rollover-dash', 1, '2023-09-06 14:36:41'),
(39, 38, '../model/orderHistory.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 14:40:59'),
(40, 39, '../model/homeLoad.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 14:45:31'),
(41, 40, '../model/homeLoad.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 14:45:38'),
(42, 41, '../model/cart.php?store_id=1', '.rollover-dash', 1, '2023-09-06 14:45:41'),
(43, 42, '../model/catergotyMenuSelector.php?menuId=1&clientId=2&storeId=2', '.rollover-dash', 1, '2023-09-06 14:45:45'),
(44, 43, '../model/homeLoad.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 14:49:34'),
(45, 44, '../model/catergotyMenuSelector.php?menuId=1&clientId=2&storeId=2', '.rollover-dash', 1, '2023-09-06 14:49:35'),
(46, 45, '../model/catergotyMenuSelector.php?menuId=2&clientId=2&storeId=2', '.rollover-dash', 1, '2023-09-06 14:49:38'),
(47, 46, '../model/homeLoad.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 14:50:24'),
(48, 47, '../model/catergotyMenuSelector.php?menuId=1&clientId=2&storeId=2', '.rollover-dash', 1, '2023-09-06 14:50:35'),
(49, 48, '../model/catergotyMenuSelector.php?menuId=1&clientId=2&storeId=2', '.rollover-dash', 1, '2023-09-06 14:53:15'),
(50, 49, '../model/homeLoad.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 15:46:45'),
(51, 50, '../model/cart.php?store_id=1', '.rollover-dash', 1, '2023-09-06 15:46:47'),
(52, 51, '../model/catergotyMenuSelector.php?menuId=1&clientId=2&storeId=2', '.rollover-dash', 1, '2023-09-06 15:48:34'),
(53, 52, '../model/homeLoad.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 15:53:36'),
(54, 53, '../model/cart.php?store_id=1', '.rollover-dash', 1, '2023-09-06 15:53:41'),
(55, 54, '../model/homeLoad.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 15:58:53'),
(56, 55, '../model/cart.php?store_id=1', '.rollover-dash', 1, '2023-09-06 15:58:59'),
(57, 56, '../model/catergotyMenuSelector.php?menuId=1&clientId=2&storeId=2', '.rollover-dash', 1, '2023-09-06 15:59:27'),
(58, 57, '../model/orderHistory.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 16:00:11'),
(59, 58, '../model/homeLoad.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 16:00:21'),
(60, 59, '../model/cart.php?store_id=1', '.rollover-dash', 1, '2023-09-06 16:00:27'),
(61, 60, '../model/orderHistory.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 16:00:28'),
(62, 61, '../model/creditCard.php', '.rollover-dash', 1, '2023-09-06 16:00:30'),
(63, 62, '../model/homeLoad.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 16:00:32'),
(64, 63, '../model/orderHistory.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 16:00:35'),
(65, 64, '../model/cart.php?store_id=1', '.rollover-dash', 1, '2023-09-06 16:00:52'),
(66, 65, '../model/homeLoad.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 16:00:55'),
(67, 66, '../model/orderHistory.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 16:00:58'),
(68, 67, '../model/catergotyMenuSelector.php?menuId=1&clientId=2&storeId=2', '.rollover-dash', 1, '2023-09-06 16:01:32'),
(69, 68, '../model/homeLoad.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 16:23:26'),
(70, 69, '../model/homeLoad.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 16:29:04'),
(71, 70, '../model/cart.php?store_id=1', '.rollover-dash', 1, '2023-09-06 16:29:07'),
(72, 71, '../model/homeLoad.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 16:41:23'),
(73, 72, '../model/cart.php?store_id=1', '.rollover-dash', 1, '2023-09-06 16:41:25'),
(74, 73, '../model/homeLoad.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 16:45:25'),
(75, 74, '../model/homeLoad.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 16:46:27'),
(76, 75, '../model/cart.php?store_id=1', '.rollover-dash', 1, '2023-09-06 16:46:30'),
(77, 76, '../model/cart.php?store_id=1', '.rollover-dash', 1, '2023-09-06 16:46:52'),
(78, 77, '../model/cart.php?store_id=1', '.rollover-dash', 1, '2023-09-06 16:47:23'),
(79, 78, '../model/cart.php?store_id=1', '.rollover-dash', 1, '2023-09-06 16:59:42'),
(80, 79, '../model/homeLoad.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 17:00:32'),
(81, 80, '../model/cart.php?store_id=1', '.rollover-dash', 1, '2023-09-06 17:00:34'),
(82, 81, '../model/cart.php?store_id=1', '.rollover-dash', 1, '2023-09-06 17:06:00'),
(83, 82, '../model/cart.php?store_id=1', '.rollover-dash', 1, '2023-09-06 17:08:31'),
(84, 83, '../model/cart.php?store_id=1', '.rollover-dash', 1, '2023-09-06 17:08:46'),
(85, 84, '../model/cart.php?store_id=1', '.rollover-dash', 1, '2023-09-06 17:08:54'),
(86, 85, '../model/cart.php?store_id=1', '.rollover-dash', 1, '2023-09-06 17:10:51'),
(87, 86, '../model/cart.php?store_id=1', '.rollover-dash', 1, '2023-09-06 17:11:01'),
(88, 87, '../model/cart.php?store_id=1', '.rollover-dash', 1, '2023-09-06 17:12:08'),
(89, 88, '../model/cart.php?store_id=1', '.rollover-dash', 1, '2023-09-06 17:29:24'),
(90, 89, '../model/cart.php?store_id=1', '.rollover-dash', 1, '2023-09-06 17:30:51'),
(91, 90, '../model/cart.php?store_id=1', '.rollover-dash', 1, '2023-09-06 17:30:57'),
(92, 91, '../model/homeLoad.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 17:43:37'),
(93, 92, '../model/homeLoad.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 17:46:07'),
(94, 93, '../model/cart.php?store_id=1', '.rollover-dash', 1, '2023-09-06 17:46:13'),
(95, 94, '../model/homeLoad.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 17:46:23'),
(96, 95, '../model/catergotyMenuSelector.php?menuId=1&clientId=2&storeId=2', '.rollover-dash', 1, '2023-09-06 17:46:25'),
(97, 96, '../model/cart.php?store_id=1', '.rollover-dash', 1, '2023-09-06 17:46:33'),
(98, 97, '../model/cart.php?store_id=1', '.rollover-dash', 1, '2023-09-06 17:46:53'),
(99, 98, '../model/orderHistory.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 17:46:56'),
(100, 99, '../model/homeLoad.php?start=0&limit=10', '.rollover-dash', 1, '2023-09-06 17:46:58'),
(101, 100, '../model/catergotyMenuSelector.php?menuId=1&clientId=2&storeId=2', '.rollover-dash', 1, '2023-09-06 17:47:02');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
