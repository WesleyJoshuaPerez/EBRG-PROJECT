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
-- Table structure for table `jobabsence_cert`
--

CREATE TABLE `jobabsence_cert` (
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `id_pic` varchar(30) NOT NULL,
  `employer` varchar(50) NOT NULL,
  `absence_date` date NOT NULL,
  `duration` int(30) NOT NULL,
  `reason` varchar(50) NOT NULL,
  `apply_myself` varchar(30) NOT NULL,
  `jobabsence_id` int(11) NOT NULL,
  `current_status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobabsence_cert`
--

INSERT INTO `jobabsence_cert` (`first_name`, `middle_name`, `last_name`, `id_pic`, `employer`, `absence_date`, `duration`, `reason`, `apply_myself`, `jobabsence_id`, `current_status`) VALUES
('kate', 'enri', 'rezada', 'msc.png', 'MSC1', '2024-11-20', 1, 'MSC1', 'myself', 1, NULL),
('kate', 'enri', 'rezada', 'msc.png', 'MSC2', '2024-11-19', 2, 'MSC2', 'myself', 2, NULL),
('kate', 'enri', 'rezada', 'msc.png', 'MSC3', '2024-11-05', 3, '123', 'myself', 3, NULL),
('kate', 'enri', 'rezada', 'msc.png', 'MSC4', '2024-11-20', 4, '4', 'myself', 4, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobabsence_cert`
--
ALTER TABLE `jobabsence_cert`
  ADD PRIMARY KEY (`jobabsence_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jobabsence_cert`
--
ALTER TABLE `jobabsence_cert`
  MODIFY `jobabsence_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
