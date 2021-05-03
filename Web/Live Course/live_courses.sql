-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 03, 2021 at 04:25 PM
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
-- Table structure for table `live_courses`
--

CREATE TABLE `live_courses` (
  `live_cid` int(11) NOT NULL,
  `live_c_title` varchar(256) CHARACTER SET utf8 NOT NULL,
  `live_c_meta_keys` text CHARACTER SET utf8 NOT NULL,
  `live_c_meta_desc` text CHARACTER SET utf8 NOT NULL,
  `live_c_code` varchar(30) NOT NULL,
  `live_c_image` varchar(256) NOT NULL,
  `live_c_sch_no` int(11) NOT NULL,
  `live_c_sch_no_left` int(11) NOT NULL,
  `live_c_sch_status` tinyint(4) NOT NULL,
  `live_c_orginal_fee` int(11) NOT NULL,
  `live_c_offer_fee` int(11) NOT NULL,
  `live_c_discount_type` tinyint(4) NOT NULL COMMENT '0==% | 1==fixed',
  `live_c_discount` int(11) NOT NULL,
  `live_c_cls_total` int(11) NOT NULL,
  `live_c_cls_time` varchar(100) CHARACTER SET utf8 NOT NULL,
  `live_c_cls_duration` varchar(100) CHARACTER SET utf8 NOT NULL,
  `live_c_venue` varchar(100) CHARACTER SET utf8 NOT NULL,
  `live_c_short_desc` text CHARACTER SET utf8 NOT NULL,
  `live_c_module` text CHARACTER SET utf8 NOT NULL,
  `live_c_certificate_avl` tinyint(4) NOT NULL COMMENT '1==available 0==not',
  `live_c_seats` int(11) NOT NULL,
  `live_c_completed` int(11) NOT NULL,
  `live_c_visibility` tinyint(4) NOT NULL COMMENT '1 == visible | 0 == not'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `live_courses`
--

INSERT INTO `live_courses` (`live_cid`, `live_c_title`, `live_c_meta_keys`, `live_c_meta_desc`, `live_c_code`, `live_c_image`, `live_c_sch_no`, `live_c_sch_no_left`, `live_c_sch_status`, `live_c_orginal_fee`, `live_c_offer_fee`, `live_c_discount_type`, `live_c_discount`, `live_c_cls_total`, `live_c_cls_time`, `live_c_cls_duration`, `live_c_venue`, `live_c_short_desc`, `live_c_module`, `live_c_certificate_avl`, `live_c_seats`, `live_c_completed`, `live_c_visibility`) VALUES
(4, 'ওয়েব ডেভেলপমেন্ট এবং এবং ফ্রিল্যান্সিং কোর্স', 'Web, Web Development, Freelancing, Freelance on web', 'N/A', 'WEB-F-101', 'graphic design.jpg', 10, 0, 1, 12000, 10000, 0, 30, 24, '22:00 TO 00:00', '2', 'Pixel IT Institute', 'একটি ইন্টারেক্টিভ, মসৃণ এবং সহজে অ্যাক্সেস করা ওয়েবসাইট দর্শকদের একটি জটিল কোড স্টাফড অ ক্রিয়েটিভ ওয়েবসাইটের চেয়ে বেশি সময় ধরে ধরে রাখতে পারে। প্রতিটি ওয়েবসাইটের জন্য গ্রাহক ট্র্যাফিকের ভাল সংখ্যাই মূল বিষয় এবং প্রতি মিনিটের দর্শনার্থীরা ওয়েবসাইট গণনা করে থাকে, এর অর্থ এই যে ওয়েবসাইটের জন্য ভাল র‌্যাঙ্কের কারণ হিসাবে বেশি দর্শকরা বেশি থাকবেন। মূলত কোনও ওয়েব বিকাশকারীকে ওয়েব ডিজাইনারের বিপুল চাহিদার পেছনের মূল কারণটি হ\'ল প্রথমটি একজন নন প্রযুক্তিবিদ ব্যক্তি হতে পারে এই বিষয়টি উপেক্ষা করে সামনের দিকের নকশা চোখের আকর্ষণীয় এবং সহজেই অ্যাক্সেসযোগ্য রাখা।', '<p style=\"margin-bottom: 1rem; color: rgb(33, 37, 41); font-family: Poppins, sans-serif; background-color: rgb(248, 249, 250);\"><span style=\"font-weight: bolder;\">Course outline :&nbsp;</span><span style=\"font-weight: bolder;\">Class 01:</span></p><ul style=\"margin-right: 0px; margin-bottom: 1rem; margin-left: 1.25em; list-style: none; padding: 0px; color: rgb(33, 37, 41); font-family: Poppins, sans-serif; font-size: 16px; background-color: rgb(248, 249, 250);\"><li style=\"list-style: none;\">Introduction to web design</li><li style=\"list-style: none;\">Introduction to web design</li></ul><span style=\"font-weight: bolder; color: rgb(33, 37, 41); font-family: Poppins, sans-serif; font-size: 16px; background-color: rgb(248, 249, 250);\">Class 02:</span><span style=\"color: rgb(33, 37, 41); font-family: Poppins, sans-serif; font-size: 16px; background-color: rgb(248, 249, 250);\"></span><ul style=\"margin-right: 0px; margin-bottom: 1rem; margin-left: 1.25em; list-style: none; padding: 0px; color: rgb(33, 37, 41); font-family: Poppins, sans-serif; font-size: 16px; background-color: rgb(248, 249, 250);\"><li style=\"list-style: none;\">Introduction to web design</li><li style=\"list-style: none;\"><br></li></ul> ', 0, 11, 256, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `live_courses`
--
ALTER TABLE `live_courses`
  ADD PRIMARY KEY (`live_cid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `live_courses`
--
ALTER TABLE `live_courses`
  MODIFY `live_cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
