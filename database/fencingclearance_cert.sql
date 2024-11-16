-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2024 at 05:58 AM
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
  `apply_myself` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fencingclearance_cert`
--

INSERT INTO `fencingclearance_cert` (`first_name`, `middle_name`, `last_name`, `id_pic`, `lot_cert`, `address`, `apply_myself`) VALUES
('0', 'enri', 'rezada', 'msc.png', 'ipconfig2.png', '1', 'myself'),
('0', 'enri', 'rezada', 'msc.png', 'ipconfig2.png', '2', 'myself'),
('0', 'enri', 'rezada', 'msc.png', 'PC2_straight-through.png', '3', 'myself'),
('0', 'enri', 'rezada', 'msc.png', 'ipconfig1.png', '4', 'myself'),
('0', 'enri', 'rezada', 'msc.png', 'ipconfig2.png', '5', 'myself'),
('0', 'enri', 'rezada', 'msc.png', 'ipconfig2.png', '5', 'myself'),
('kate', 'enri', 'rezada', 'msc.png', 'ipconfig1.png', '6', 'myself');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
