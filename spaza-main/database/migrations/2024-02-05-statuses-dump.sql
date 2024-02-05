-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2024 at 03:16 PM
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
-- Database: `dash_test`
--

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
(1, 'ORDER PLACED', 1, '2023-09-20 13:51:10'),
(2, 'ACCEPTED', 1, '2023-09-20 13:51:10'),
(3, 'PACKING ORDER', 1, '2023-09-20 13:51:10'),
(4, 'VERIFYING ORDER', 1, '2023-09-20 13:51:10'),
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
