-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: sql106.infinityfree.com
-- Generation Time: Jun 15, 2023 at 06:38 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `if0_34430476_musiclibrary`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `type`) VALUES
(12, 'Shishir Shrestha', 'shishir9', 'shishirshrestha@ismt.edu.np', '$2y$10$mfgIDxqf3f6KuvF8N5ix2OApzcLgvE94ePz3RIi9TBAzZ.kfpGq4W', 'user'),
(13, 'Shishir Shrestha', 'shishir91', 'shresthashishir91@gmail.com', '$2y$10$32OYH2AFedMj72KFJiOZ..ihJNyFBCXwQotlwMoWRCE57TWK1faUa', 'user'),
(14, 'Shishir Shrestha', 'shishir90', 'shresthashishir91@gmail.com', '$2y$10$fWiHvCMEC6.BNOwn4h8IB.Z95P7hK0YQ9PD/R5rgjc7ORirXQPnXS', 'user'),
(17, 'Admin', 'admin', 'admin@admin.com', '$2y$10$1m6R0zXASUvRGktdi/VsYuG/bIjcJTj/0MET/vQ4edkf9bXrpfVHO', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
