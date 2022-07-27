-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 26, 2022 at 03:31 PM
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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 11621, 'MyApp', 'c4919e426e2dd6caafd318b3e9a35917eed6ce177eefcceb36994ccb6d496068', '[\"*\"]', NULL, '2022-04-18 11:50:33', '2022-04-18 11:50:33'),
(2, 'App\\Models\\User', 11621, 'MyApp', '9bc715e2fb041a2bc047496508dcec8ee428b13efa6597c3b505689f01999069', '[\"*\"]', NULL, '2022-04-18 11:51:19', '2022-04-18 11:51:19'),
(3, 'App\\Models\\User', 11621, 'MyApp', '2e5424777f928af5cfa778b18646a203b6dc6b09dd14cda64fd56db800be0f25', '[\"*\"]', NULL, '2022-04-18 11:52:18', '2022-04-18 11:52:18'),
(4, 'App\\Models\\User', 11621, 'MyApp', 'fd2a6977d156f4b3a1bf4c6806f61afb06c6e8667781e7780b7d2a5ef2af677e', '[\"*\"]', NULL, '2022-04-18 11:53:12', '2022-04-18 11:53:12'),
(5, 'App\\Models\\User', 11621, 'MyApp', '29fcb155dfca9c6616cf10b7b3a1098bffd5469419f57a02b97687d34b2b2cd5', '[\"*\"]', NULL, '2022-04-18 11:54:04', '2022-04-18 11:54:04'),
(6, 'App\\Models\\User', 11621, 'MyApp', '04f3e6a43b74639b9afb31dd8c0fa4712ad3f2980521df3d0729965b16970e3b', '[\"*\"]', NULL, '2022-04-18 11:54:41', '2022-04-18 11:54:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
