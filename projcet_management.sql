-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 17, 2024 at 11:52 AM
-- Server version: 5.7.36
-- PHP Version: 8.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projcet_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_project`
--

CREATE TABLE `tb_project` (
  `project_id` int(11) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_project`
--

INSERT INTO `tb_project` (`project_id`, `project_name`, `created_at`, `updated_at`) VALUES
(1, 'web api', '2024-03-17 03:35:12', '2024-03-17 03:35:12'),
(2, 'Database', '2024-03-17 03:35:32', '2024-03-17 03:50:08'),
(3, 'Background process', '2024-03-17 03:35:46', '2024-03-17 03:50:51'),
(4, 'Web Application', '2024-03-17 03:37:40', '2024-03-17 03:37:40'),
(5, 'Windows application', '2024-03-17 03:37:52', '2024-03-17 03:37:52');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tasks`
--

CREATE TABLE `tb_tasks` (
  `task_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `iconproject` varchar(255) DEFAULT NULL,
  `task_desc` text,
  `task_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(2, 'Amontep rrsssr', 'sirada.maylove@gmail.com', '$2y$10$6Yg6/uEq8II0fAPc34gHtuTAgCM8O/pk9vAj9uEFgxj/NM4fLjVKa', '2024-03-17 01:09:47', '2024-03-17 01:58:12'),
(3, 'Amontep Phaochu', 'smos03351@gmail.com', '$2y$10$cpK0oqgrJUSZCMAVmkU30OR/2dNxvxX8TZOWy3wol0iPRB0i0JWQy', '2024-03-17 01:12:39', '2024-03-17 01:12:39'),
(4, 'Amontep Phaochu', 'sira34da.maylove@gmail.com', '$2y$10$wz3Zt8/yU4HKhVHrIDQR8.53WBDPwxW1EHiABkhRHX3dAfooLATEK', '2024-03-17 01:13:17', '2024-03-17 01:13:17'),
(5, 'ฟหกฟหก', 'mos03351@gmail.com', '$2y$10$wcXsTbE9nNgWasrXTMSu1.92LcLLe.4efevPexy0yt3t0jLX30YYW', '2024-03-17 01:21:43', '2024-03-17 01:21:43'),
(6, 'mosssd', 'amsl@gmail.com', '$2y$10$r2nhOjbmIqMWkuWbgqwcS.tKcNlcfKHnNgjX3ZkvLIqOun.nadE5.', '2024-03-17 01:59:53', '2024-03-17 01:59:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_project`
--
ALTER TABLE `tb_project`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `tb_tasks`
--
ALTER TABLE `tb_tasks`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_project`
--
ALTER TABLE `tb_project`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_tasks`
--
ALTER TABLE `tb_tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_tasks`
--
ALTER TABLE `tb_tasks`
  ADD CONSTRAINT `tb_tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tb_tasks_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `tb_project` (`project_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
