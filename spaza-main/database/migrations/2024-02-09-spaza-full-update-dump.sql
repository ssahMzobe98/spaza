-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2024 at 03:32 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `product_id` int(60) NOT NULL,
  `user_id` int(60) NOT NULL,
  `store_id` int(60) NOT NULL,
  `quantity` int(2) NOT NULL,
  `time_added` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `user_id`, `store_id`, `quantity`, `time_added`) VALUES
(30, 2, 5, 1, 3, '2024-02-09 15:38:04');

-- --------------------------------------------------------

--
-- Table structure for table `csv_uploads_for_product_creation`
--

CREATE TABLE `csv_uploads_for_product_creation` (
  `id` int(11) NOT NULL,
  `csv` text NOT NULL,
  `time_uploaded` datetime NOT NULL,
  `uploaded_by` int(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(60) NOT NULL,
  `order_id` int(60) DEFAULT NULL,
  `vat` text DEFAULT NULL,
  `delivery_fee` text DEFAULT NULL,
  `invoice_total` text DEFAULT NULL,
  `order_total` text DEFAULT NULL,
  `refund_total` text DEFAULT NULL,
  `time_invoiced` datetime DEFAULT NULL,
  `invoiced_by` int(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `order_id`, `vat`, `delivery_fee`, `invoice_total`, `order_total`, `refund_total`, `time_invoiced`, `invoiced_by`) VALUES
(20, 1, '129.171', '20.5', '1010.811', '1238.511', '227.7', '2024-02-09 14:03:26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_category_ids`
--

CREATE TABLE `menu_category_ids` (
  `id` int(60) NOT NULL,
  `menu` text NOT NULL,
  `description` text NOT NULL,
  `bg_color` text DEFAULT NULL,
  `time_added` datetime NOT NULL,
  `added_by` int(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `menu_category_ids`
--

INSERT INTO `menu_category_ids` (`id`, `menu`, `description`, `bg_color`, `time_added`, `added_by`) VALUES
(1, 'SPECIALS', 'small description here please', 'badge-primary', '2023-09-03 13:00:48', 1),
(2, 'FRUIT AND VEG', 'small description here please', 'badge-success', '2023-09-03 13:00:48', 1),
(3, 'MEAT, POULTRY AND CHICKEN', 'small description here please', 'badge-warning', '2023-09-03 13:00:48', 1),
(4, 'DRINKS AND ALCOHOL', 'small description here please', 'badge-danger', '2023-09-03 13:00:48', 1),
(5, 'MILK, DAIRY AND EGGS', 'small description here please', 'badge-light', '2023-09-03 13:00:48', 1),
(6, 'PERSONAL CARE AND HEALTH', 'small description here please', 'badge-info', '2023-09-03 13:00:48', 1),
(7, 'CHOCOLATE, CHIPS AND SWEET', 'small description here please', 'badge-primary', '2023-09-03 13:00:48', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(60) NOT NULL,
  `user_id` int(60) NOT NULL,
  `spaza_id` int(60) NOT NULL,
  `created_datetime` datetime DEFAULT NULL,
  `accepted_datetime` datetime DEFAULT NULL,
  `invoice_datetime` datetime DEFAULT NULL,
  `is_invoiced` enum('Y','N') NOT NULL DEFAULT 'N',
  `invoice_id` int(60) NOT NULL,
  `process_status` int(3) NOT NULL DEFAULT 1,
  `payment_status` enum('PAID','NOT PAID') NOT NULL DEFAULT 'NOT PAID',
  `driver_id` int(60) DEFAULT NULL,
  `processed_by` int(60) DEFAULT NULL,
  `total` text DEFAULT NULL,
  `sub_total` text DEFAULT NULL,
  `vat` text DEFAULT NULL,
  `delivery_fee` text DEFAULT NULL,
  `order_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`order_json`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `spaza_id`, `created_datetime`, `accepted_datetime`, `invoice_datetime`, `is_invoiced`, `invoice_id`, `process_status`, `payment_status`, `driver_id`, `processed_by`, `total`, `sub_total`, `vat`, `delivery_fee`, `order_json`) VALUES
(1, 1, 0, '2024-02-07 15:41:52', '2024-02-09 14:29:25', '2024-02-09 14:03:27', 'Y', 20, 4, 'PAID', NULL, 1, '1238.511', '1059.14', '158.871', '20.5', '[{\"cartId\":28,\"user_id\":1,\"store_id\":1,\"id\":4,\"quantity\":9,\"product_description\":\"naloSole go milk 10ltr\",\"product_thumbnail\":\"spicy chicken.jpg\",\"product_weight\":\"10ltr\",\"is_instock\":\"Y\",\"product_discountable\":\"N\",\"price_usd\":\"22\",\"promo_price\":\"20\"},{\"cartId\":27,\"user_id\":1,\"store_id\":1,\"id\":2,\"quantity\":7,\"product_description\":\"Tin fish \\n Italian Ocean sinked octail oil 1.3s.\",\"product_thumbnail\":\"tinfish2.jpg\",\"product_weight\":\"10s\",\"is_instock\":\"Y\",\"product_discountable\":\"N\",\"price_usd\":\"123.02\",\"promo_price\":\"1114.25\"}]'),
(2, 5, 0, '2024-02-09 15:36:30', NULL, NULL, 'N', 0, 1, 'NOT PAID', NULL, NULL, '161.973', '123.02', '18.453', '20.5', '[{\"cartId\":29,\"user_id\":5,\"store_id\":1,\"id\":2,\"quantity\":1,\"product_description\":\"Tin fish \\n Italian Ocean sinked octail oil 1.3s.\",\"product_thumbnail\":\"tinfish2.jpg\",\"product_weight\":\"10s\",\"is_instock\":\"Y\",\"product_discountable\":\"N\",\"price_usd\":\"123.02\",\"promo_price\":\"1114.25\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(60) NOT NULL,
  `order_id` int(60) DEFAULT NULL,
  `product_id` int(60) DEFAULT NULL,
  `label` text DEFAULT NULL,
  `product_unit_size` text DEFAULT NULL,
  `price` text DEFAULT NULL,
  `quantity` int(10) DEFAULT NULL,
  `is_instock` enum('Y','N') NOT NULL DEFAULT 'Y',
  `comments` text DEFAULT NULL,
  `is_promo` enum('Y','N') NOT NULL DEFAULT 'N',
  `promo_price` text DEFAULT NULL,
  `is_picked` enum('Y','N') NOT NULL DEFAULT 'N',
  `time_picked` datetime DEFAULT NULL,
  `time_added` datetime DEFAULT NULL,
  `status` enum('A','D') NOT NULL DEFAULT 'A',
  `removed_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `label`, `product_unit_size`, `price`, `quantity`, `is_instock`, `comments`, `is_promo`, `promo_price`, `is_picked`, `time_picked`, `time_added`, `status`, `removed_by`) VALUES
(1, 4, 1, 'anty caroline rice 10kg', '10kg', '70.54', 10, 'Y', 'No Comment', 'N', NULL, 'N', NULL, '2024-02-05 19:53:02', 'A', NULL),
(2, 4, 4, 'naloSole go milk 10ltr', '10ltr', '22', 4, 'Y', 'No Comment', 'N', '20', 'N', NULL, '2024-02-05 19:53:02', 'A', NULL),
(3, 4, 2, 'Tin fish \n Italian Ocean sinked octail oil 1.3s.', '10s', '123.02', 16, 'Y', 'No Comment', 'Y', '1114.25', 'N', NULL, '2024-02-05 19:53:03', 'A', NULL),
(4, 4, 3, 'White Sugar SA product Nola Aid 1g', '1g', '142.3', 9, 'Y', 'No Comment', 'N', NULL, 'N', NULL, '2024-02-05 19:53:03', 'A', NULL),
(5, 5, 1, 'anty caroline rice 10kg', '10kg', '70.54', 10, 'Y', 'No Comment', 'N', NULL, 'N', NULL, '2024-02-05 20:16:04', 'A', NULL),
(6, 5, 4, 'naloSole go milk 10ltr', '10ltr', '22', 4, 'Y', 'No Comment', 'N', '20', 'N', NULL, '2024-02-05 20:16:04', 'A', NULL),
(7, 5, 2, 'Tin fish \n Italian Ocean sinked octail oil 1.3s.', '10s', '123.02', 16, 'Y', 'No Comment', 'Y', '1114.25', 'N', NULL, '2024-02-05 20:16:04', 'A', NULL),
(8, 5, 3, 'White Sugar SA product Nola Aid 1g', '1g', '142.3', 9, 'Y', 'No Comment', 'N', NULL, 'N', NULL, '2024-02-05 20:16:04', 'A', NULL),
(9, 6, 1, 'anty caroline rice 10kg', '10kg', '70.54', 10, 'Y', 'No Comment', 'N', NULL, 'N', NULL, '2024-02-05 20:17:44', 'A', NULL),
(10, 6, 4, 'naloSole go milk 10ltr', '10ltr', '22', 4, 'Y', 'No Comment', 'N', '20', 'N', NULL, '2024-02-05 20:17:44', 'A', NULL),
(11, 6, 2, 'Tin fish \n Italian Ocean sinked octail oil 1.3s.', '10s', '123.02', 16, 'Y', 'No Comment', 'Y', '1114.25', 'N', NULL, '2024-02-05 20:17:44', 'A', NULL),
(12, 6, 3, 'White Sugar SA product Nola Aid 1g', '1g', '142.3', 9, 'Y', 'No Comment', 'N', NULL, 'N', NULL, '2024-02-05 20:17:45', 'A', 1),
(13, 7, 1, 'anty caroline rice 10kg', '10kg', '70.54', 10, 'Y', 'No Comment', 'N', NULL, 'N', NULL, '2024-02-05 20:19:41', 'A', NULL),
(14, 7, 4, 'naloSole go milk 10ltr', '10ltr', '22', 4, 'Y', 'No Comment', 'N', '20', 'N', NULL, '2024-02-05 20:19:42', 'A', NULL),
(15, 7, 2, 'Tin fish \n Italian Ocean sinked octail oil 1.3s.', '10s', '123.02', 16, 'Y', 'No Comment', 'Y', '1114.25', 'N', NULL, '2024-02-05 20:19:42', 'A', NULL),
(16, 7, 3, 'White Sugar SA product Nola Aid 1g', '1g', '142.3', 9, 'Y', 'No Comment', 'N', NULL, 'N', NULL, '2024-02-05 20:19:42', 'A', NULL),
(17, 8, 1, 'anty caroline rice 10kg', '10kg', '70.54', 6, 'Y', 'No Comment', 'N', NULL, 'Y', '2024-02-07 11:30:31', '2024-02-05 21:01:56', 'A', NULL),
(18, 8, 4, 'naloSole go milk 10ltr', '10ltr', '22', 1, 'Y', 'No Comment', 'N', '20', 'Y', '2024-02-07 11:30:34', '2024-02-05 21:01:56', 'A', NULL),
(19, 8, 2, 'Tin fish \n Italian Ocean sinked octail oil 1.3s.', '10s', '123.02', 1, 'Y', 'No Comment', 'Y', '1114.25', 'N', NULL, '2024-02-05 21:01:56', 'A', NULL),
(20, 9, 3, 'White Sugar SA product Nola Aid 1g', '1g', '142.3', 8, 'Y', 'No Comment', 'N', NULL, 'N', NULL, '2024-02-05 21:03:48', 'A', NULL),
(21, 9, 2, 'Tin fish \n Italian Ocean sinked octail oil 1.3s.', '10s', '123.02', 3, 'Y', 'No Comment', 'Y', '1114.25', 'N', NULL, '2024-02-05 21:03:48', 'A', NULL),
(22, 10, 1, 'anty caroline rice 10kg', '10kg', '70.54', 8, 'Y', 'No Comment', 'N', NULL, 'N', NULL, '2024-02-05 21:05:04', 'A', NULL),
(23, 10, 2, 'Tin fish \n Italian Ocean sinked octail oil 1.3s.', '10s', '123.02', 4, 'Y', 'No Comment', 'Y', '1114.25', 'Y', '2024-02-07 11:28:57', '2024-02-05 21:05:04', 'A', NULL),
(24, 11, 4, 'naloSole go milk 10ltr', '10ltr', '22', 3, 'Y', 'No Comment', 'N', '20', 'N', NULL, '2024-02-05 21:07:29', 'A', NULL),
(25, 11, 3, 'White Sugar SA product Nola Aid 1g', '1g', '142.3', 3, 'Y', 'No Comment', 'N', NULL, 'N', NULL, '2024-02-05 21:07:30', 'A', NULL),
(26, 11, 2, 'Tin fish \n Italian Ocean sinked octail oil 1.3s.', '10s', '123.02', 3, 'Y', 'No Comment', 'Y', '1114.25', 'N', NULL, '2024-02-05 21:07:30', 'A', NULL),
(27, 12, 2, 'Tin fish \n Italian Ocean sinked octail oil 1.3s.', '10s', '123.02', 3, 'Y', 'No Comment', 'Y', '1114.25', 'N', NULL, '2024-02-05 21:09:50', 'A', NULL),
(28, 13, 2, 'Tin fish \n Italian Ocean sinked octail oil 1.3s.', '10s', '123.02', 2, 'Y', 'No Comment', 'Y', '1114.25', 'N', NULL, '2024-02-05 21:12:04', 'A', NULL),
(29, 14, 2, 'Tin fish \n Italian Ocean sinked octail oil 1.3s.', '10s', '123.02', 1, 'Y', 'No Comment', 'Y', '1114.25', 'N', NULL, '2024-02-05 21:14:03', 'A', NULL),
(30, 14, 4, 'naloSole go milk 10ltr', '10ltr', '22', 1, 'Y', 'No Comment', 'N', '20', 'N', NULL, '2024-02-05 21:14:03', 'A', NULL),
(31, 15, 1, 'anty caroline rice 10kg', '10kg', '70.54', 2, 'Y', 'No Comment', 'N', NULL, 'N', NULL, '2024-02-05 21:15:08', 'A', NULL),
(32, 15, 4, 'naloSole go milk 10ltr', '10ltr', '22', 2, 'Y', 'No Comment', 'N', '20', 'N', NULL, '2024-02-05 21:15:08', 'A', NULL),
(33, 1, 4, 'naloSole go milk 10ltr', '10ltr', '22', 9, 'Y', 'No Comment', 'N', '20', 'Y', '2024-02-07 15:44:44', '2024-02-07 15:41:52', 'D', 1),
(34, 1, 2, 'Tin fish \n Italian Ocean sinked octail oil 1.3s.', '10s', '123.02', 7, 'Y', 'No Comment', 'N', '1114.25', 'Y', '2024-02-07 15:44:46', '2024-02-07 15:41:52', 'A', NULL),
(35, 2, 2, 'Tin fish \n Italian Ocean sinked octail oil 1.3s.', '10s', '123.02', 1, 'Y', 'No Comment', 'N', '1114.25', 'N', NULL, '2024-02-09 15:36:30', 'A', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
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
  `promo_price` text DEFAULT NULL,
  `promo_percentage` text DEFAULT NULL,
  `promo_start_date` datetime DEFAULT NULL,
  `promo_end_date` datetime DEFAULT NULL,
  `option_1_name` varchar(60) NOT NULL,
  `option_1_value` varchar(60) NOT NULL,
  `option_2_name` varchar(60) NOT NULL,
  `option_2_value` varchar(60) NOT NULL,
  `sales_channel_1_name` varchar(60) NOT NULL,
  `time_added` datetime NOT NULL,
  `query_by` int(60) NOT NULL,
  `is_instock` enum('Y','N') NOT NULL DEFAULT 'Y',
  `available_quantiy` int(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `store_id`, `menu_catalogue_id`, `product_handle`, `product_title`, `product_subtitle`, `product_description`, `product_status`, `product_thumbnail`, `product_weight`, `product_length`, `product_width`, `product_height`, `product_hs_code`, `product_origin_country`, `product_material`, `product_collection_title`, `product_collection_handle`, `product_type`, `product_tags`, `product_discountable`, `product_profile_name`, `product_profile_type`, `variant_title`, `variant_sku`, `variant_barcode`, `variant_inventory_quantity`, `variant_manage_inventory`, `price_usd`, `promo_price`, `promo_percentage`, `promo_start_date`, `promo_end_date`, `option_1_name`, `option_1_value`, `option_2_name`, `option_2_value`, `sales_channel_1_name`, `time_added`, `query_by`, `is_instock`, `available_quantiy`) VALUES
(1, 2, 1, 'dsfsdfdsf', 'rice', 'rice', 'anty caroline rice 10kg', 'A', 'rice.jpg', '10kg', '12ml', '45ml', '00023324324545', 'SA', 'bcvbcv cvbcvb cvbcvb cvbvbcv', '', '', 'cvbcvbbcvbcvbcvb', 'N', '', 'N', '', '', '123123123000', '1', '3c32', '10kgg', 'cxvxcvcx', '70.54', NULL, NULL, NULL, NULL, '', '', '', '', '', '2023-09-04 19:52:32', 1, 'Y', 250),
(2, 2, 2, 'dsfsdfdsf', 'rice', 'rice', 'Tin fish \n Italian Ocean sinked octail oil 1.3s.', 'A', 'tinfish2.jpg', '10s', '12ml', '45ml', '00023324324545', 'SA', 'bcvbcv cvbcvb cvbcvb cvbvbcv', '', '', 'cvbcvbbcvbcvbcvb', 'Y', '', 'Y', '', '', '123123123000', '1', '3c32', '10kg', 'cxvxcvcx', '123.02', '1114.25', NULL, '2024-02-02 21:23:14', '2024-02-05 21:23:24', '', '', '', '', '', '2023-09-04 19:52:32', 1, 'Y', 52),
(3, 2, 3, 'dsfsdfdsf', 'Sugar', 'Sugar', 'White Sugar SA product Nola Aid 1g', 'A', 'white sugar.jpg', '1g', '12ml', '45ml', '00023324324545', 'SA', 'bcvbcv cvbcvb cvbcvb cvbvbcv', '', '', 'cvbcvbbcvbcvbcvb', 'N', '', 'N', '', '', '123123123000', '1', '3c32', '10kg', 'cxvxcvcx', '142.3', NULL, NULL, NULL, NULL, '', '', '', '', '', '2023-09-04 19:52:32', 1, 'Y', 320),
(4, 2, 4, 'dsfsdfdsf', 'rice', 'rice', 'naloSole go milk 10ltr', 'A', 'spicy chicken.jpg', '10ltr', '12ml', '45ml', '00023324324545', 'SA', 'bcvbcv cvbcvb cvbcvb cvbvbcv', '', '', 'cvbcvbbcvbcvbcvb', 'Y', '', 'Y', '', '', '123123123000', '1', '3c32', '2kg', 'cxvxcvcx', '22', '20', NULL, '2024-02-01 21:23:53', '2024-02-02 21:24:01', '', '', '', '', '', '2023-09-04 19:52:32', 1, 'Y', 145),
(5, 2, 1, 'dsfsdfdsf', 'Flour', 'Flour', 'Baking Flour 10kg', 'A', 'flour.jpg', '10kg', '12ml', '45ml', '00023324324545', 'SA', 'bcvbcv cvbcvb cvbcvb cvbvbcv', '', '', 'cvbcvbbcvbcvbcvb', 'Y', '', 'Y', '', '', '123123123000', '1', '3c32', '10kg', 'cxvxcvcx', '37.52', '32.99', NULL, '2024-02-02 21:24:07', '2024-02-12 21:24:30', '', '', '', '', '', '2023-09-04 19:52:32', 1, 'N', 0);

-- --------------------------------------------------------

--
-- Table structure for table `spaza_details`
--

CREATE TABLE `spaza_details` (
  `id` int(60) NOT NULL,
  `spaza_owner_id` int(60) DEFAULT NULL,
  `spaza_name` text DEFAULT NULL,
  `rep_name` text DEFAULT NULL,
  `rep_surname` text DEFAULT NULL,
  `phone_number` text DEFAULT NULL,
  `email_address` varchar(100) DEFAULT NULL,
  `id_passport_number` text DEFAULT NULL,
  `permit_number` text DEFAULT NULL,
  `visa_number` text DEFAULT NULL,
  `gender` text DEFAULT NULL,
  `country_of_origin` text DEFAULT NULL,
  `origin_address` text DEFAULT NULL,
  `spaza_address` text DEFAULT NULL,
  `passport_id_copy` text DEFAULT NULL,
  `proof_of_origin_address` text DEFAULT NULL,
  `proof_of_residental_adress` text DEFAULT NULL,
  `copy_of_permit` text DEFAULT NULL,
  `proof_of_spaza_address` text DEFAULT NULL,
  `rep_facial_img` text DEFAULT NULL,
  `is_veryfied` enum('Y','N') NOT NULL DEFAULT 'N',
  `time_added` datetime DEFAULT NULL,
  `time_verified` datetime DEFAULT NULL,
  `added_by` int(60) DEFAULT NULL,
  `verified_by` int(60) DEFAULT NULL,
  `status` enum('A','D') NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `spaza_details`
--

INSERT INTO `spaza_details` (`id`, `spaza_owner_id`, `spaza_name`, `rep_name`, `rep_surname`, `phone_number`, `email_address`, `id_passport_number`, `permit_number`, `visa_number`, `gender`, `country_of_origin`, `origin_address`, `spaza_address`, `passport_id_copy`, `proof_of_origin_address`, `proof_of_residental_adress`, `copy_of_permit`, `proof_of_spaza_address`, `rep_facial_img`, `is_veryfied`, `time_added`, `time_verified`, `added_by`, `verified_by`, `status`) VALUES
(1, 4, 'Hlulwa Spaza shop', 'hkho', 'jdbbd7823', '87985631321', 'adsv@gmail.com', '65656665', NULL, NULL, 'Male', 'Afghanistan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '2024-01-26 09:55:22', NULL, 1, NULL, 'A'),
(2, 4, 'dezada Spaza shop', 'gdgdf', 'lm vkjdfvd', '21457852', 'zuzuz@gmail.com', '214785', '84651322', '784651321', 'Female', 'Bangladesh', 'hgvhbjnklml;', 'ughnlkm kjkhghjg', '784651321_50209.pdf', 'countryOfOriginAddress_2_74564.pdf', 'residentalAddress_2_67885.pdf', '84651322_58421.pdf', 'spazaAddress_2_46785.pdf', 'photo_2_62855.png', '', '2024-01-26 09:59:20', NULL, 1, NULL, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` int(60) NOT NULL,
  `status` text NOT NULL,
  `added-by` int(60) NOT NULL,
  `time_added` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `status`, `added-by`, `time_added`) VALUES
(1, 'WAITING FOR PAYMENT', 1, '2023-09-20 13:51:10'),
(2, 'ORDER PLACED', 1, '2023-09-20 13:51:10'),
(3, 'ACCEPTED', 1, '2023-09-20 13:51:10'),
(4, 'ORDER INVOICED', 1, '2023-09-20 13:51:10'),
(5, 'ORDER READY', 1, '2023-09-20 13:51:10'),
(6, 'READY FOR COLLECTION', 1, '2023-09-20 13:51:10'),
(7, 'COLLECTED', 1, '2023-09-20 13:51:10'),
(8, 'READY FOR DRIVER', 1, '2023-09-20 13:51:10'),
(9, 'DRIVER COLLECTED ORDER', 1, '2023-09-20 13:51:10'),
(10, 'DRIVER ON ROUTE', 1, '2023-09-20 13:51:10'),
(11, 'DRIVER ARRIVED', 1, '2023-09-20 13:51:10'),
(12, 'DRIVER HANDED OVER', 1, '2023-09-20 13:51:10'),
(13, 'ORDER DELIVERD', 1, '2023-09-20 13:51:10'),
(14, 'ORDER FAILED', 1, '2023-09-20 13:51:10'),
(15, 'ORDER REVERTED', 1, '2023-09-20 13:59:52');

-- --------------------------------------------------------

--
-- Table structure for table `store_menu_category_ids`
--

CREATE TABLE `store_menu_category_ids` (
  `id` int(60) NOT NULL,
  `store_id` int(60) NOT NULL,
  `menu_category_id` int(60) NOT NULL,
  `added_by` int(60) NOT NULL,
  `time_added` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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

CREATE TABLE `users` (
  `id` int(60) NOT NULL,
  `current_spaza` int(11) DEFAULT NULL,
  `usermail` varchar(100) NOT NULL,
  `security` varchar(100) NOT NULL,
  `name` text NOT NULL,
  `background` int(1) NOT NULL DEFAULT 0,
  `surname` text NOT NULL,
  `user_type` text NOT NULL,
  `store_id` int(11) NOT NULL,
  `app_version` text NOT NULL,
  `phone_number` text NOT NULL,
  `dob` date NOT NULL,
  `gender` text NOT NULL,
  `nationality` text NOT NULL,
  `passport_id_no` text NOT NULL,
  `permit_no` text NOT NULL,
  `country_of_origin_address` text NOT NULL,
  `sa_residing_address` text NOT NULL,
  `passport_id_copy` text NOT NULL,
  `country_of_origin_proof_of_address` text NOT NULL,
  `facial_image` text NOT NULL,
  `proof_of_residental_address_sa` text NOT NULL,
  `time_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `is_verified` enum('Y','N') NOT NULL DEFAULT 'Y',
  `status` enum('A','D','S') NOT NULL DEFAULT 'A',
  `card_number` text DEFAULT NULL,
  `card_expiry_date` text DEFAULT NULL,
  `card_name` text DEFAULT NULL,
  `card_type` text DEFAULT NULL,
  `card_cvv` text DEFAULT NULL,
  `card_token` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `current_spaza`, `usermail`, `security`, `name`, `background`, `surname`, `user_type`, `store_id`, `app_version`, `phone_number`, `dob`, `gender`, `nationality`, `passport_id_no`, `permit_no`, `country_of_origin_address`, `sa_residing_address`, `passport_id_copy`, `country_of_origin_proof_of_address`, `facial_image`, `proof_of_residental_address_sa`, `time_added`, `added_by`, `is_verified`, `status`, `card_number`, `card_expiry_date`, `card_name`, `card_type`, `card_cvv`, `card_token`) VALUES
(1, NULL, 'abc@gmail.com', 'hk2IAlkl2C2ihh28tWuiNWuWtiGuWiGtl2uWGu', 'Test', 1, 'surname', 'ADMIN', 2, '', '0123456789', '2023-08-09', 'male', 'Afganistan', '', '', '', 'address details', '', '', '', '', '2023-08-09 03:51:02', 1, 'Y', 'A', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 1, 'abcd@gmail.com', 'Wh2IAkui2C2tNh28NWkhuiititluuGGhiWjhuj', 'rgd', 1, 'gdfgdf', 'APP', 1, '', '1234567899', '2024-01-15', 'Male', 'South Africa', '161651616', '1231231', '3rdsfsfsd', 'fsdfsf', '9711_2022-04-22 Msizi Mzobe CV.pdf', '670_2022-04-22 Msizi Mzobe CV.pdf', 'Slide2.jpg', '9576_2022-04-22 Msizi Mzobe CV.pdf', '2024-01-26 08:25:30', 1, 'Y', 'A', '55646465', '2024-02', 'wqeqw', NULL, '444', NULL),
(5, NULL, 'qwe@gmail.com', 'ju2IAltG2C2jhh28WiGW2GlituWttjG2k2jhtj', 'absad', 1, 'Mugabe', 'APP', 1, '', '1234567890', '2024-03-05', 'Male', 'Australia', '58523654', '12345678', 'werrtcvhjb xrctyvubi sedrtyugi 4esedrtygu sdrtygu edrftgyuhbdftgyu 5dftygu try 1452', 'srxdctfgvhb xcvgbh xctvybh rtcyvbun ertcybu rety ttrcyv 478', '3498_ptgPoolGetStarted.pdf', '1654_ptgPoolGetStarted.pdf', '5473_Slide2.JPG', '2692_2022-04-22 Msizi Mzobe CV.pdf', '2024-02-09 15:23:18', 1, 'Y', 'A', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_history`
--

CREATE TABLE `user_history` (
  `id` int(100) NOT NULL,
  `prev_id` int(100) NOT NULL,
  `url` text NOT NULL,
  `obj_class` text NOT NULL,
  `user_id` int(60) NOT NULL,
  `date_time_nav` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `id` int(60) NOT NULL,
  `user_id` int(60) DEFAULT NULL,
  `wallet_amount` text DEFAULT NULL,
  `added_on` datetime DEFAULT NULL,
  `status` enum('A','D') NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`id`, `user_id`, `wallet_amount`, `added_on`, `status`) VALUES
(1, 1, '683.1', '2024-02-09 12:11:55', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_history`
--

CREATE TABLE `wallet_history` (
  `id` int(60) NOT NULL,
  `invoice_id` int(60) DEFAULT NULL,
  `order_id` int(60) DEFAULT NULL,
  `user_id` int(60) DEFAULT NULL,
  `vat` text DEFAULT NULL,
  `delivery_fee` text DEFAULT NULL,
  `invoice_total` text DEFAULT NULL,
  `order_total` text DEFAULT NULL,
  `refund_total` text DEFAULT NULL,
  `invoice_by` text DEFAULT NULL,
  `action_2_wallet` text DEFAULT NULL,
  `time_added` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wallet_history`
--

INSERT INTO `wallet_history` (`id`, `invoice_id`, `order_id`, `user_id`, `vat`, `delivery_fee`, `invoice_total`, `order_total`, `refund_total`, `invoice_by`, `action_2_wallet`, `time_added`) VALUES
(6, 12, 1, NULL, '129.171', '20.5', '1010.811', '227.7', '1', 'WALLET_REFUND', '1', '2024-02-09 11:39:48'),
(7, 13, 1, NULL, '129.171', '20.5', '1010.811', '227.7', '1', 'WALLET_REFUND', '1', '2024-02-09 12:10:47'),
(8, 14, 1, NULL, '129.171', '20.5', '1010.811', '227.7', '1', 'WALLET_REFUND', '1', '2024-02-09 12:13:22'),
(9, 15, 1, NULL, '129.171', '20.5', '1010.811', '227.7', '1', 'WALLET_REFUND', '1', '2024-02-09 13:24:00'),
(10, 16, 1, NULL, '129.171', '20.5', '1010.811', '227.7', '1', 'WALLET_REFUND', '1', '2024-02-09 13:25:27'),
(11, 17, 1, NULL, '129.171', '20.5', '1010.811', '227.7', '1', 'WALLET_REFUND', '1', '2024-02-09 13:30:33'),
(12, 18, 1, 1, '129.171', '20.5', '1010.811', '1238.511', '227.7', '1', 'WALLET_REFUND', '2024-02-09 13:32:58'),
(13, 19, 1, 1, '129.171', '20.5', '1010.811', '1238.511', '227.7', '1', 'WALLET_REFUND', '2024-02-09 14:00:32'),
(14, 20, 1, 1, '129.171', '20.5', '1010.811', '1238.511', '227.7', '1', 'WALLET_REFUND', '2024-02-09 14:03:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `csv_uploads_for_product_creation`
--
ALTER TABLE `csv_uploads_for_product_creation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_category_ids`
--
ALTER TABLE `menu_category_ids`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spaza_details`
--
ALTER TABLE `spaza_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_menu_category_ids`
--
ALTER TABLE `store_menu_category_ids`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_history`
--
ALTER TABLE `user_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet_history`
--
ALTER TABLE `wallet_history`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `csv_uploads_for_product_creation`
--
ALTER TABLE `csv_uploads_for_product_creation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `menu_category_ids`
--
ALTER TABLE `menu_category_ids`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `spaza_details`
--
ALTER TABLE `spaza_details`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `store_menu_category_ids`
--
ALTER TABLE `store_menu_category_ids`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_history`
--
ALTER TABLE `user_history`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wallet_history`
--
ALTER TABLE `wallet_history`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
