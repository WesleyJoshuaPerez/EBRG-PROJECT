-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2024 at 08:25 AM
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
-- Database: `ebrgy`
--

-- --------------------------------------------------------

--
-- Table structure for table `jobseek_cert`
--

CREATE TABLE `jobseek_cert` (
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `id_pic` varchar(30) NOT NULL,
  `employer` varchar(50) NOT NULL,
  `apply_myself` varchar(30) NOT NULL,
  `jobseek_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobseek_cert`
--

INSERT INTO `jobseek_cert` (`first_name`, `middle_name`, `last_name`, `id_pic`, `employer`, `apply_myself`, `jobseek_id`) VALUES
('kate', 'enri', 'rezada', 'msc.png', 'MSC', '', 1),
('kate', 'enri', 'rezada', 'msc.png', 'MSC1', '', 2),
('kate', 'enri', 'rezada', 'msc.png', 'MSC2', 'myself', 3),
('kate', 'enri', 'rezada', 'msc.png', 'MSC1', '', 4),
('kate', 'enri', 'rezada', 'msc.png', 'MSC1', '', 5),
('kate', 'enri', 'rezada', 'msc.png', 'MSC1', 'myself', 6),
('kate', 'enri', 'rezada', 'msc.png', 'MSC1', 'myself', 7),
('kate', 'enri', 'rezada', 'msc.png', 'MSC1', '', 8),
('kate', 'enri', 'rezada', 'msc.png', 'MSC4', 'myself', 9),
('kate', 'enri', 'rezada', 'msc.png', 'MSC4', 'myself', 10),
('kate', 'enri', 'rezada', 'msc.png', 'MSC1', 'myself', 11),
('kate', 'enri', 'rezada', 'msc.png', 'MSC5', 'myself', 12),
('kate ', 'enri', 'rezada', 'msc.png', 'MSC6', 'myself', 13),
('kate', 'enri', 'rezada', 'msc.png', 'MSC7', 'myself', 14);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobseek_cert`
--
ALTER TABLE `jobseek_cert`
  ADD PRIMARY KEY (`jobseek_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jobseek_cert`
--
ALTER TABLE `jobseek_cert`
  MODIFY `jobseek_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
