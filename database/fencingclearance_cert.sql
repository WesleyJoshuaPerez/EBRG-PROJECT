-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2024 at 05:20 AM
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
-- Table structure for table `fencingclearance_cert`
--

CREATE TABLE `fencingclearance_cert` (
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `id_pic` varchar(50) NOT NULL,
  `lot_cert` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `apply_myself` varchar(30) NOT NULL,
  `fencingclearance_id` int(11) NOT NULL,
  `current_status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fencingclearance_cert`
--

INSERT INTO `fencingclearance_cert` (`first_name`, `middle_name`, `last_name`, `id_pic`, `lot_cert`, `address`, `apply_myself`, `fencingclearance_id`, `current_status`) VALUES
('0', 'enri', 'rezada', 'msc.png', 'ipconfig2.png', '1', 'myself', 1, NULL),
('0', 'enri', 'rezada', 'msc.png', 'ipconfig2.png', '2', 'myself', 2, NULL),
('0', 'enri', 'rezada', 'msc.png', 'PC2_straight-through.png', '3', 'myself', 3, NULL),
('0', 'enri', 'rezada', 'msc.png', 'ipconfig1.png', '4', 'myself', 4, NULL),
('0', 'enri', 'rezada', 'msc.png', 'ipconfig2.png', '5', 'myself', 5, NULL),
('0', 'enri', 'rezada', 'msc.png', 'ipconfig2.png', '5', 'myself', 6, NULL),
('kate', 'enri', 'rezada', 'msc.png', 'ipconfig1.png', '6', 'myself', 7, NULL),
('kate', 'enri', 'rezada', 'msc.png', 'ipconfig1_straight-through.png', '7', 'myself', 8, NULL),
('kate', 'enri', 'rezada', 'ipconfig1_straight-through.png', 'msc.png', '8', 'myself', 9, NULL),
('kate', 'enri', 'rezada', 'msc.png', 'PC2_straight-through.png', '9', 'myself', 10, NULL),
('kate', 'enri', 'rezada', 'msc.png', 'PC1.png', '10', 'myself', 11, NULL),
('kate', 'enri', 'rezada', 'msc.png', 'PC2.png', '11', 'myself', 12, NULL),
('kate', 'enri', 'rezada', 'msc.png', 'ipconfig2.png', '12', 'myself', 13, NULL),
('kate', 'enri', 'rezada', 'msc.png', 'ipconfig2.png', '13', 'myself', 14, NULL),
('kate', 'enri', 'lksdjfs', 'ipconfig2_straight-through.png', 'PC2_straight-through.png', '14', 'myself', 15, NULL),
('asdsa', 'asdas', 'asda', 'msc.png', 'msc.png', '15', 'myself', 16, NULL),
('asdsa', 'asdas', 'asda', 'msc.png', 'msc.png', '15', 'myself', 17, NULL),
('kjsd', 'aksjd', 'kajsdhh', 'msc.png', 'ipconfig1.png', 'asj', 'myself', 18, NULL),
('sad', 'sad', 'das', 'ipconfig2_straight-through.png', 'PC1.png', 'sada', 'myself', 19, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fencingclearance_cert`
--
ALTER TABLE `fencingclearance_cert`
  ADD PRIMARY KEY (`fencingclearance_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fencingclearance_cert`
--
ALTER TABLE `fencingclearance_cert`
  MODIFY `fencingclearance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
