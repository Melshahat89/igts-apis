-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 26, 2022 at 03:14 PM
-- Server version: 5.7.39
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `igtsservice_api`
--

-- --------------------------------------------------------

--
-- Table structure for table `coursereport`
--

CREATE TABLE `coursereport` (
  `id` int(11) NOT NULL,
  `courses_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `report` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coursereport`
--

INSERT INTO `coursereport` (`id`, `courses_id`, `user_id`, `report`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'comment', '2022-06-08 15:39:55', '2022-06-08 15:39:55'),
(2, 1, 1, 'comment', '2022-06-08 15:39:57', '2022-06-08 15:39:57'),
(3, 1, 1, 'comment', '2022-06-08 15:51:17', '2022-06-08 15:51:17'),
(4, 1, 1, 'comment', '2022-06-08 15:53:52', '2022-06-08 15:53:52'),
(5, 1, 1, 'comment', '2022-06-08 15:53:54', '2022-06-08 15:53:54'),
(6, 61, 1, 'test', '2022-06-26 09:00:36', '2022-06-26 09:00:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coursereport`
--
ALTER TABLE `coursereport`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coursereport`
--
ALTER TABLE `coursereport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
