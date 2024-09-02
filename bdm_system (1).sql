-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2024 at 01:36 AM
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
-- Database: `bdm_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'John Dave De Leon', '1cb0cdc8e1b1eb48007630ade5eec466'),
(5, 'Yvan Kalalo', 'afb2db0288a495a9e14dd013036f1e0a');

-- --------------------------------------------------------

--
-- Table structure for table `admin_log`
--

CREATE TABLE `admin_log` (
  `id` int(255) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `activity` enum('IN','OUT') NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_log`
--

INSERT INTO `admin_log` (`id`, `admin_name`, `activity`, `login_time`) VALUES
(1, 'John Dave De Leon', 'IN', '2023-12-14 20:22:02'),
(2, 'John Dave De Leon', 'OUT', '2023-12-14 20:38:47'),
(3, 'John Dave De Leon', 'IN', '2023-12-14 20:41:50'),
(4, 'John Dave De Leon', 'OUT', '2023-12-14 21:39:26'),
(5, 'John Dave De Leon', 'IN', '2023-12-14 21:39:37'),
(6, 'John Dave De Leon', 'IN', '2023-12-14 23:53:42'),
(7, 'John Dave De Leon', 'IN', '2023-12-15 01:00:43'),
(8, 'John Dave De Leon', 'OUT', '2023-12-15 04:34:40'),
(9, 'John Dave De Leon', 'IN', '2023-12-15 04:40:28'),
(10, 'John Dave De Leon', 'IN', '2023-12-15 18:42:27'),
(11, 'John Dave De Leon', 'OUT', '2023-12-15 19:19:54'),
(12, 'John Dave De Leon', 'IN', '2023-12-15 21:41:09'),
(13, 'Yvan Kalalo', 'IN', '2023-12-15 22:03:47'),
(14, 'John Dave De Leon', 'IN', '2023-12-15 22:10:50'),
(15, 'John Dave De Leon', 'IN', '2023-12-15 23:49:03'),
(16, 'John Dave De Leon', 'OUT', '2023-12-15 23:50:03'),
(17, 'John Dave De Leon', 'IN', '2023-12-16 00:40:00'),
(18, 'John Dave De Leon', 'OUT', '2023-12-16 02:08:28');

-- --------------------------------------------------------

--
-- Table structure for table `donator`
--

CREATE TABLE `donator` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `blood_type` varchar(255) NOT NULL,
  `age` int(255) NOT NULL,
  `weight` int(255) NOT NULL,
  `unit` int(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donator`
--

INSERT INTO `donator` (`id`, `username`, `blood_type`, `age`, `weight`, `unit`, `status`) VALUES
(25, 'John Dave De Leon', 'A', 25, 129, 12, '1'),
(27, 'John Dave De Leon', 'A', 22, 134, 123, ''),
(28, 'John Dave De Leon', 'B', 34, 133, 21, '2'),
(29, 'Yvan Kalalo', 'A+', 21, 134, 32, ''),
(30, 'Yvan Kalalo', 'AB', 21, 134, 122, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `secretword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `mobile`, `secretword`) VALUES
(17, 'John Dave De Leon', 'dave@gmail.com', '7ca1a337b1717c8296769d6747296600', '09423423432', '1cb0cdc8e1b1eb48007630ade5eec466'),
(21, 'Yvan Kalalo', 'yvan@gmail.com', '0b8e9f48f074fcb15cbaabec57abe956', '09423423432', '0b8e9f48f074fcb15cbaabec57abe956'),
(22, 'Elaine Mendoza', 'elaine@gmail.com', '13535cf6263e4fc4ef576f0bbd2564cf', '09423423433', '4b6ba9e48884cebb46b54d856967143d');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_log`
--
ALTER TABLE `admin_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donator`
--
ALTER TABLE `donator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `admin_log`
--
ALTER TABLE `admin_log`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `donator`
--
ALTER TABLE `donator`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
