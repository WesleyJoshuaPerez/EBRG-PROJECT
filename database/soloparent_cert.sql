-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2024 at 08:26 AM
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
-- Table structure for table `soloparent_cert`
--

CREATE TABLE `soloparent_cert` (
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `id_pic` varchar(50) NOT NULL,
  `years_of_separation` int(30) NOT NULL,
  `num_children` int(30) NOT NULL,
  `monthly_income` varchar(20) DEFAULT NULL,
  `source_income` varchar(30) NOT NULL,
  `apply_myself` varchar(30) NOT NULL,
  `soloparent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `soloparent_cert`
--

INSERT INTO `soloparent_cert` (`first_name`, `middle_name`, `last_name`, `id_pic`, `years_of_separation`, `num_children`, `monthly_income`, `source_income`, `apply_myself`, `soloparent_id`) VALUES
('kate', 'enri', 'rezada', 'msc.png', 1, 1, '', '', 'myself', 1),
('kate', 'enri', 'rezada', 'msc.png', 2, 2, '₱10,000 - ₱20,000', 'Employment', 'myself', 2),
('kate', 'enri', 'rezada', 'msc.png', 3, 3, '₱10,000 - ₱20,000', 'Self-Employment', 'myself', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `soloparent_cert`
--
ALTER TABLE `soloparent_cert`
  ADD PRIMARY KEY (`soloparent_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `soloparent_cert`
--
ALTER TABLE `soloparent_cert`
  MODIFY `soloparent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
