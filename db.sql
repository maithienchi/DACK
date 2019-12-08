-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2019 at 06:48 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo1`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `content` varchar(1024) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `userId`, `content`, `createdAt`) VALUES
(1, 1, 'Em gái mưa@@', '2017-10-16 09:51:24'),
(2, 1, 'Trời lại sắp mưa...', '2017-10-16 10:01:56'),
(3, 2, 'Trời đang mưa', '2017-10-16 10:07:42'),
(4, 5, 'dsccdsc', '2019-11-04 17:54:04'),
(5, 5, 'dscdscds', '2019-11-04 17:54:07'),
(6, 5, 'fdvdfvfdv', '2019-11-04 17:54:10'),
(7, 5, 'ccxcxv', '2019-11-04 17:54:16'),
(8, 1, 'cxzcxzc', '2019-11-05 01:16:26'),
(9, 1, '123', '2019-11-05 01:16:30'),
(10, 4, 'czxcxzc', '2019-11-05 01:23:32'),
(11, 1, 'cxzcxzc', '2019-11-05 02:16:47'),
(12, 1, 'xccxxcv', '2019-11-05 03:38:34'),
(13, 1, '1222', '2019-11-05 03:38:39'),
(14, 1, 'csaascascas', '2019-11-05 10:32:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `displayName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hasAvatar` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `code` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `displayName`, `email`, `password`, `hasAvatar`, `status`, `code`) VALUES
(1, 'i Love You', 'mtchi@gmail.com', '$2y$10$NWxlYKOcU5OK62UU0CY1PO54Vd1J2saC0qx51iPOFsoZ8rOjsNSA.', 1, 1, ''),
(2, 'Mai Thien Chi', 'mtchi1@gmail.com', '$2y$10$CUc8OEDoAKaTprGc88EpH.A45zK6GDTIt8LNNbtUtTAqX0mfm8ySq', 1, 1, ''),
(6, 'mai thien chi', 'mtchi2@gmail.com', '$2y$10$dwLE83/HMXTvmX.CkOsD5uls2m8Najhd8ZQjb0eDlGnmq4enaA5m2', 1, 1, ''),
(13, 'mai thien chi', 'mtchi99@gmail.com', '$2y$10$4AeaubgZBOaVUhhJVW6an.D7eWI2n7e6gZ24aCWaJaia9wno5w.F2', 0, 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
