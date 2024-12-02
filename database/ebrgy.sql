-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2024 at 04:31 AM
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
-- Table structure for table `admin_ebrgy`
--

CREATE TABLE `admin_ebrgy` (
  `admin_id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `updated_time` datetime DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_ebrgy`
--

INSERT INTO `admin_ebrgy` (`admin_id`, `firstname`, `lastname`, `birthday`, `gender`, `username`, `email`, `password`, `updated_time`, `role`) VALUES
(1, 'Admin', 'Super', '2004-03-17', 'Male', 'AdminSuper', 'wesleyjoshuaperez.iskolar@gmail.com', 'SuperAdmin18', '2024-12-02 11:29:51', 'superadmin'),
(2, 'Admin', 'Only', '2004-03-17', 'male', 'Admin2004', 'deves39407@confmin.com', 'AdminOnly18', '2024-12-02 11:25:57', 'admin');

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
  `current_status` varchar(20) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `pickup_date` date DEFAULT NULL,
  `remarks` varchar(50) NOT NULL
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
  `current_status` varchar(20) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `pickup_date` date DEFAULT NULL,
  `remarks` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brgy_announcement`
--

CREATE TABLE `brgy_announcement` (
  `announcement_id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `announcement_title` varchar(100) NOT NULL,
  `announcement_img` varchar(50) NOT NULL,
  `announcement_content` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brgy_announcement`
--

INSERT INTO `brgy_announcement` (`announcement_id`, `admin_id`, `announcement_title`, `announcement_img`, `announcement_content`) VALUES
(1, NULL, 'Barangay Cleanup Drive 2024', 'OIP.jpg', 'We are calling all residents of Barangay Roosevelt, Dinalupihan, Bataan to join our Barangay Cleanup Drive this coming Saturday. Let’s work together to keep our community clean and green. Bring your cleaning tools and let\'s make a difference together! For more details, please contact the Barangay Office.'),
(2, NULL, 'Barangay Assembly Meeting', 'BARANGAY-ASSEMBLY_4.jpg', 'Attention all residents of Barangay Roosevelt! You are invited to our upcoming Barangay Assembly Meeting. This is your chance to stay updated on community projects and raise concerns or suggestions. Let’s work hand-in-hand for the betterment of our barangay!');

-- --------------------------------------------------------

--
-- Table structure for table `brgy_event`
--

CREATE TABLE `brgy_event` (
  `brgyevent_id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `brgyevent_title` varchar(100) NOT NULL,
  `brgy_img` varchar(100) NOT NULL,
  `bgry_content` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brgy_event`
--

INSERT INTO `brgy_event` (`brgyevent_id`, `admin_id`, `brgyevent_title`, `brgy_img`, `bgry_content`) VALUES
(1, NULL, 'Paskong Bayan: Community Christmas Festival 2024', '51741665924_f1c2d84294_b.jpg', 'Join us for a joyous celebration of the holiday season at Barangay Roosevelt, Dinalupihan, Bataan! Experience a night filled with festive activities, cultural performances, and a community feast. Let’s come together to spread cheer, unity, and the true spirit of Christmas.'),
(2, NULL, 'Health and Wellness Fair 2024', 'OIP (1).jpg', 'Come and participate in our Health and Wellness Fair at Barangay Roosevelt, Dinalupihan, Bataan! Enjoy free medical check-ups, wellness workshops, and fitness activities aimed at promoting a healthier community. Everyone is welcome—don’t miss this chance to prioritize your heal');

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
  `username` varchar(100) NOT NULL,
  `pickup_date` date DEFAULT NULL,
  `remarks` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `current_status` varchar(20) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `pickup_date` date DEFAULT NULL,
  `remarks` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `current_status` varchar(20) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `pickup_date` date DEFAULT NULL,
  `remarks` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `current_status` varchar(20) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `pickup_date` date DEFAULT NULL,
  `remarks` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `indigency_cert`
--

INSERT INTO `indigency_cert` (`first_name`, `middle_name`, `last_name`, `age`, `id_pic`, `assistance_type`, `apply_myself`, `indigency_id`, `current_status`, `username`, `pickup_date`, `remarks`) VALUES
('PEREZ', 'HEREMIS', 'WESLEYJOSHUA, HERAMIS', 18, 'id.jfif', 'Financial', '', 1, 'accepted', 'Wesley', '2024-12-31', 'Bring valid id during pick-up');

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
  `current_status` varchar(20) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `pickup_date` date DEFAULT NULL,
  `remarks` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `current_status` varchar(20) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `pickup_date` date DEFAULT NULL,
  `remarks` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `current_status` varchar(20) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `pickup_date` date DEFAULT NULL,
  `remarks` varchar(50) NOT NULL
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
  `password` varchar(255) NOT NULL,
  `updated_time` datetime DEFAULT NULL,
  `account_status` varchar(200) DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registereduser_ebrg`
--

INSERT INTO `registereduser_ebrg` (`reguser_id`, `firstname`, `lastname`, `birthday`, `gender`, `username`, `email`, `password`, `updated_time`, `account_status`) VALUES
(1, 'Troy Francis', 'Mendoza', '2004-09-09', 'male', 'TROY123', 'perezwesley17@gmail.com', 'Troy2004', '2024-12-02 11:28:15', 'Active'),
(2, 'Sebastian Kean', 'Paclaon', '2003-09-09', 'male', '', '', '', NULL, 'Active'),
(3, 'Wesley Joshua', 'Perez', '2004-03-17', 'male', 'Wesley', 'wesleyjoshuaperez@gmail.com', 'Perez17Wesley', '2024-12-02 11:19:16', 'Active'),
(4, 'Angeline Kate', 'Rezada', '2003-11-20', 'female', '', '', '', NULL, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `resetpass_request`
--

CREATE TABLE `resetpass_request` (
  `reset_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reset_token` varchar(255) NOT NULL,
  `request_date` datetime NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resetpass_request`
--

INSERT INTO `resetpass_request` (`reset_id`, `user_id`, `reset_token`, `request_date`, `user_type`, `email`) VALUES
(34, 3, 'WA3YS2EJZF', '2024-12-02 03:53:13', 'user', 'wesleyjoshuaperez@gmail.com'),
(35, 1, 'WZF3678QXL', '2024-12-02 03:54:15', 'admin', 'wesleyjoshuaperez.iskolar@gmail.com'),
(36, 1, 'HQ8SRVO4YX', '2024-12-02 03:56:54', 'admin', 'wesleyjoshuaperez.iskolar@gmail.com'),
(37, 1, 'AKWXZJP86H', '2024-12-02 04:14:56', 'admin', 'wesleyjoshuaperez.iskolar@gmail.com'),
(38, 1, 'LFM8DS02KB', '2024-12-02 04:16:09', 'user', 'perezwesley17@gmail.com'),
(39, 3, 'N0TZRSMA1L', '2024-12-02 04:18:37', 'user', 'wesleyjoshuaperez@gmail.com'),
(40, 1, 'REOAGK02IV', '2024-12-02 04:19:52', 'user', 'perezwesley17@gmail.com'),
(41, 1, 'VUFYOK7C5W', '2024-12-02 04:24:26', 'user', 'perezwesley17@gmail.com'),
(42, 2, 'TLOR0HPIVJ', '2024-12-02 04:25:25', 'admin', 'deves39407@confmin.com'),
(43, 1, '36H5LD980Y', '2024-12-02 04:27:41', 'user', 'perezwesley17@gmail.com'),
(44, 1, '58IPM7B23V', '2024-12-02 04:29:22', 'admin', 'wesleyjoshuaperez.iskolar@gmail.com');

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
  `current_status` varchar(20) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `pickup_date` date DEFAULT NULL,
  `remarks` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `residency_cert`
--

INSERT INTO `residency_cert` (`first_name`, `middle_name`, `last_name`, `yrs_occupancy`, `id_pic`, `address`, `apply_myself`, `residency_id`, `current_status`, `username`, `pickup_date`, `remarks`) VALUES
('WILFREDO M.', 'HEREMIS', 'PEREZ JR', 12, 'id example.jpg', 'BILOLO SITE, ORION BATAAN', '', 1, 'rejected', 'Wesley', NULL, '');

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
  `current_status` varchar(20) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `pickup_date` date DEFAULT NULL,
  `remarks` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_feedback`
--

CREATE TABLE `user_feedback` (
  `feedback_id` int(11) NOT NULL,
  `emoji` varchar(10) NOT NULL,
  `comment` text DEFAULT NULL,
  `feedback_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_feedback`
--

INSERT INTO `user_feedback` (`feedback_id`, `emoji`, `comment`, `feedback_date`) VALUES
(1, '😃', '', '2024-12-01 05:57:19'),
(2, '😃', '', '2024-12-01 06:57:35'),
(3, '😃', '', '2024-12-01 07:25:22'),
(4, '😃', '', '2024-12-02 02:24:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_ebrgy`
--
ALTER TABLE `admin_ebrgy`
  ADD PRIMARY KEY (`admin_id`);

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
-- Indexes for table `user_feedback`
--
ALTER TABLE `user_feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_ebrgy`
--
ALTER TABLE `admin_ebrgy`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blgclearance_cert`
--
ALTER TABLE `blgclearance_cert`
  MODIFY `blgclearance_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brgyclearance_cert`
--
ALTER TABLE `brgyclearance_cert`
  MODIFY `brgyclearance_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brgy_announcement`
--
ALTER TABLE `brgy_announcement`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `brgy_event`
--
ALTER TABLE `brgy_event`
  MODIFY `brgyevent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `daycare_shortlisting`
--
ALTER TABLE `daycare_shortlisting`
  MODIFY `daycareshortlisting_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `electricity_clearance`
--
ALTER TABLE `electricity_clearance`
  MODIFY `electricityclearance_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fencingclearance_cert`
--
ALTER TABLE `fencingclearance_cert`
  MODIFY `fencingclearance_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `indigency_cert`
--
ALTER TABLE `indigency_cert`
  MODIFY `indigency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobabsence_cert`
--
ALTER TABLE `jobabsence_cert`
  MODIFY `jobabsence_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobseek_cert`
--
ALTER TABLE `jobseek_cert`
  MODIFY `jobseek_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_payment`
--
ALTER TABLE `order_payment`
  MODIFY `orderpayment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registereduser_ebrg`
--
ALTER TABLE `registereduser_ebrg`
  MODIFY `reguser_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `resetpass_request`
--
ALTER TABLE `resetpass_request`
  MODIFY `reset_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `residency_cert`
--
ALTER TABLE `residency_cert`
  MODIFY `residency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `soloparent_cert`
--
ALTER TABLE `soloparent_cert`
  MODIFY `soloparent_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_feedback`
--
ALTER TABLE `user_feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
