-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 13, 2020 at 03:38 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `student_gen`
--

DELIMITER $$
--
-- Procedures
--

GRANT SUPER
ON 'xandquxw_jtsids'.'s_data'
TO 'xandquxw_jtsids'@'localhost'; 

CREATE DEFINER=`xandquxw_jtsids`@`localhost` PROCEDURE `InsertStudent` (IN `studentId` VARCHAR(16), IN `first_name` VARCHAR(32), IN `last_name` VARCHAR(64), IN `prog` VARCHAR(64), IN `email_` VARCHAR(64), IN `acadYear` VARCHAR(4), IN `createdBy` VARCHAR(16))  NO SQL
INSERT INTO `s_data`(`student_id`, `firstname`, `lastname`, `programme`, `email`, `acad_year`, `created_by`, `date_created`) VALUES (studentId, first_name, last_name, prog, email_, acadYear, createdBy, LOCALTIMESTAMP())$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `1` int(8) NOT NULL,
  `user_name` varchar(12) NOT NULL,
  `email` varchar(64) NOT NULL,
  `firstname` varchar(16) NOT NULL,
  `lastname` varchar(16) NOT NULL,
  `password` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`1`, `user_name`, `email`, `firstname`, `lastname`, `password`) VALUES
(1, 'jstone', 'jheniel.stone@jts.edu.jm', 'Jheniel', 'Stone', '63082bf379cd3c8982c75686317db06d'),
(2, 'aschleifer', 'annastasia.schleifer@jts.edu.jm', 'Annastasia', 'Schleifer', '63082bf379cd3c8982c75686317db06d'),
(3, 'studreg', 'admissions@jts.edu.jm', 'Student', 'Registration', '63082bf379cd3c8982c75686317db06d');

-- --------------------------------------------------------

--
-- Stand-in structure for view `getid`
-- (See below for the actual view)
--
CREATE TABLE `getid` (
`nextAvailableiD` varchar(4)
);

-- --------------------------------------------------------

--
-- Table structure for table `idNum`
--

CREATE TABLE `idNum` (
  `nextAvailableiD` int(11) NOT NULL,
  `time_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `idNum`
--

INSERT INTO `idNum` (`nextAvailableiD`, `time_modified`) VALUES
(54, '2020-08-13 10:13:26');

-- --------------------------------------------------------

--
-- Table structure for table `s_data`
--

CREATE TABLE `s_data` (
  `id` int(8) NOT NULL,
  `student_id` varchar(16) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  `programme` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `acad_year` varchar(4) NOT NULL,
  `created_by` varchar(16) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `s_data`
--

INSERT INTO `s_data` (`id`, `student_id`, `firstname`, `lastname`, `programme`, `email`, `acad_year`, `created_by`, `date_created`) VALUES
(1, '7020200035', 'Shantelle', 'Kelly-Burke', 'Bachelor of Social Work', 'shantelle.kelly-burke@jts.edu.jm', '2020', 'jstone', '2020-08-10 10:00:13'),
(2, '1020200036', 'Sash', 'McD', 'Bachelor of Social Work', 'sash.mcd@jts.edu.jm', '2020', 'jstone', '2020-08-10 10:14:21'),
(3, '8020210037', 'lknsdnkdjsn', 'jknkjnsknjw', 'Master of Arts in Forensic Psychology', 'lknsdnkdjsn.jknkjnsknjw@jts.edu.jm', '2021', 'jstone', '2020-08-10 10:14:39'),
(4, '8020200038', 'YorkAli', 'Walters', 'Bachelor of Arts in Guidance Counsel', 'yorkali.walters@jts.edu.jm', '2020', 'jstone', '2020-08-11 20:21:46'),
(5, '6020200039', 'Yorkwin', 'Walters', 'Master of Arts in Forensic Psychology', 'yorkwin.walters@jts.edu.jm', '2020', 'jstone', '2020-08-11 20:22:12'),
(6, '1520200040', 'Karlene', 'Black', 'Bachelor of Art in Theology', 'karlene.black@jts.edu.jm', '2020', 'jstone', '2020-08-12 13:51:55'),
(7, '4020200041', 'David', 'Williams', 'Master of Arts in Forensic Psychology', 'david.williams@jts.edu.jm', '2020', 'jstone', '2020-08-12 13:53:48'),
(8, '1020200042', 'Keefa', 'Green', 'Bachelor of Arts Social Profesional Transformation', 'keefa.green@jts.edu.jm', '2020', 'jstone', '2020-08-12 14:09:24'),
(9, '1020200043', 'Davion', 'Boreland', 'Bachelor of Arts in Guidance Counsel', 'davion.boreland@jts.edu.jm', '2020', 'jstone', '2020-08-12 14:32:10'),
(10, '7020200044', 'ANNASTASIA', 'SCHLEIFER', 'Bachelor of Social Work', 'annastasia.schleifer@jts.edu.jm', '2020', 'aschleifer', '2020-08-12 15:07:00'),
(11, '1020200045', 'mysti', 'Donald', 'Bachelor of Arts in Guidance Counsel', 'mysti.donald@jts.edu.jm', '2020', 'aschleifer', '2020-08-12 15:22:38'),
(12, '4020200046', 'Andrae', 'Wilson', 'Bachelor of Arts Social Profesional Transformation', 'andrae.wilson@jts.edu.jm', '2020', 'aschleifer', '2020-08-12 18:55:33'),
(13, '2020220047', 'Lisa', 'Wilson', 'Master of Arts in Bible', 'lisa.wilson@jts.edu.jm', '2022', 'aschleifer', '2020-08-12 19:25:43'),
(14, '1020210048', 'Francine', 'McCalla-Burke', 'Bachelor of Arts in Guidance Counsel', 'francine.mccalla-burke@jts.edu.jm', '2021', 'aschleifer', '2020-08-12 19:26:08'),
(15, '5020200049', 'Antonette', 'Lynch', 'Associate Degree in Leadership and Ministry', 'antonette.lynch@jts.edu.jm', '2020', 'aschleifer', '2020-08-12 19:26:44'),
(16, '8020200050', 'Select * From s_data;', 'admin', 'Bachelor of Arts Social Profesional Transformation', 'select * from s_data;.admin@jts.edu.jm', '2020', 'aschleifer', '2020-08-12 19:28:00'),
(17, '10620210051', 'Alexander', 'Wilson', 'Evangelical Training Association Certificate', 'alexander.wilson@jts.edu.jm', '2021', 'aschleifer', '2020-08-12 19:34:11'),
(18, '5520210052', 'Corianne', 'Davis', 'Bachelor of Art in Theology', 'corianne.davis@jts.edu.jm', '2021', 'aschleifer', '2020-08-12 19:34:30'),
(19, '1020200053', 'Jheniel', 'Stone', 'Bachelor of Social Work', 'jheniel.stone@jts.edu.jm', '2020', 'jstone', '2020-08-13 10:13:26');

-- --------------------------------------------------------

--
-- Structure for view `getid`
--
DROP TABLE IF EXISTS `getid`;

CREATE ALGORITHM=UNDEFINED DEFINER=`xandquxw_jtsids`@`localhost` SQL SECURITY DEFINER VIEW `getid`  AS  select lpad(`idnum`.`nextAvailableiD`,4,0) AS `nextAvailableiD` from `idnum` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`1`);

--
-- Indexes for table `s_data`
--
ALTER TABLE `s_data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `1` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `s_data`
--
ALTER TABLE `s_data`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
