-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2025 at 01:47 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todolist`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20250119133919', '2025-01-19 14:39:32', 99),
('DoctrineMigrations\\Version20250119151848', '2025-01-19 16:19:00', 147),
('DoctrineMigrations\\Version20250119153426', '2025-01-19 16:34:34', 137),
('DoctrineMigrations\\Version20250121131840', '2025-01-21 14:18:51', 2152),
('DoctrineMigrations\\Version20250121194603', '2025-01-21 20:46:09', 2424);

-- --------------------------------------------------------

--
-- Table structure for table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_list_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `title`, `description`, `date`, `status`, `task_list_id`) VALUES
(1, 'Tâche 1', 'Description de la tâche 1', '2025-01-06 11:54:51', 'en cours', 1),
(2, 'Tâche 2', 'Description de la tâche 2', '2025-01-07 10:00:00', 'terminée', 1),
(3, 'Tâche 3', 'Description de la tâche 3', '2025-01-08 11:00:00', 'en cours', 2),
(4, 'Tâche 4', 'Description de la tâche 4', '2025-01-09 12:00:00', 'en cours', 3),
(5, 'Tâche 5', 'Description de la tâche 5', '2025-01-10 13:00:00', 'terminée', 4),
(6, 'aa', 'bb', '2025-01-15 22:18:00', 'en cour', 2),
(7, 'aa', 'bb', '2025-01-15 22:18:00', 'en cour', 2),
(8, 'test', 'bbtest', '2025-01-15 22:21:00', 'en cour', 3),
(9, 'test', 'test', '2025-01-25 23:06:00', 'en cour', 6),
(10, 'test', 'test', '2025-01-25 23:07:00', 'en cour', 6),
(11, 'test', 'test', '2025-01-23 23:08:00', 'en cour', 7),
(12, 'test', 'test', '2025-01-08 16:44:00', 'en cour', 7);

-- --------------------------------------------------------

--
-- Table structure for table `task_list`
--

CREATE TABLE `task_list` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `task_list`
--

INSERT INTO `task_list` (`id`, `date`, `user_id`, `name`) VALUES
(1, '2025-01-01 10:00:00', 1, 'my list'),
(2, '2025-01-02 11:00:00', 1, 'list 2 '),
(3, '2025-01-03 12:00:00', 1, 'list 3'),
(4, '2025-01-04 13:00:00', 4, ''),
(5, '2025-01-05 14:00:00', 5, ''),
(6, '2025-01-25 22:54:28', 12, 'test user liste'),
(7, '2025-01-25 22:54:28', 12, 'test user list 2'),
(10, '2025-01-26 19:30:56', 1, 'liste4'),
(12, '2025-01-26 19:33:30', 1, 'liste4'),
(14, '2025-01-26 19:33:53', 1, 'liste5'),
(15, '2025-01-27 11:44:10', 1, 'liste6'),
(18, '2025-01-27 11:52:05', 1, 'liste6'),
(19, '2025-01-27 17:20:09', 12, 'ma lliste'),
(20, '2025-01-30 15:54:24', 12, 'ma liste'),
(21, '2025-01-30 15:55:26', 12, 'ma liste'),
(22, '2025-01-30 15:55:46', 12, 'ma liste'),
(23, '2025-01-30 15:57:26', 12, 'ma liste'),
(24, '2025-01-30 15:57:47', 12, 'ma liste'),
(25, '2025-01-30 15:58:37', 12, 'ma liste'),
(26, '2025-01-30 16:00:51', 12, 'ma liste'),
(27, '2025-01-30 21:48:11', 12, 'liste test'),
(28, '2025-01-31 13:25:24', 12, 'liste test'),
(29, '2025-01-31 13:25:27', 12, 'liste test'),
(30, '2025-01-31 13:31:07', 12, 'liste test');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`) VALUES
(1, 'user1@example.com', '[\"ROLE_ADMIN\"]', '$2y$13$IIG.yrNqRxICjsEBgpukvOu8y75smiXR5K45botbuI/bINwFCxfLq'),
(2, 'user2@example.com', '[\"ROLE_USER\"]', 'hashed_password2'),
(3, 'user3@example.com', '[\"ROLE_USER\"]', 'hashed_password3'),
(4, 'user4@example.com', '[\"ROLE_USER\"]', 'hashed_password4'),
(5, 'user5@example.com', '[\"ROLE_USER\"]', 'hashed_password5'),
(9, 'emna.ghariani@gmail.com', '[\"ROLE_USER\"]', '$2y$13$U8HcPBzzjz.z.oQSUUHkKOeF/jE7E6iLZg1uwvPFBQ2dfN2XjQQB2'),
(10, 'emna@gmail.com', '[\"ROLE_USER\"]', '$2y$13$.TIQaE2MiKrXZAb/y61MBuyTmaOmf25O8TijoYtesIvLyMlMpGMxq'),
(11, 'emna9@gmail.com', '[\"ROLE_USER\"]', '$2y$13$oa5XXWgVkvyDV9KkmF6FGOB9uqo7sq.PFaMyZ2F/vcPhhTBVaK9nC'),
(12, 'test@gmail.com', '[\"ROLE_USER\"]', '$2y$13$IIG.yrNqRxICjsEBgpukvOu8y75smiXR5K45botbuI/bINwFCxfLq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_527EDB25224F3C61` (`task_list_id`);

--
-- Indexes for table `task_list`
--
ALTER TABLE `task_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_377B6C63A76ED395` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `task_list`
--
ALTER TABLE `task_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `FK_527EDB25224F3C61` FOREIGN KEY (`task_list_id`) REFERENCES `task_list` (`id`);

--
-- Constraints for table `task_list`
--
ALTER TABLE `task_list`
  ADD CONSTRAINT `FK_377B6C63A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
