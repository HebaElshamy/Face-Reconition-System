-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 04, 2023 at 11:12 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendancemsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `Id` int NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `emailAddress` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`Id`, `firstName`, `lastName`, `emailAddress`, `password`) VALUES
(1, 'Admin', '', 'admin@mail.com', '25f9e794323b453885f5181f1b624d0b');

-- --------------------------------------------------------

--
-- Table structure for table `tblattendance`
--

CREATE TABLE `tblattendance` (
  `Id` int NOT NULL,
  `IDno` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `classId` varchar(10) NOT NULL,
  `status` int NOT NULL,
  `dateTimeTaken` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblclass`
--

CREATE TABLE `tblclass` (
  `Id` int NOT NULL,
  `className` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblclassteacher`
--

CREATE TABLE `tblclassteacher` (
  `Id` int NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `emailAddress` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phoneNo` varchar(50) NOT NULL,
  `classId` varchar(10) NOT NULL,
  `dateCreated` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblclassteacher`
--

INSERT INTO `tblclassteacher` (`Id`, `firstName`, `emailAddress`, `password`, `phoneNo`, `classId`, `dateCreated`) VALUES
(1, 'Will', 'teacher2@mail.com', '25f9e794323b453885f5181f1b624d0b', '09089898999', '1', '2022-10-31'),
(4, 'Demola', 'teacher3@gmail.com', '32250170a0dca92d53ec9624f336ca24', '09672002882', '1', '2022-11-01'),
(5, 'Ryan', 'teacher4@mail.com', '32250170a0dca92d53ec9624f336ca24', '7014560000', '3', '2022-10-07');

-- --------------------------------------------------------

--
-- Table structure for table `tblstudents`
--

CREATE TABLE `tblstudents` (
  `Id` int NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `location` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `IDno` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `phone1` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `phone2` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `classId` int NOT NULL,
  `dateCreated` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblattendance`
--
ALTER TABLE `tblattendance`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblclass`
--
ALTER TABLE `tblclass`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblclassteacher`
--
ALTER TABLE `tblclassteacher`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblstudents`
--
ALTER TABLE `tblstudents`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblattendance`
--
ALTER TABLE `tblattendance`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblclass`
--
ALTER TABLE `tblclass`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblclassteacher`
--
ALTER TABLE `tblclassteacher`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblstudents`
--
ALTER TABLE `tblstudents`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
