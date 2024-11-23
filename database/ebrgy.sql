-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2024 at 02:45 PM
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
-- Table structure for table `blgclearance_cert`
--

CREATE TABLE `blgclearance_cert` (
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `lot_cert` varchar(50) NOT NULL,
  `measurement` varchar(50) NOT NULL,
  `apply_myself` varchar(30) NOT NULL,
  `blgclearance_id` int(11) NOT NULL,
  `current_status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brgyclearance_cert`
--

CREATE TABLE `brgyclearance_cert` (
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `age` int(20) NOT NULL,
  `id_pic` varchar(50) NOT NULL,
  `yrs_occupancy` int(12) NOT NULL,
  `apply_myself` varchar(30) NOT NULL,
  `brgyclearance_id` int(11) NOT NULL,
  `current_status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brgyclearance_cert`
--

INSERT INTO `brgyclearance_cert` (`first_name`, `middle_name`, `last_name`, `age`, `id_pic`, `yrs_occupancy`, `apply_myself`, `brgyclearance_id`, `current_status`) VALUES
('Wesley Joshua', 'Heremis', 'Perez', 17, 'gundam.png', 12, '', 1, NULL),
('Wilfredo M.', 'Mateo', 'Perez Jr', 17, 'gundam.png', 12, '', 2, NULL),
('test', 'test', 'test', 12, 'gundam.png', 13, '', 3, 'rejected');

-- --------------------------------------------------------

--
-- Table structure for table `brgy_announcement`
--

CREATE TABLE `brgy_announcement` (
  `announcement_id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `announcement_title` varchar(100) NOT NULL,
  `announcement_img` varchar(50) NOT NULL,
  `announcement_content` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brgy_announcement`
--

INSERT INTO `brgy_announcement` (`announcement_id`, `admin_id`, `announcement_title`, `announcement_img`, `announcement_content`) VALUES
(8, NULL, 'Announcement', 'RICCS Booth3_PEREZ_NW3D.jfif', 'The announcement of the apparition of the Virgin to an Indian near Mexico City provided a place of pilgrimage and a patroness in Our Lady of Guadalupe; and the friars ingeniously used the hieroglyphic writing for instruction in Christian doctrine, and taught the natives trades, for which they showed');

-- --------------------------------------------------------

--
-- Table structure for table `brgy_event`
--

CREATE TABLE `brgy_event` (
  `brgyevent_id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `brgyevent_title` varchar(100) NOT NULL,
  `brgy_img` varchar(100) NOT NULL,
  `bgry_content` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brgy_event`
--

INSERT INTO `brgy_event` (`brgyevent_id`, `admin_id`, `brgyevent_title`, `brgy_img`, `bgry_content`) VALUES
(2, NULL, 'Father visited the barangay hall', 'Screenshot 2024-11-05 110805.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillu');

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
('asda', 'asd', 'asd', 'NW3D_REZADA_ANGELINEKATE.png', 'ipconfig1.png', 'myself', 1, 'rejected'),
('dasd', 'asda', 'asda', 'PC2_straight-through.png', 'ipconfig2.png', 'myself', 2, NULL),
('Wesley Joshua', 'Heremis', 'Perez', 'wallpaper.jpg', 'icon.ico', '', 3, 'rejected'),
('test', 'test', 'test', 'wallpaper.jpg', 'wallpaper.jpg', '', 4, 'rejected');

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
('Rodrigo', 'Angeles', 'Rodriguez', 'wallpaper.jpg', 'icon.ico', 'Bilolo Site, Orion Bataan', '', 1, 'rejected'),
('test', 'test', 'test', 'wallpaper.jpg', 'wallpaper.jpg', 'Bilolo Site, Orion Bataan', '', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `indigency_cert`
--

CREATE TABLE `indigency_cert` (
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `age` int(10) NOT NULL,
  `id_pic` varchar(50) NOT NULL,
  `assistance_type` varchar(50) NOT NULL,
  `apply_myself` varchar(30) NOT NULL,
  `indigency_id` int(11) NOT NULL,
  `current_status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `indigency_cert`
--

INSERT INTO `indigency_cert` (`first_name`, `middle_name`, `last_name`, `age`, `id_pic`, `assistance_type`, `apply_myself`, `indigency_id`, `current_status`) VALUES
('Wesley Joshua', 'Heremis', 'Perez', 17, 'id  examp.jfif', 'Financial', '', 15, 'rejected'),
('ako', 'sda', 'asdsad', 12, 'wallpaper.jpg', 'Financial', '', 16, 'rejected'),
('new', 'test', 'test', 12, 'wallpaper.jpg', 'Financial', '', 17, 'rejected'),
('test', 'test', 'test', 12, 'RICCS Booth3_PEREZ_NW3D.jfif', 'Medical', '', 18, NULL),
('Rodrigo', 'Angeles', 'Rodriguez', 12, 'id  examp.jfif', 'Medical', '', 19, NULL),
('Troy', 'Francis N.', 'MENDOZA', 18, 'id  examp.jfif', 'Financial', '', 20, NULL),
('PEREZ', 'HEREMIS', 'WESLEYJOSHUA, HERAMIS', 14, 'gundam.png', 'Medical', '', 23, NULL);

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
('Angel', 'Burgers', 'pizaa', 'id  examp.jfif', 'Sto, Domingo Orion, Bataan', '2024-11-05', 1, 'Sick', '', 5, 'rejected'),
('test', 'test', 'test', 'wallpaper.jpg', 'smart comp', '2024-10-28', 1, 'Sick', '', 6, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobseek_cert`
--

CREATE TABLE `jobseek_cert` (
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `id_pic` varchar(30) NOT NULL,
  `employer` varchar(50) NOT NULL,
  `apply_myself` varchar(30) NOT NULL,
  `jobseek_id` int(11) NOT NULL,
  `current_status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobseek_cert`
--

INSERT INTO `jobseek_cert` (`first_name`, `middle_name`, `last_name`, `id_pic`, `employer`, `apply_myself`, `jobseek_id`, `current_status`) VALUES
('Vista', 'Mall', 'Sm', 'id  examp.jfif', 'Bulalo', '', 15, NULL),
('Wesley Joshua', 'Heremis', 'Perez', 'gundam.png', '', '', 16, NULL),
('Wesley Joshua', 'Heremis', 'Perez', 'wallpaper.jpg', '', '', 17, NULL),
('Vista', 'Mall', 'Sm', 'wallpaper.jpg', 'Bulalo', '', 18, NULL),
('test', 'test', 'test', 'wallpaper.jpg', 'smart comp', '', 19, 'rejected');

-- --------------------------------------------------------

--
-- Table structure for table `order_payment`
--

CREATE TABLE `order_payment` (
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `id_pic` varchar(50) NOT NULL,
  `business_name` varchar(50) NOT NULL,
  `business_type` varchar(50) NOT NULL,
  `business_address` varchar(50) NOT NULL,
  `apply_myself` varchar(30) NOT NULL,
  `orderpayment_id` int(11) NOT NULL,
  `current_status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_payment`
--

INSERT INTO `order_payment` (`first_name`, `middle_name`, `last_name`, `id_pic`, `business_name`, `business_type`, `business_address`, `apply_myself`, `orderpayment_id`, `current_status`) VALUES
('sasd', 'asda', 'asd', 'NW3D_REZADA_ANGELINEKATE.png', 'sad', '', '2', 'myself', 2, 'rejected'),
('test', 'test', 'test', 'wallpaper.jpg', 'Sto, Domingo Orion, Bataan', 'Food and Beverage', 'Bilolo Site, Orion Bataan', '', 4, NULL);

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
(3, 'Wesley Joshua', 'Perez', '2004-03-17', 'male', 'Wesley', 'wesleyjoshuaperez@gmail.com', 'Wesley', '7YLB4A3DNK', '2024-11-23 17:45:02', 'Active'),
(4, 'Angeline Kate', 'Rezada', '2003-11-20', 'female', '', '', '', NULL, NULL, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `resetpass_request`
--

CREATE TABLE `resetpass_request` (
  `reset_id` int(11) NOT NULL,
  `reguser_id` int(11) NOT NULL,
  `reset_token` varchar(255) NOT NULL,
  `request_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resetpass_request`
--

INSERT INTO `resetpass_request` (`reset_id`, `reguser_id`, `reset_token`, `request_date`) VALUES
(6, 18, '7OERNVS0FU', '2024-11-13 05:29:23'),
(7, 18, '09RW8JPSL4', '2024-11-13 05:32:17'),
(8, 24, '3LMJ1ATQ9N', '2024-11-13 05:49:22'),
(9, 19, 'ODJG261QTY', '2024-11-13 06:12:28'),
(10, 3, '7YLB4A3DNK', '2024-11-23 10:44:14');

-- --------------------------------------------------------

--
-- Table structure for table `residency_cert`
--

CREATE TABLE `residency_cert` (
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `yrs_occupancy` int(12) NOT NULL,
  `id_pic` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `apply_myself` varchar(30) NOT NULL,
  `residency_id` int(11) NOT NULL,
  `current_status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `residency_cert`
--

INSERT INTO `residency_cert` (`first_name`, `middle_name`, `last_name`, `yrs_occupancy`, `id_pic`, `address`, `apply_myself`, `residency_id`, `current_status`) VALUES
('Rodrigo', 'Angeles', 'Rodriguez', 4, 'id  examp.jfif', 'Bilolo Site, Orion Bataan', '', 9, 'rejected'),
('Rodrigo', 'Angeles', 'Rodriguez', 4, 'gundam.png', 'Bilolo Site, Orion Bataan', '', 10, 'rejected'),
('test', 'test', 'test', 14, 'gundam.png', 'Bilolo Site, Orion Bataan', '', 11, 'rejected'),
('Wesley Joshua', 'Heremis', 'Perez', 12, 'RICCS Booth2_PEREZ_NW3D.jfif', '2323', '', 12, NULL);

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
  `soloparent_id` int(11) NOT NULL,
  `current_status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `soloparent_cert`
--

INSERT INTO `soloparent_cert` (`first_name`, `middle_name`, `last_name`, `id_pic`, `years_of_separation`, `num_children`, `monthly_income`, `source_income`, `apply_myself`, `soloparent_id`, `current_status`) VALUES
('Wilfredo M.', 'Mateo', 'Perez Jr', 'id  examp.jfif', 20, 1, '₱20,000 - ₱30,000', 'Employment', '', 4, 'rejected'),
('wess', 'wew', 'wewe', 'gundam.png', 20, 1, '₱20,000 - ₱30,000', 'Employment', '', 5, NULL),
('test', 'test', 'test', 'gundam.png', 20, 1, '₱10,000 - ₱20,000', 'Employment', '', 6, NULL),
('wewe', 'wewewe', 'wewew', 'RICCS Booth2_PEREZ_NW3D.jfif', 1, 1, '₱10,000 - ₱20,000', 'Employment', '', 7, NULL),
('Angel', 'Burgers', 'pizaa', 'RICCS Booth2_PEREZ_NW3D.jfif', 12, 1, '₱10,000 - ₱20,000', 'Employment', '', 8, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blgclearance_cert`
--
ALTER TABLE `blgclearance_cert`
  ADD PRIMARY KEY (`blgclearance_id`);

--
-- Indexes for table `brgyclearance_cert`
--
ALTER TABLE `brgyclearance_cert`
  ADD PRIMARY KEY (`brgyclearance_id`);

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
-- Indexes for table `daycare_shortlisting`
--
ALTER TABLE `daycare_shortlisting`
  ADD PRIMARY KEY (`daycareshortlisting_id`);

--
-- Indexes for table `electricity_clearance`
--
ALTER TABLE `electricity_clearance`
  ADD PRIMARY KEY (`electricityclearance_id`);

--
-- Indexes for table `fencingclearance_cert`
--
ALTER TABLE `fencingclearance_cert`
  ADD PRIMARY KEY (`fencingclearance_id`);

--
-- Indexes for table `indigency_cert`
--
ALTER TABLE `indigency_cert`
  ADD PRIMARY KEY (`indigency_id`);

--
-- Indexes for table `jobabsence_cert`
--
ALTER TABLE `jobabsence_cert`
  ADD PRIMARY KEY (`jobabsence_id`);

--
-- Indexes for table `jobseek_cert`
--
ALTER TABLE `jobseek_cert`
  ADD PRIMARY KEY (`jobseek_id`);

--
-- Indexes for table `order_payment`
--
ALTER TABLE `order_payment`
  ADD PRIMARY KEY (`orderpayment_id`);

--
-- Indexes for table `registereduser_ebrg`
--
ALTER TABLE `registereduser_ebrg`
  ADD PRIMARY KEY (`reguser_id`);

--
-- Indexes for table `resetpass_request`
--
ALTER TABLE `resetpass_request`
  ADD PRIMARY KEY (`reset_id`);

--
-- Indexes for table `residency_cert`
--
ALTER TABLE `residency_cert`
  ADD PRIMARY KEY (`residency_id`);

--
-- Indexes for table `soloparent_cert`
--
ALTER TABLE `soloparent_cert`
  ADD PRIMARY KEY (`soloparent_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blgclearance_cert`
--
ALTER TABLE `blgclearance_cert`
  MODIFY `blgclearance_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brgyclearance_cert`
--
ALTER TABLE `brgyclearance_cert`
  MODIFY `brgyclearance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `brgy_announcement`
--
ALTER TABLE `brgy_announcement`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `brgy_event`
--
ALTER TABLE `brgy_event`
  MODIFY `brgyevent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `daycare_shortlisting`
--
ALTER TABLE `daycare_shortlisting`
  MODIFY `daycareshortlisting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `electricity_clearance`
--
ALTER TABLE `electricity_clearance`
  MODIFY `electricityclearance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fencingclearance_cert`
--
ALTER TABLE `fencingclearance_cert`
  MODIFY `fencingclearance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `indigency_cert`
--
ALTER TABLE `indigency_cert`
  MODIFY `indigency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `jobabsence_cert`
--
ALTER TABLE `jobabsence_cert`
  MODIFY `jobabsence_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jobseek_cert`
--
ALTER TABLE `jobseek_cert`
  MODIFY `jobseek_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `order_payment`
--
ALTER TABLE `order_payment`
  MODIFY `orderpayment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `registereduser_ebrg`
--
ALTER TABLE `registereduser_ebrg`
  MODIFY `reguser_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `resetpass_request`
--
ALTER TABLE `resetpass_request`
  MODIFY `reset_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `residency_cert`
--
ALTER TABLE `residency_cert`
  MODIFY `residency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `soloparent_cert`
--
ALTER TABLE `soloparent_cert`
  MODIFY `soloparent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
