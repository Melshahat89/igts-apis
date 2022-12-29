-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 26, 2022 at 03:13 PM
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
-- Table structure for table `coursenotes`
--

CREATE TABLE `coursenotes` (
  `id` int(11) NOT NULL,
  `courses_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `notes` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coursenotes`
--

INSERT INTO `coursenotes` (`id`, `courses_id`, `user_id`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'note note', '2022-06-08 15:57:11', '2022-06-08 15:57:11'),
(2, 1, 1, 'note note', '2022-06-08 15:57:14', '2022-06-08 15:57:14'),
(3, 1, 1, 'note note', '2022-06-08 15:58:24', '2022-06-08 15:58:24'),
(4, 14, 1, 'fasts sdf af', '2022-06-22 16:44:43', '2022-06-22 16:44:43'),
(5, 13, 1, 'trgfdg dog fog fd', '2022-06-22 16:52:49', '2022-06-22 16:52:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coursenotes`
--
ALTER TABLE `coursenotes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coursenotes`
--
ALTER TABLE `coursenotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
