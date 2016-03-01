-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2016 at 03:53 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gsa`
--

-- --------------------------------------------------------

--
-- Table structure for table `scouts`
--

CREATE TABLE `scouts` (
  `SID` int(11) NOT NULL DEFAULT '0',
  `Name` text,
  `DoB` date DEFAULT NULL,
  `address` text,
  `PhoneNumber` text,
  `BackupPhone` text,
  `email` text,
  `Parents` text,
  `Grade` int(11) DEFAULT NULL,
  `Ranks` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scouts`
--

INSERT INTO `scouts` (`SID`, `Name`, `DoB`, `address`, `PhoneNumber`, `BackupPhone`, `email`, `Parents`, `Grade`, `Ranks`) VALUES
(0, 'Lisa', '2016-02-01', 'a', '1', '1', 'a', 'a', 1, 'daisy'),
(1, 'Stephanie', '2016-02-01', 'a', '1', '1', 'a', 'a', 1, 'daisy'),
(2, 'Allison', '2016-02-01', 'a', '1', '1', 'a', 'a', 1, 'daisy'),
(3, 'Taylor', '2016-02-01', 'a', '1', '1', 'a', 'a', 1, 'daisy'),
(4, 'Caroline', '2016-02-01', 'a', '1', '1', 'a', 'a', 1, 'daisy'),
(5, 'Carol', '2016-02-01', 'a', '1', '1', 'a', 'a', 1, 'brownie'),
(6, 'Danielle', '2016-02-01', 'a', '1', '1', 'a', 'a', 1, 'brownie'),
(7, 'Morgan', '2016-02-01', 'a', '1', '1', 'a', 'a', 1, 'brownie'),
(8, 'Kaitlyn', '2016-02-01', 'a', '1', '1', 'a', 'a', 1, 'brownie'),
(9, 'Anne', '2016-02-01', 'a', '1', '1', 'a', 'a', 1, 'brownie'),
(10, 'Melissa', '2016-02-01', 'a', '1', '1', 'a', 'a', 1, 'junior'),
(11, 'Katrina', '2016-02-01', 'a', '1', '1', 'a', 'a', 1, 'junior'),
(12, 'Megan', '2016-02-01', 'a', '1', '1', 'a', 'a', 1, 'senior'),
(13, 'Natalie', '2016-02-01', 'a', '1', '1', 'a', 'a', 1, 'senior'),
(14, 'Melanie', '2016-02-01', 'a', '1', '1', 'a', 'a', 1, 'cadette'),
(15, 'Nicole', '2016-02-01', 'a', '1', '1', 'a', 'a', 1, 'cadette'),
(16, 'Lauren', '2016-02-01', 'a', '1', '1', 'a', 'a', 1, 'ambassador'),
(17, 'Rachael', '2016-02-01', 'a', '1', '1', 'a', 'a', 1, 'ambassador');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `scouts`
--
ALTER TABLE `scouts`
  ADD PRIMARY KEY (`SID`),
  ADD UNIQUE KEY `SID` (`SID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
