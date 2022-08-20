-- phpMyAdmin SQL Dump
-- version 4.7.8
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2018 at 04:53 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `diagnostic_management_test`
--
CREATE DATABASE IF NOT EXISTS `diagnostic_management_test` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `diagnostic_management_test`;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(13) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(2, 'Hijbullah Amin', 'hijbullaah@gmail.com', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `patient_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `patient_doc` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `patient_sex` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `patient_contact` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `schedule` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `doctor_fee` decimal(10,2) NOT NULL,
  `test_fee` decimal(10,2) NOT NULL,
  `others_fee` decimal(10,2) DEFAULT '0.00',
  `discount_amt` decimal(10,2) DEFAULT '0.00',
  `total_amt` decimal(10,2) NOT NULL,
  `disease_desc` mediumtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `patient_name`, `birthday`, `patient_doc`, `patient_sex`, `patient_contact`, `schedule`, `doctor_fee`, `test_fee`, `others_fee`, `discount_amt`, `total_amt`, `disease_desc`) VALUES
(5, 'Hijbullah Amin', '2018-03-13', 'Dr. Nujhat', 'Male', '00000000000', '06 PM - 08 PM', '1000.00', '1000.00', '1000.00', '300.00', '2700.00', 'fdgdgdfgdg'),
(6, 'Hijbu', '2018-03-20', 'Dr. Nujhat', 'Male', '011532545642', '06 PM - 08 PM', '1000.00', '1000.00', '0.00', '0.00', '2000.00', 'khgkhgkg'),
(7, 'Sabreena Radi', '2018-03-20', 'Dr. Hijbullah Amin', 'Female', '01858078583', '06 PM - 08 PM', '1000.00', '1000.00', '0.00', '400.00', '1600.00', 'bcbcb');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

DROP TABLE IF EXISTS `doctors`;
CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `designation` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `contact` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `designation`, `contact`, `image`) VALUES
(2, 'Dr. Hijbullah Amin', 'Assistant Professor', '01858078583', '1521471993Screenshot_1.png'),
(4, 'Dr. Nujhat', 'Lecturer', '018580000000', ''),
(5, 'Dr. Fahima', 'Assistant Professor', '0000000000000', ''),
(7, 'Dr. Hijbullah Amin', 'Professor', '0180000000', ''),
(8, 'Dr. Hijbullah Amin', 'Assistant Professor', '0180000000', '1521470934Screenshot_1.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
