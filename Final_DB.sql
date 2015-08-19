-- phpMyAdmin SQL Dump
-- version 4.4.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 13, 2015 at 01:47 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `file_id` int(100) NOT NULL,
  `file_name` varchar(100) DEFAULT NULL,
  `subq_id` int(100) NOT NULL,
  `file_num` int(100) DEFAULT NULL,
  `file` longblob NOT NULL,
  `course_id` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL,
  `size` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE IF NOT EXISTS `instructor` (
  `i_id` int(100) NOT NULL,
  `i_name` varchar(100) NOT NULL,
  `ph_no` bigint(255) NOT NULL,
  `i_email` varchar(100) NOT NULL,
  `advisor_bool` tinyint(1) NOT NULL,
  `admin_bool` tinyint(1) NOT NULL,
  `department` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id` int(100) NOT NULL,
  `password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `s_id` int(100) NOT NULL,
  `s_name` varchar(100) NOT NULL,
  `s_surname` varchar(100) NOT NULL,
  `s_email` varchar(100) NOT NULL,
  `i_name` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `s_que` varchar(100) NOT NULL,
  `s_ans` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `submissionqueue`
--

CREATE TABLE IF NOT EXISTS `submissionqueue` (
  `subq_id` int(100) NOT NULL,
  `s_id` int(100) NOT NULL,
  `time_stamp` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `comments` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `submissiontype`
--

CREATE TABLE IF NOT EXISTS `submissiontype` (
  `sub_id` int(100) NOT NULL,
  `course_id` varchar(100) NOT NULL,
  `submission_type` varchar(100) NOT NULL,
  `refreshOnUpdate` tinyint(1) NOT NULL
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
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`file_id`),
  ADD KEY `subq_id` (`subq_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `course_id_2` (`course_id`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`i_id`),
  ADD UNIQUE KEY `i_email` (`i_email`),
  ADD KEY `i_id` (`i_id`),
  ADD KEY `i_name` (`i_name`),
  ADD KEY `i_name_2` (`i_name`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `instructor.id` (`i_name`),
  ADD KEY `instructor.id_2` (`i_name`),
  ADD KEY `instructor.id_3` (`i_name`),
  ADD KEY `instructor.id_4` (`i_name`),
  ADD KEY `instructor.id_5` (`i_name`),
  ADD KEY `i_id` (`i_name`),
  ADD KEY `i_name` (`i_name`),
  ADD KEY `i_name_2` (`i_name`),
  ADD KEY `department` (`department`),
  ADD KEY `i_name_3` (`i_name`);

--
-- Indexes for table `submissionqueue`
--
ALTER TABLE `submissionqueue`
  ADD PRIMARY KEY (`subq_id`),
  ADD KEY `s_id` (`s_id`);

--
-- Indexes for table `submissiontype`
--
ALTER TABLE `submissiontype`
  ADD PRIMARY KEY (`sub_id`),
  ADD KEY `course_id` (`course_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `file_id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `submissionqueue`
--
ALTER TABLE `submissionqueue`
  MODIFY `subq_id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `submissiontype`
--
ALTER TABLE `submissiontype`
  MODIFY `sub_id` int(100) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`i_id`) REFERENCES `instructor` (`i_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`i_name`) REFERENCES `instructor` (`i_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `submissionqueue`
--
ALTER TABLE `submissionqueue`
  ADD CONSTRAINT `submissionqueue_ibfk_1` FOREIGN KEY (`s_id`) REFERENCES `student` (`s_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `submissiontype`
--
ALTER TABLE `submissiontype`
  ADD CONSTRAINT `submissiontype_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
