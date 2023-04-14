-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2023 at 08:22 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course`
--

CREATE TABLE `tbl_course` (
  `crs_id` int(10) NOT NULL,
  `yr_id` int(10) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `crs_code` varchar(50) NOT NULL,
  `crs_desc` varchar(50) NOT NULL,
  `crs_unit` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_course`
--

INSERT INTO `tbl_course` (`crs_id`, `yr_id`, `dept_id`, `crs_code`, `crs_desc`, `crs_unit`) VALUES
(1, 3, 1, 'WS301', 'Web Development 1', 5),
(2, 2, 1, 'PF205', 'Object-Oriented Programming 2', 5),
(3, 1, 1, 'CC103', 'Computer Programming 2', 5),
(6, 1, 1, 'CC101', 'Introduction to Computings', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE `tbl_department` (
  `dept_id` int(10) NOT NULL,
  `dept_code` varchar(50) NOT NULL,
  `dept_desc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`dept_id`, `dept_code`, `dept_desc`) VALUES
(1, 'BSIT', 'Bachelor of Science in Information Technology'),
(2, 'BSBA', 'Bachelor of Science in Business Administration');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_enroll`
--

CREATE TABLE `tbl_enroll` (
  `en_id` int(10) NOT NULL,
  `sy_id` int(10) NOT NULL,
  `sem_id` int(10) NOT NULL,
  `s_id` int(10) NOT NULL,
  `yr_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_enroll`
--

INSERT INTO `tbl_enroll` (`en_id`, `sy_id`, `sem_id`, `s_id`, `yr_id`) VALUES
(5, 1, 1, 11, 1),
(12, 1, 1, 2, 1),
(16, 1, 1, 9, 1),
(17, 1, 1, 18, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sem`
--

CREATE TABLE `tbl_sem` (
  `sem_id` int(10) NOT NULL,
  `sem_desc` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_sem`
--

INSERT INTO `tbl_sem` (`sem_id`, `sem_desc`) VALUES
(1, '1st Semester'),
(2, '2nd Semester');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_students`
--

CREATE TABLE `tbl_students` (
  `s_id` int(20) NOT NULL,
  `dept_id` int(10) NOT NULL,
  `s_name` varchar(50) NOT NULL,
  `s_gender` varchar(50) NOT NULL,
  `s_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_students`
--

INSERT INTO `tbl_students` (`s_id`, `dept_id`, `s_name`, `s_gender`, `s_status`) VALUES
(2, 1, 'John Doe Adlawans', 'Male', 'Not-Enrolled'),
(4, 1, 'Sample Full Name', 'Female', 'Not-Enrolled'),
(9, 1, 'Richard James', 'Male', 'Enrolled'),
(10, 1, 'Sopoline Freeman', 'Female', 'Not-Enrolled'),
(11, 1, 'Palmer Estes', 'Male', 'Enrolled'),
(14, 2, 'Caldwell Quinn', 'Velit aspernatur pla', 'Qui blanditiis debit'),
(15, 2, 'Herrod Mills', 'Voluptates ullamco e', 'Sint qui ea illum r'),
(16, 2, 'Sampel Data', 'Male', 'Enrolled'),
(17, 2, 'Kareem Joseph', 'A voluptatem Facere', 'Est quam non repudia'),
(18, 2, 'Raphael Curtis', 'Cumque cum minim vol', 'Architecto nisi in a'),
(19, 2, 'Nora Conrad', 'Dolor totam Nam ex v', 'Eaque sit fuga Vel '),
(20, 1, 'Zoe Jones', 'Distinctio Optio e', 'Beatae nihil recusan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subjects`
--

CREATE TABLE `tbl_subjects` (
  `sbj_id` int(10) NOT NULL,
  `en_id` int(10) NOT NULL,
  `crs_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_subjects`
--

INSERT INTO `tbl_subjects` (`sbj_id`, `en_id`, `crs_id`) VALUES
(20, 16, 3),
(21, 16, 6),
(22, 5, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sy`
--

CREATE TABLE `tbl_sy` (
  `sy_id` int(10) NOT NULL,
  `sy_desc` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_sy`
--

INSERT INTO `tbl_sy` (`sy_id`, `sy_desc`) VALUES
(1, '2022-2023');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_year`
--

CREATE TABLE `tbl_year` (
  `yr_id` int(10) NOT NULL,
  `yr_desc` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_year`
--

INSERT INTO `tbl_year` (`yr_id`, `yr_desc`) VALUES
(1, '1st Year'),
(2, '2nd Year'),
(3, '3rd Year'),
(4, '4th Year');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_course`
--
ALTER TABLE `tbl_course`
  ADD PRIMARY KEY (`crs_id`),
  ADD KEY `c_yr` (`yr_id`),
  ADD KEY `c_dpt` (`dept_id`);

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `tbl_enroll`
--
ALTER TABLE `tbl_enroll`
  ADD PRIMARY KEY (`en_id`),
  ADD KEY `s_sy` (`sy_id`),
  ADD KEY `s_sem` (`sem_id`),
  ADD KEY `s_std` (`s_id`),
  ADD KEY `s_year` (`yr_id`);

--
-- Indexes for table `tbl_sem`
--
ALTER TABLE `tbl_sem`
  ADD PRIMARY KEY (`sem_id`);

--
-- Indexes for table `tbl_students`
--
ALTER TABLE `tbl_students`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `s_dept` (`dept_id`);

--
-- Indexes for table `tbl_subjects`
--
ALTER TABLE `tbl_subjects`
  ADD PRIMARY KEY (`sbj_id`),
  ADD KEY `sub_enrollid` (`en_id`),
  ADD KEY `sub_crsid` (`crs_id`);

--
-- Indexes for table `tbl_sy`
--
ALTER TABLE `tbl_sy`
  ADD PRIMARY KEY (`sy_id`);

--
-- Indexes for table `tbl_year`
--
ALTER TABLE `tbl_year`
  ADD PRIMARY KEY (`yr_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_course`
--
ALTER TABLE `tbl_course`
  MODIFY `crs_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `dept_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_enroll`
--
ALTER TABLE `tbl_enroll`
  MODIFY `en_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_sem`
--
ALTER TABLE `tbl_sem`
  MODIFY `sem_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_students`
--
ALTER TABLE `tbl_students`
  MODIFY `s_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_subjects`
--
ALTER TABLE `tbl_subjects`
  MODIFY `sbj_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_sy`
--
ALTER TABLE `tbl_sy`
  MODIFY `sy_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_year`
--
ALTER TABLE `tbl_year`
  MODIFY `yr_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_course`
--
ALTER TABLE `tbl_course`
  ADD CONSTRAINT `c_dpt` FOREIGN KEY (`dept_id`) REFERENCES `tbl_department` (`dept_id`),
  ADD CONSTRAINT `c_yr` FOREIGN KEY (`yr_id`) REFERENCES `tbl_year` (`yr_id`);

--
-- Constraints for table `tbl_enroll`
--
ALTER TABLE `tbl_enroll`
  ADD CONSTRAINT `s_sem` FOREIGN KEY (`sem_id`) REFERENCES `tbl_sem` (`sem_id`),
  ADD CONSTRAINT `s_std` FOREIGN KEY (`s_id`) REFERENCES `tbl_students` (`s_id`),
  ADD CONSTRAINT `s_sy` FOREIGN KEY (`sy_id`) REFERENCES `tbl_sy` (`sy_id`),
  ADD CONSTRAINT `s_year` FOREIGN KEY (`yr_id`) REFERENCES `tbl_year` (`yr_id`);

--
-- Constraints for table `tbl_students`
--
ALTER TABLE `tbl_students`
  ADD CONSTRAINT `s_dept` FOREIGN KEY (`dept_id`) REFERENCES `tbl_department` (`dept_id`);

--
-- Constraints for table `tbl_subjects`
--
ALTER TABLE `tbl_subjects`
  ADD CONSTRAINT `sub_crsid` FOREIGN KEY (`crs_id`) REFERENCES `tbl_course` (`crs_id`),
  ADD CONSTRAINT `sub_enrollid` FOREIGN KEY (`en_id`) REFERENCES `tbl_enroll` (`en_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
