-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 03, 2021 at 04:23 PM
-- Server version: 10.3.28-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `abcacademy_abcdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `ins_id` int(11) NOT NULL,
  `ins_nid` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `ins_verified` tinyint(4) NOT NULL DEFAULT 0,
  `ins_verify_req` tinyint(4) DEFAULT 0,
  `ins_name` text CHARACTER SET utf8 DEFAULT NULL,
  `ins_pass` text DEFAULT NULL,
  `ins_type` int(11) DEFAULT NULL,
  `ins_phone` text DEFAULT NULL,
  `ins_email` varchar(50) DEFAULT NULL,
  `ins_sex` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `ins_dob` varchar(100) NOT NULL,
  `ins_education` text CHARACTER SET utf8 DEFAULT NULL,
  `ins_joining_date` date DEFAULT NULL,
  `ins_facebook` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ins_desiganation` text DEFAULT NULL,
  `ins_online_offline` tinyint(4) DEFAULT NULL,
  `ins_address` text CHARACTER SET utf8 DEFAULT NULL,
  `ins_notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ins_discription` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ins_photo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`ins_id`, `ins_nid`, `ins_verified`, `ins_verify_req`, `ins_name`, `ins_pass`, `ins_type`, `ins_phone`, `ins_email`, `ins_sex`, `ins_dob`, `ins_education`, `ins_joining_date`, `ins_facebook`, `ins_desiganation`, `ins_online_offline`, `ins_address`, `ins_notes`, `ins_discription`, `ins_photo`) VALUES
(34, '', 1, 0, 'Aslam Mamud', '1234', 0, '01521310261', 'aslam@yahoo.com', 'পুরুষ', '12797', 'Bsc in CSE', '2021-04-28', '', NULL, NULL, 'মোহাম্মেদপুর', NULL, NULL, NULL),
(36, '2147483647', 0, 0, 'Sayed Amin', '123456', NULL, '01721815968', 'saidamin07@gmail.com', 'পুরুষ', '4566', 'HSC', '2021-05-01', 'Alex Jones', NULL, NULL, 'nuton bazar, khulna ', NULL, NULL, NULL),
(38, '125658552555', 0, 1, 'ovi sheikh', 'canada@24@', NULL, '01911686324', 'ovi0088@gmail.com', 'পুরুষ', '25-12-1993', 'MBA', '2021-05-02', 'https://www.facebook.com/ovisheikh007/', NULL, NULL, 'Dhanmondi', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`ins_id`),
  ADD UNIQUE KEY `UQ_instructor_email` (`ins_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `instructor`
--
ALTER TABLE `instructor`
  MODIFY `ins_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
