-- phpMyAdmin SQL Dump
-- version 4.4.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 08, 2015 at 04:51 PM
-- Server version: 5.6.21
-- PHP Version: 5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kajalDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `course_id` varchar(100) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `i_id` int(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `prerequisite` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD UNIQUE KEY `course_name` (`course_name`),
  ADD UNIQUE KEY `course_id` (`course_id`),
  ADD KEY `id` (`i_id`),
  ADD KEY `i_id` (`i_id`),
  ADD KEY `i_id_2` (`i_id`),
  ADD KEY `i_id_3` (`i_id`),
  ADD KEY `i_id_4` (`i_id`),
  ADD KEY `department` (`department`),
  ADD KEY `course_id_2` (`course_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`i_id`) REFERENCES `instructor` (`i_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
