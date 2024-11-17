-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2024 at 05:19 AM
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
-- Table structure for table `residency_cert`
--

CREATE TABLE `residency_cert` (
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `yrs_occupancy` int(12) NOT NULL,
  `id_pic` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `apply_myself` varchar(30) NOT NULL,
  `residency_id` int(11) NOT NULL,
  `current_status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `residency_cert`
--

INSERT INTO `residency_cert` (`first_name`, `middle_name`, `last_name`, `yrs_occupancy`, `id_pic`, `address`, `apply_myself`, `residency_id`, `current_status`) VALUES
('kate', 'enri', 'rezada', 0, 'msc.png', '123', '', 1, NULL),
('kate', 'enri', 'rezada', 0, 'msc.png', '123', '', 2, NULL),
('kate', 'enri', 'rezada', 1, 'msc.png', '123', '', 3, NULL),
('kate', 'enri', 'rezada', 2, 'msc.png', '123', '', 4, NULL),
('kate', 'enri', 'rezada', 3, 'msc.png', '123', '', 5, NULL),
('kate', 'enri', 'rezada', 4, 'msc.png', '123', 'myself', 6, NULL),
('kate', 'enri', 'rezada', 5, 'msc.png', '123', 'myself', 7, NULL),
('kate', 'enri', 'rezada', 6, 'NW3D_REZADA_ANGELINEKATE.png', '6', '', 8, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `residency_cert`
--
ALTER TABLE `residency_cert`
  ADD PRIMARY KEY (`residency_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `residency_cert`
--
ALTER TABLE `residency_cert`
  MODIFY `residency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
