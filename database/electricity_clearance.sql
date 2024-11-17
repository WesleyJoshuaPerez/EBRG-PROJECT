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
-- Table structure for table `electricity_clearance`
--

CREATE TABLE `electricity_clearance` (
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `id_pic` varchar(50) NOT NULL,
  `lot_cert` varchar(50) NOT NULL,
  `apply_myself` varchar(30) NOT NULL,
  `electricityclearance_id` int(11) NOT NULL,
  `current_status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `electricity_clearance`
--

INSERT INTO `electricity_clearance` (`first_name`, `middle_name`, `last_name`, `id_pic`, `lot_cert`, `apply_myself`, `electricityclearance_id`, `current_status`) VALUES
('asda', 'asd', 'asd', 'NW3D_REZADA_ANGELINEKATE.png', 'ipconfig1.png', 'myself', 1, NULL),
('dasd', 'asda', 'asda', 'PC2_straight-through.png', 'ipconfig2.png', 'myself', 2, NULL),
('das', 'dkaj', 'jkasd', 'PC1-straight_through.png', 'ipconfig1_straight-through.png', 'myself', 3, NULL),
('asdja', 'askjas', 'sjad', 'PC1-straight_through.png', 'ipconfig2_straight-through.png', 'myself', 4, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `electricity_clearance`
--
ALTER TABLE `electricity_clearance`
  ADD PRIMARY KEY (`electricityclearance_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `electricity_clearance`
--
ALTER TABLE `electricity_clearance`
  MODIFY `electricityclearance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
