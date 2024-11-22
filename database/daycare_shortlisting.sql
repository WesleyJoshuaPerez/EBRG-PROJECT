-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2024 at 02:07 PM
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
-- Table structure for table `daycare_shortlisting`
--

CREATE TABLE `daycare_shortlisting` (
  `student_fname` varchar(30) NOT NULL,
  `student_mname` varchar(30) NOT NULL,
  `student_lname` varchar(30) NOT NULL,
  `student_healthrecord` varchar(50) NOT NULL,
  `student_birthcert` varchar(50) NOT NULL,
  `student_level` varchar(30) NOT NULL,
  `guardian_fname` varchar(30) NOT NULL,
  `guardian_mname` varchar(30) NOT NULL,
  `guardian_lname` varchar(30) NOT NULL,
  `guardian_age` int(10) NOT NULL,
  `guardian_id` varchar(50) NOT NULL,
  `guardian_contactnum` int(15) NOT NULL,
  `daycareshortlisting_id` int(11) NOT NULL,
  `current_status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daycare_shortlisting`
--

INSERT INTO `daycare_shortlisting` (`student_fname`, `student_mname`, `student_lname`, `student_healthrecord`, `student_birthcert`, `student_level`, `guardian_fname`, `guardian_mname`, `guardian_lname`, `guardian_age`, `guardian_id`, `guardian_contactnum`, `daycareshortlisting_id`, `current_status`) VALUES
('kate', 'enriquez', 'rezada', 'msc.png', 'msc.png', 'Kinder II', 'hyndrix', 'enriquez', 'rezada', 100, 'msc.png', 92222222, 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daycare_shortlisting`
--
ALTER TABLE `daycare_shortlisting`
  ADD PRIMARY KEY (`daycareshortlisting_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daycare_shortlisting`
--
ALTER TABLE `daycare_shortlisting`
  MODIFY `daycareshortlisting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
