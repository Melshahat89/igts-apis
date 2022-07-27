-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 26, 2022 at 03:18 PM
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
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'oFWk0At3QrHfNdK8plBYNBLjAcr6VqWkSWn0i7lT', NULL, 'http://localhost', 1, 0, 0, '2022-04-18 10:57:26', '2022-04-18 10:57:26'),
(2, NULL, 'Laravel Password Grant Client', 'z6zo9SJKaau1oE4gr3ACM8aqlscnpOIgv6K6oVMx', 'users', 'http://localhost', 0, 1, 0, '2022-04-18 10:57:26', '2022-04-18 10:57:26'),
(3, NULL, 'IGTS Personal Access Client', 'Con7uPeZruNdfCZBNBiZrtr4AUf1e6kqwQQvBhn0', NULL, 'http://localhost', 1, 0, 0, '2022-05-23 14:44:25', '2022-05-23 14:44:25'),
(4, NULL, 'IGTS Password Grant Client', 'toI8k2NUDyjCKOUnG65TASKiLvPBdqMkGVRbICGW', NULL, 'http://localhost', 0, 1, 0, '2022-05-23 14:44:25', '2022-05-23 14:44:25'),
(5, NULL, 'IGTS Personal Access Client', 'cimiWztI6CFhJSpWfMRi6pCg6vvZfqTewECJJjDv', NULL, 'http://localhost', 1, 0, 0, '2022-05-23 14:47:54', '2022-05-23 14:47:54'),
(6, NULL, 'IGTS Password Grant Client', 'wPusZkELphhaCIeYE7Txt6lUYKvl84FIyx6jq1GC', NULL, 'http://localhost', 0, 1, 0, '2022-05-23 14:47:55', '2022-05-23 14:47:55'),
(7, NULL, 'IGTS Personal Access Client', '7PCqTP48Q9910VaNeRRRELPzDckyMINZOHnOcPgu', NULL, 'http://localhost', 1, 0, 0, '2022-05-23 15:36:48', '2022-05-23 15:36:48'),
(8, NULL, 'IGTS Password Grant Client', 'aHlGI8sO2uQGicM4vE1OxCgGo21e51otnHkCGkXC', NULL, 'http://localhost', 0, 1, 0, '2022-05-23 15:36:48', '2022-05-23 15:36:48'),
(9, NULL, 'IGTS Personal Access Client', 'y4QXwkTEiOo8Z2Z96M5nuCqq0aVYd0PrmGVOPbhj', NULL, 'http://localhost', 1, 0, 0, '2022-05-25 14:05:42', '2022-05-25 14:05:42'),
(10, NULL, 'IGTS Password Grant Client', 'SUn6lBopdLe6oVeEO5G9hmVjvsRufUukh8iYXC2K', NULL, 'http://localhost', 0, 1, 0, '2022-05-25 14:05:42', '2022-05-25 14:05:42'),
(11, NULL, 'IGTS Personal Access Client', 'Ur9Pe4sGO7yzg7HAuqZFBje3AjKBF4SAjYgLTMc8', NULL, 'http://localhost', 1, 0, 0, '2022-07-24 12:50:05', '2022-07-24 12:50:05'),
(12, NULL, 'IGTS Password Grant Client', 'zchnxqBVwspYUDWZnzUTno6SFjbwgukuAnqDEUBl', NULL, 'http://localhost', 0, 1, 0, '2022-07-24 12:50:06', '2022-07-24 12:50:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
