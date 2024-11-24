-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2024 at 10:40 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `registereduser_ebrg`
--

CREATE TABLE `registereduser_ebrg` (
  `reguser_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `birthday` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` varchar(10) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `account_status` varchar(200) DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registereduser_ebrg`
--

INSERT INTO `registereduser_ebrg` (`reguser_id`, `firstname`, `lastname`, `birthday`, `gender`, `username`, `email`, `password`, `code`, `updated_time`, `account_status`) VALUES
(1, 'Troy Francis', 'Mendoza', '2004-09-09', 'male', '', '', '', NULL, NULL, 'Active'),
(2, 'Sebastian Kean', 'Paclaon', '2003-09-09', 'male', '', '', '', NULL, NULL, 'Active'),
(3, 'Wesley Joshua', 'Perez', '2004-03-17', 'male', 'Wesley', 'wesleyjoshuaperez@gmail.com', 'wesley', NULL, NULL, 'Active'),
(4, 'Angeline Kate', 'Rezada', '2003-11-20', '', '', '', '', NULL, NULL, 'Active');
(1, 'TROY FRANCIS', 'MENDOZA', '2004-09-09', 'male', NULL, NULL, NULL, NULL, NULL, 'Active'),
(2, 'SEBASTIAN KEAN', 'PACLAON', '2003-09-09', 'male', NULL, NULL, NULL, NULL, NULL, 'Active'),
(3, 'WESLEY JOSHUA', 'PEREZ', '2004-03-17', 'male', 'Wesley', 'wesleyjoshuaperez@gmail.com', 'wesley', NULL, NULL, 'Active'),
(4, 'ANGELINE KATE', 'REZADA', '2003-11-20', NULL, NULL, NULL, NULL, NULL, NULL, 'Active'),
(5, 'SYSTEM', 'ROOT', '2003-11-24', 'female', 'SYSTEM ROOT', 'akerezada@bpsu.edu.ph', 'systemRoot20', '3D24F9PTQW', '2024-11-24 14:27:26'
, 'Active');


--
-- Indexes for dumped tables
--

--
-- Indexes for table `registereduser_ebrg`
--
ALTER TABLE `registereduser_ebrg`
  ADD PRIMARY KEY (`reguser_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `registereduser_ebrg`
--
ALTER TABLE `registereduser_ebrg`
  MODIFY `reguser_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
