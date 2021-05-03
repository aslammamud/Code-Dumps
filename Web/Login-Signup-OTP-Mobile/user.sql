-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 03, 2021 at 04:22 PM
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
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` text NOT NULL,
  `user_image` varchar(200) NOT NULL,
  `user_pass` text NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_email_token` text NOT NULL,
  `user_email_ver` int(11) NOT NULL,
  `user_pass_recovered` text NOT NULL,
  `user_join_date` text NOT NULL,
  `user_about` text NOT NULL,
  `user_tagline` text NOT NULL,
  `user_skill` text NOT NULL,
  `user_location` text NOT NULL,
  `user_city` text NOT NULL,
  `user_region` int(11) NOT NULL,
  `user_phone` varchar(50) NOT NULL,
  `user_phone_ver` varchar(30) NOT NULL,
  `user_type` text NOT NULL,
  `user_verified` int(11) NOT NULL,
  `user_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_image`, `user_pass`, `user_email`, `user_email_token`, `user_email_ver`, `user_pass_recovered`, `user_join_date`, `user_about`, `user_tagline`, `user_skill`, `user_location`, `user_city`, `user_region`, `user_phone`, `user_phone_ver`, `user_type`, `user_verified`, `user_level`) VALUES
(1, 'Aslam Mamud', 'images/aslam.jpg', '123456', '', '', 1, '', '', '', '', '', '', '', 1, '01521310261', '', 'student', 1, 1),
(2, 'ovi sheikh', '', 'canada@24@', 'user2@customer.com', '', 0, '', '', '', '', '', '', 'Dhaka', 0, '01911686324', '1', 'student', 0, 1),
(3, 'Rajib Islam', '', 'rajib123', 'user3@customer.com', '', 0, '', '', '', '', '', '', 'Dhaka', 0, '01756310517', '1', 'student', 0, 1),
(7, 'shimanto khan', '', 'shimanto123', 'user4@student.com', '', 0, '', '', '', '', '', '', 'Dhaka', 0, '01979313012', '1', 'student', 0, 1),
(8, 'Admin', '', 'admin123', 'user5@student.com', '', 0, '', '', '', '', '', '', 'Dhaka', 0, '01302509844', '1', 'admin', 0, 1),
(9, 'AR Shakil', '', 'shakil123', 'user6@student.com', '', 0, '', '', '', '', '', '', 'Dhaka', 0, '01707331688', '1', 'student', 0, 1),
(10, 'Ovi Sheikh', '', 'canada@24@', 'user7@student.com', '', 0, '', '', '', '', '', '', 'Dhaka', 0, '01681539324', '1', 'student', 0, 1),
(11, 'Sayed Amin', '', '71431646', 'user8@student.com', '', 0, '', '', '', '', '', '', 'Dhaka', 0, '01911059426', '1', 'student', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `UQ_user_user_phone` (`user_phone`),
  ADD UNIQUE KEY `UQ_user_user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
