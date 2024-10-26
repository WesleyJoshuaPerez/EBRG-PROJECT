-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2024 at 09:04 AM
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
-- Table structure for table `brgy_announcement`
--

CREATE TABLE `brgy_announcement` (
  `announcement_id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `announcement_title` varchar(30) NOT NULL,
  `announcement_img` varchar(50) NOT NULL,
  `announcement_content` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brgy_event`
--

CREATE TABLE `brgy_event` (
  `brgyevent_id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `brgyevent_title` varchar(20) NOT NULL,
  `brgy_img` varchar(100) NOT NULL,
  `bgry_content` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registereduser_ebrg`
--

INSERT INTO `registereduser_ebrg` (`reguser_id`, `firstname`, `lastname`, `birthday`, `gender`, `username`, `email`, `password`) VALUES
(8, 'Wesley Joshua', 'Perez ', '2004-03-17', 'male', 'wes', 'wesleyjoshuaperez@gmail.com', '0db7e7a347aaa68a26218df2a01c99c6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brgy_announcement`
--
ALTER TABLE `brgy_announcement`
  ADD PRIMARY KEY (`announcement_id`);

--
-- Indexes for table `brgy_event`
--
ALTER TABLE `brgy_event`
  ADD PRIMARY KEY (`brgyevent_id`);

--
-- Indexes for table `registereduser_ebrg`
--
ALTER TABLE `registereduser_ebrg`
  ADD PRIMARY KEY (`reguser_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brgy_announcement`
--
ALTER TABLE `brgy_announcement`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brgy_event`
--
ALTER TABLE `brgy_event`
  MODIFY `brgyevent_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registereduser_ebrg`
--
ALTER TABLE `registereduser_ebrg`
  MODIFY `reguser_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
