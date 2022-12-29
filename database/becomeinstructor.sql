-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 26, 2022 at 03:07 PM
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
-- Table structure for table `becomeinstructor`
--

CREATE TABLE `becomeinstructor` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specialist` int(11) DEFAULT NULL,
  `yourCourses` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cv` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `socialAccount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dateOfBirth` date DEFAULT NULL,
  `country` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `becomeinstructor`
--

INSERT INTO `becomeinstructor` (`id`, `name`, `email`, `phone`, `title`, `specialist`, `yourCourses`, `cv`, `socialAccount`, `dateOfBirth`, `country`, `created_at`, `updated_at`) VALUES
(1, 'name', 'admin@admin.admin', '01010100101', 'titile', 1, 'ww', 'LUg5JcpmJF5.jpg', '#', NULL, NULL, '2022-07-06 10:35:50', '2022-07-06 10:35:50'),
(2, 'name', 'admin@admin.admin', '01010100101', 'titile', 1, 'ww', 'eHjXqvRBas1.jpg', '#', NULL, NULL, '2022-07-06 10:39:07', '2022-07-06 10:39:07'),
(3, 'name', 'admin@admin.admin', '01010100101', 'titile', 1, 'ww', 'r18MXZP9qC5.jpg', NULL, '2022-07-05', 'egypt', '2022-07-06 11:34:33', '2022-07-06 11:34:33'),
(4, 'name', 'admin@admin.admin', '01010100101', 'titile', 1, NULL, 'OEmXSWOY7n5.jpg', NULL, '0000-00-00', 'egypt', '2022-07-06 11:35:05', '2022-07-06 11:35:05'),
(5, 'name', 'admin@admin.admin', '01010100101', 'titile', 1, NULL, 'VQDA9eJCqB6.jpg', NULL, '2022-07-05', 'egypt', '2022-07-06 11:35:59', '2022-07-06 11:35:59'),
(6, 'name', 'admin@admin.admin', '01010100101', 'titile', 1, NULL, NULL, NULL, '2022-07-05', 'egypt', '2022-07-17 12:20:56', '2022-07-17 12:20:56'),
(7, 'name', 'admin@admin.admin', '01010100101', 'titile', 1, NULL, NULL, NULL, '2022-07-05', 'egypt', '2022-07-17 12:20:58', '2022-07-17 12:20:58'),
(8, 'name', 'admin@admin.admin', '01010100101', 'titile', 1, NULL, NULL, NULL, '2022-07-05', 'egypt', '2022-07-17 12:22:15', '2022-07-17 12:22:15'),
(9, 'name', 'admin@admin.admin', '01010100101', 'titile', 1, NULL, 'a5uJgIJsbL7.jpg', NULL, '2022-07-05', 'egypt', '2022-07-17 12:24:19', '2022-07-17 12:24:19'),
(10, 'name', 'admin@admin.admin', '01010100101', 'titile', 1, NULL, 'RKtzX9t9494.jpg', NULL, '2022-07-05', 'egypt', '2022-07-17 12:24:27', '2022-07-17 12:24:27'),
(11, 'name', 'admin@admin.admin', '01010100101', 'titile', 1, NULL, 'V0QriYMRMx3.jpg', NULL, '2022-07-05', 'egypt', '2022-07-17 12:30:30', '2022-07-17 12:30:30'),
(12, 'name', 'admin@admin.admin', '01010100101', 'titile', 1, NULL, 'fYw1iT1Zm00.jpg', NULL, '2022-07-05', 'egypt', '2022-07-17 09:03:31', '2022-07-17 09:03:31'),
(13, 'Mahmoud', 'sozokiamk@gmail.com', '1099454849', 'title', 6, NULL, 'VRQr7qW6bW4.jpg', NULL, '2004-01-01', 'Egypt', '2022-07-17 09:06:09', '2022-07-17 09:06:09'),
(14, 'name', 'admin@admin.admin', '01010100101', 'titile', 1, NULL, 'dC95Grpq3d8.jpg', NULL, '2022-07-05', 'egypt', '2022-07-24 12:13:14', '2022-07-24 12:13:14'),
(15, 'name', 'admin@admin.admin', '01010100101', 'titile', 1, NULL, 'j8J9LlzH5q5.jpg', NULL, '2022-07-05', 'egypt', '2022-07-24 12:18:22', '2022-07-24 12:18:22'),
(16, 'name', 'admin@admin.admin', '01010100101', 'titile', 1, NULL, 'WLZwdSvjpJ6.jpg', NULL, '2022-07-05', 'egypt', '2022-07-24 12:18:25', '2022-07-24 12:18:25'),
(17, 'name', 'admin@admin.admin', '01010100101', 'titile', 1, 'ww', 'uLTSDBw2VP2.jpg', '#', NULL, NULL, '2022-07-25 12:57:00', '2022-07-25 12:57:00'),
(18, 'name', 'admin@admin.admin', '01010100101', 'titile', 1, 'ww', 'b85f8XnqSF5.jpg', '#', NULL, NULL, '2022-07-25 13:11:26', '2022-07-25 13:11:26'),
(19, 'name', 'admin@admin.admin', '01010100101', 'titile', 1, 'ww', 'Z9DcXIQbtF6.jpg', '#', NULL, NULL, '2022-07-25 13:11:40', '2022-07-25 13:11:40'),
(20, 'name', 'admin@admin.admin', '01010100101', 'titile', 1, 'ww', '7X0rayvUuw3.jpg', '#', NULL, NULL, '2022-07-25 13:12:02', '2022-07-25 13:12:02'),
(21, 'name', 'admin@admin.admin', '01010100101', 'titile', 1, 'ww', 'mgbb9bddtG6.jpg', '#', NULL, NULL, '2022-07-25 13:13:28', '2022-07-25 13:13:28'),
(22, 'name', 'admin@admin.admin', '01010100101', 'titile', 1, 'ww', 'wKoX5PWcqv2.jpg', '#', NULL, NULL, '2022-07-25 13:14:55', '2022-07-25 13:14:55'),
(23, 'name', 'admin@admin.admin', '01010100101', 'titile', 1, 'ww', 'VQMLrfdnAe3.jpg', '#', NULL, NULL, '2022-07-25 13:15:46', '2022-07-25 13:15:46'),
(24, 'name', 'admin@admin.admin', '01010100101', 'titile', 1, 'ww', '11xsN4mUQ38.jpg', '#', NULL, NULL, '2022-07-25 13:25:09', '2022-07-25 13:25:09'),
(25, 'name', 'admin@admin.admin', '01010100101', 'titile', 1, 'ww', '76qWso8c569.jpg', '#', NULL, NULL, '2022-07-25 13:25:34', '2022-07-25 13:25:34'),
(26, 'name', 'admin@admin.admin', '01010100101', 'titile', 1, 'ww', 'CjmKKHZL8z2.jpg', '#', NULL, NULL, '2022-07-25 13:26:49', '2022-07-25 13:26:49'),
(27, 'name', 'admin@admin.admin', '01010100101', 'titile', 1, 'ww', '84343_1658766015.docx', '#', NULL, NULL, '2022-07-25 14:20:15', '2022-07-25 14:20:15'),
(28, 'name', 'admin@admin.admin', '01010100101', 'titile', 1, 'ww', '', '#', NULL, NULL, '2022-07-25 14:20:52', '2022-07-25 14:20:52'),
(29, 'name', 'admin@admin.admin', '01010100101', 'titile', 1, 'ww', '77169_1658766073.pdf', '#', NULL, NULL, '2022-07-25 14:21:13', '2022-07-25 14:21:13'),
(30, 'name', 'admin@admin.admin', '01010100101', 'titile', 1, 'ww', '14139_1658766245.pdf', '#', NULL, NULL, '2022-07-25 14:24:05', '2022-07-25 14:24:05'),
(31, 'name', 'admin@admin.admin', '01010100101', 'titile', 1, 'ww', '75130_1658766249.pdf', '#', NULL, NULL, '2022-07-25 14:24:09', '2022-07-25 14:24:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `becomeinstructor`
--
ALTER TABLE `becomeinstructor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `becomeinstructor`
--
ALTER TABLE `becomeinstructor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
