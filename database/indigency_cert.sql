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
-- Table structure for table `indigency_cert`
--

CREATE TABLE `indigency_cert` (
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `age` int(10) NOT NULL,
  `id_pic` varchar(50) NOT NULL,
  `assistance_type` varchar(50) NOT NULL,
  `apply_myself` varchar(30) NOT NULL,
  `indigency_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `indigency_cert`
--

INSERT INTO `indigency_cert` (`first_name`, `middle_name`, `last_name`, `age`, `id_pic`, `assistance_type`, `apply_myself`, `indigency_id`) VALUES
('kate', 'enri', 'rezada', 1, 'msc.png', 'Medical', '', 1),
('kate', 'enri', 'rezada', 20, 'NW3D_REZADA_ANGELINEKATE.png', 'Medical', '', 2),
('kate', 'enri', 'rezada', 2, 'msc.png', 'Financial', '', 3),
('kate', 'enriquez', 'rezada', 1, 'msc.png', 'Financial', '', 4),
('justin', 'herrera', 'garcia', 1, 'msc.png', 'Financial', '', 5),
('kate', 'enri', 'rezada', 2, 'msc.png', 'Financial', '', 6),
('kate', 'enr', 'rezada', 3, 'msc.png', 'Financial', '', 7),
('kate', 'enri', 'rezada', 4, 'msc.png', 'Financial', 'myself', 8),
('kate', 'enri', 'rezada', 5, 'msc.png', 'Financial', 'myself', 9),
('kate', 'enri', 'rezada', 6, 'ipconfig1_straight-through.png', 'Financial', 'myself', 10),
('kate', 'enri', 'rezada', 7, 'ipconfig1.png', 'Medical', 'myself', 11),
('kate', 'enri', 'rezada', 8, 'msc.png', 'Financial', 'myself', 12),
('kate', 'enri', 'rezada', 13, 'msc.png', 'Financial', 'myself', 13);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `indigency_cert`
--
ALTER TABLE `indigency_cert`
  ADD PRIMARY KEY (`indigency_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `indigency_cert`
--
ALTER TABLE `indigency_cert`
  MODIFY `indigency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
