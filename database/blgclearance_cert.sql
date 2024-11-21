-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2024 at 03:44 PM
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
-- Table structure for table `blgclearance_cert`
--

CREATE TABLE `blgclearance_cert` (
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `lot_cert` varchar(50) NOT NULL,
  `measurement` varchar(50) NOT NULL,
  `apply_myself` varchar(30) NOT NULL,
  `bldgclearance_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blgclearance_cert`
--

INSERT INTO `blgclearance_cert` (`first_name`, `middle_name`, `last_name`, `lot_cert`, `measurement`, `apply_myself`, `bldgclearance_id`) VALUES
('', '', '', 'msc.png', '1', '', 1),
('entry1', 'entry1', 'entry1', 'msc.png', '2', '', 2),
('entry3', 'entry3', 'entry3', 'msc.png', '3', 'myself', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blgclearance_cert`
--
ALTER TABLE `blgclearance_cert`
  ADD PRIMARY KEY (`bldgclearance_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blgclearance_cert`
--
ALTER TABLE `blgclearance_cert`
  MODIFY `bldgclearance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
