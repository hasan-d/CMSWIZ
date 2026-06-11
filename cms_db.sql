-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 11, 2026 at 12:06 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `original_name` varchar(255) NOT NULL,
  `path` varchar(500) NOT NULL,
  `type` varchar(50) NOT NULL,
  `size` int(11) NOT NULL,
  `uploaded_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `filename`, `original_name`, `path`, `type`, `size`, `uploaded_by`, `created_at`) VALUES
(1, '6a0590c8555a5_tabela 33. kolo.png', 'tabela 33. kolo.png', 'uploads/media/6a0590c8555a5_tabela 33. kolo.png', 'png', 482940, 1, '2026-05-14 09:07:20'),
(2, '6a0c209c7398c_logo.png', 'logo.png', 'uploads/media/6a0c209c7398c_logo.png', 'png', 1700679, 1, '2026-05-19 08:34:36'),
(3, '6a0c20a1aa2e2_26borrad-4.png', '26borrad-4.png', 'uploads/media/6a0c20a1aa2e2_26borrad-4.png', 'png', 1382735, 1, '2026-05-19 08:34:41'),
(4, '6a0c210614b5a_tabela 33. kolo.png', 'tabela 33. kolo.png', 'uploads/media/6a0c210614b5a_tabela 33. kolo.png', 'png', 482940, 1, '2026-05-19 08:36:22'),
(5, '6a0c210cac57c_logo.png', 'logo.png', 'uploads/media/6a0c210cac57c_logo.png', 'png', 1700679, 1, '2026-05-19 08:36:28');

-- --------------------------------------------------------

--
-- Table structure for table `navigation`
--

CREATE TABLE `navigation` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `url` varchar(500) NOT NULL,
  `page_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `order_priority` int(11) DEFAULT 0,
  `target` enum('_self','_blank') DEFAULT '_self',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `navigation`
--

INSERT INTO `navigation` (`id`, `title`, `url`, `page_id`, `parent_id`, `order_priority`, `target`, `created_at`) VALUES
(3, 'About Us', 'about-us', NULL, NULL, 0, '_self', '2026-05-18 09:11:16'),
(4, 'News', 'news', NULL, NULL, 0, '_self', '2026-05-18 09:23:40'),
(5, 'Profile', 'profile', NULL, NULL, 0, '_self', '2026-05-19 09:38:36'),
(6, 'My Profile', 'my-profile', NULL, 5, 0, '_self', '2026-05-19 10:40:24'),
(7, 'New Page', 'new-page', 6, NULL, 0, '_self', '2026-05-20 07:08:14');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('draft','published') DEFAULT 'published',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `image`, `status`, `created_at`) VALUES
(1, 'About Us', 'about-us', 'This is About Us section.', NULL, 'published', '2026-05-18 08:46:31'),
(2, 'News', 'news', 'This is News page.', NULL, 'published', '2026-05-18 09:22:59'),
(3, 'Profile', 'profile', 'profile', NULL, 'published', '2026-05-19 09:37:15'),
(5, 'My Profile', 'my-profile', 'This is a test for My Profile page.', NULL, 'published', '2026-05-19 10:53:21'),
(6, 'New Page', 'new-page', 'Content on New Page.', NULL, 'published', '2026-05-20 07:07:54');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `key` varchar(100) NOT NULL,
  `value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`) VALUES
(1, 'site_name', 'CMSWIZ'),
(2, 'site_logo', 'uploads/logo/logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','editor','user') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'admin', 'admin@cms.com', '$2y$10$YUozs591t/KUOTt5qHWhhOF8YBW6WAp0edFclf663ljO2OjrJSzGa', 'admin', '2026-05-13 08:35:08'),
(3, 'user', 'user@cms.com', '$2y$10$6bfxMPRNZ1NUCdNjFthyYeDxr30PFCI/xBOeVG76k6WVrGGemlyC.', 'user', '2026-05-14 08:14:07'),
(4, 'mirza', 'mirza@test.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'editor', '2025-08-15 08:00:00'),
(5, 'amila', 'amila@test.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'editor', '2025-10-20 08:00:00'),
(6, 'dzenan', 'dzenan@test.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', '2025-12-10 09:00:00'),
(7, 'ajla', 'ajla@test.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', '2026-02-05 09:00:00'),
(8, 'tarik', 'tarik@test.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', '2026-04-01 08:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uploaded_by` (`uploaded_by`);

--
-- Indexes for table `navigation`
--
ALTER TABLE `navigation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `page_id` (`page_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key` (`key`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `navigation`
--
ALTER TABLE `navigation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `navigation`
--
ALTER TABLE `navigation`
  ADD CONSTRAINT `navigation_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `navigation` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `navigation_ibfk_2` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
