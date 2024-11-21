-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2024 at 03:45 PM
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
  `daycareshortlisting_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daycare_shortlisting`
--

INSERT INTO `daycare_shortlisting` (`student_fname`, `student_mname`, `student_lname`, `student_healthrecord`, `student_birthcert`, `student_level`, `guardian_fname`, `guardian_mname`, `guardian_lname`, `guardian_age`, `guardian_id`, `guardian_contactnum`, `daycareshortlisting_id`) VALUES
('fsdf', 'sdfs', 'fsdfs', 'Rezada, Angeline Kate E. - LM01-packet 04 - Activi', 'PC2_straight-through.png', '', 'dsfs', 'fsdfs', 'fsdfs', 23, 'PC2_straight-through.png', 0, 1),
('dasd', 'asda', 'adsda', 'ipconfig2_straight-through.png', 'ipconfig2.png', '', 'asda', 'asda', 'asda', 2, 'PC2_straight-through.png', 0, 2),
('entry1', 'entry1', 'entry1', 'msc.png', 'msc.png', '', 'entry1', 'entry1', 'entry1', 1, 'msc.png', 0, 3),
('entry2', 'entry2', 'entry2', 'msc.png', 'msc.png', 'Kinder II', 'entry2', 'entry2', 'entry2', 2, 'msc.png', 0, 4),
('entry3', 'entry3', 'entry3', 'msc.png', 'msc.png', 'Kinder II', 'entry3', 'entry3', 'entry3', 3, 'msc.png', 3, 5);

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
  MODIFY `daycareshortlisting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
