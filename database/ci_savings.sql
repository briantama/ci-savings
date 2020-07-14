-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 15, 2020 at 12:11 AM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 5.6.40-26+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_savings`
--

-- --------------------------------------------------------

--
-- Table structure for table `M_Class`
--

CREATE TABLE `M_Class` (
  `ClassID` varchar(20) NOT NULL,
  `ClassName` varchar(100) NOT NULL,
  `Description` longtext NOT NULL,
  `IsActive` varchar(1) NOT NULL,
  `EntryBy` varchar(20) NOT NULL,
  `EntryDate` datetime NOT NULL,
  `LastUpdateBy` varchar(20) NOT NULL,
  `LastUpdateDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `M_Class`
--

INSERT INTO `M_Class` (`ClassID`, `ClassName`, `Description`, `IsActive`, `EntryBy`, `EntryDate`, `LastUpdateBy`, `LastUpdateDate`) VALUES
('okay', 'okay', '', 'N', 'brian', '2020-07-03 22:40:30', 'brian', '2020-07-12 06:11:08'),
('PC', 'Percobaan', 'Ok', 'Y', 'brian', '2020-07-03 22:39:34', 'brian', '2020-07-04 16:14:21'),
('tester', 'test', '', 'Y', 'brian', '2020-07-03 22:39:59', 'brian', '2020-07-03 22:39:59'),
('V-D', 'Lima d', 'D Lima', 'N', 'brian', '2020-06-23 22:53:44', 'brian', '2020-06-29 10:51:11'),
('VI-A', 'enam a', '', 'N', 'brian', '2020-06-23 00:00:00', 'brian', '2020-06-23 17:55:15'),
('VI-B', 'Enam B', '', 'N', 'brian', '2020-06-23 00:00:00', 'brian', '2020-06-23 17:56:27'),
('VI-C', 'enam c', 'Enam Lapan', 'N', 'brian', '2020-06-23 17:35:09', 'brian', '2020-06-23 23:02:36'),
('VII-A', 'tujuh a', 'Test', 'N', 'brian', '2020-06-23 17:19:33', 'brian', '2020-06-23 17:57:34'),
('X-A', 'sepuluh A', '', 'N', 'brian', '2020-06-22 00:00:00', 'brian', '2020-06-23 21:58:27'),
('X-B', 'sepuluh B', 'Sepuluh B', 'Y', 'brian', '2020-06-23 17:30:15', 'brian', '2020-06-23 17:30:15'),
('X-C', 'Sepuluh c', 'Sepuluh C', 'Y', 'brian', '2020-06-23 17:23:14', 'brian', '2020-06-23 17:23:14'),
('XIII-A', 'dua belas a', '', 'Y', 'brian', '2020-06-24 21:47:08', 'brian', '2020-06-24 21:47:08');

-- --------------------------------------------------------

--
-- Table structure for table `M_Months`
--

CREATE TABLE `M_Months` (
  `MonthID` int(11) NOT NULL,
  `MonthName` varchar(100) NOT NULL,
  `IsActive` varchar(1) NOT NULL,
  `EntryBy` varchar(20) NOT NULL,
  `EntryDate` datetime NOT NULL,
  `LastUpdateBy` varchar(20) NOT NULL,
  `LastUpdateDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `M_Months`
--

INSERT INTO `M_Months` (`MonthID`, `MonthName`, `IsActive`, `EntryBy`, `EntryDate`, `LastUpdateBy`, `LastUpdateDate`) VALUES
(1, 'Januari', 'Y', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(2, 'Febuari', 'Y', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(3, 'Maret', 'Y', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(4, 'April', 'Y', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(5, 'Mei', 'Y', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(6, 'Juni', 'Y', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(7, 'Juli', 'Y', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(8, 'Agustus', 'Y', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(9, 'September', 'Y', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(10, 'Oktober', 'Y', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(11, 'November', 'Y', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(12, 'Desember', 'Y', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `M_Setupprofile`
--

CREATE TABLE `M_Setupprofile` (
  `SetupprofileID` int(11) NOT NULL,
  `SetupTitle` varchar(200) NOT NULL,
  `SetupName` varchar(300) NOT NULL,
  `SetupDescription` longtext NOT NULL,
  `SetupImageDasbor` varchar(1) NOT NULL,
  `SetupImage` varchar(200) NOT NULL,
  `SetupImageLogo` varchar(300) NOT NULL,
  `IsActive` varchar(1) NOT NULL,
  `EntryBy` varchar(20) NOT NULL,
  `EntryDate` datetime NOT NULL,
  `LastUpdateBy` varchar(20) NOT NULL,
  `LastUpdateDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `M_Setupprofile`
--

INSERT INTO `M_Setupprofile` (`SetupprofileID`, `SetupTitle`, `SetupName`, `SetupDescription`, `SetupImageDasbor`, `SetupImage`, `SetupImageLogo`, `IsActive`, `EntryBy`, `EntryDate`, `LastUpdateBy`, `LastUpdateDate`) VALUES
(3, 'SavStudent', 'Aplikasi Tabungan Siswa', 'Aplikasi Untuk Mencatat Tabungan Siswa', 'Y', 'logo-tutwuri-handayani-ardi-madi-blog-11.png', 'logo-tutwuri-handayani-ardi-madi-blog-11.png', 'Y', 'brian', '2020-07-02 23:51:58', 'brian', '2020-07-13 23:25:16');

-- --------------------------------------------------------

--
-- Table structure for table `M_Student`
--

CREATE TABLE `M_Student` (
  `StudentID` varchar(20) NOT NULL,
  `classID` varchar(15) NOT NULL,
  `StudentName` varchar(200) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Adress` longtext NOT NULL,
  `JoinDate` date NOT NULL,
  `IsActive` varchar(1) NOT NULL,
  `EntryBy` varchar(20) NOT NULL,
  `EntryDate` datetime NOT NULL,
  `LastUpdateBy` varchar(20) NOT NULL,
  `LastUpdateDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `M_Student`
--

INSERT INTO `M_Student` (`StudentID`, `classID`, `StudentName`, `Gender`, `DateOfBirth`, `Email`, `Adress`, `JoinDate`, `IsActive`, `EntryBy`, `EntryDate`, `LastUpdateBy`, `LastUpdateDate`) VALUES
('1211785', 'VI-A', 'Abrian INF', 'Male', '1998-10-12', 'abrian@gmail.com', 'bekasi timur', '2016-01-12', 'Y', 'brian', '2020-06-24 00:14:24', 'brian', '2020-07-04 15:11:57'),
('12117856', 'VI-A', 'Fazal Rahman', 'Female', '1992-05-01', 'fazal@gmail.com', 'bekasi utara', '2016-01-12', 'Y', 'brian', '2020-06-24 00:55:58', 'brian', '2020-07-04 15:12:19'),
('12117857', 'X-C', 'komang gusti', 'Female', '1998-05-07', 'komang@gmail.com', 'bekasi utara', '2020-07-04', 'Y', 'brian', '2020-07-04 15:26:25', 'brian', '2020-07-04 15:26:25'),
('121178578', 'X-B', 'Puput Maharani', 'Female', '1997-02-04', 'puput.m@gmail.com', 'Jalan jakarta barat', '2020-07-01', 'Y', 'brian', '2020-07-12 06:09:49', 'brian', '2020-07-12 06:09:59'),
('12117859', 'XIII-A', 'deny sahid', 'Male', '1994-02-09', 'denysahid@gmail.com', 'bantar gebang bekasi', '2020-07-01', 'Y', 'brian', '2020-07-12 06:14:48', 'brian', '2020-07-12 06:14:48');

-- --------------------------------------------------------

--
-- Table structure for table `M_User`
--

CREATE TABLE `M_User` (
  `AdminID` int(11) NOT NULL,
  `AdminName` varchar(100) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varbinary(50) NOT NULL,
  `SuperUser` varchar(1) NOT NULL,
  `AdminImage` longtext NOT NULL,
  `IsActive` varchar(1) NOT NULL,
  `EntryBy` varchar(30) NOT NULL,
  `EntryDate` datetime NOT NULL,
  `LastUpdateBy` varchar(30) NOT NULL,
  `LastUpdateDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `M_User`
--

INSERT INTO `M_User` (`AdminID`, `AdminName`, `DateOfBirth`, `email`, `UserName`, `Password`, `SuperUser`, `AdminImage`, `IsActive`, `EntryBy`, `EntryDate`, `LastUpdateBy`, `LastUpdateDate`) VALUES
(2, 'abrian Inf', '1994-10-10', 'abriantama.inf@gmail.com', 'brian', 0x6362643434663862356234386135316637646162393861626364663435643465, 'Y', 'cs2.png', 'Y', 'admin', '2020-01-10 16:37:32', 'brian', '2020-07-13 23:23:54'),
(6, 'efira', '1994-02-01', 'efivara.steel@gmail.com', 'efi', 0x6139353835656532366239396230326664313934363539303266326664346435, 'N', 'cs1.png', 'Y', 'brian', '2020-05-09 15:01:43', 'efi', '2020-07-15 00:11:03');

-- --------------------------------------------------------

--
-- Table structure for table `T_Deposit`
--

CREATE TABLE `T_Deposit` (
  `DepositID` varchar(15) NOT NULL,
  `DepositDate` date NOT NULL,
  `StudentID` varchar(15) NOT NULL,
  `TotalDeposit` double NOT NULL,
  `IsActive` varchar(1) NOT NULL,
  `EntryBy` varchar(20) NOT NULL,
  `EntryDate` datetime NOT NULL,
  `LastUpdateBy` varchar(20) NOT NULL,
  `LastUpdateDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `T_Deposit`
--

INSERT INTO `T_Deposit` (`DepositID`, `DepositDate`, `StudentID`, `TotalDeposit`, `IsActive`, `EntryBy`, `EntryDate`, `LastUpdateBy`, `LastUpdateDate`) VALUES
('DPT-2006-000001', '2020-06-24', '12117856', 10000, 'Y', 'brian', '2020-06-24 19:08:18', 'brian', '2020-06-25 06:08:15'),
('DPT-2006-000002', '2020-06-24', '1211785', 15000, 'Y', 'brian', '2020-06-24 19:47:36', 'brian', '2020-06-24 19:47:36'),
('DPT-2006-000003', '2020-06-26', '1211785', 20000, 'Y', 'brian', '2020-06-29 11:38:29', 'brian', '2020-06-29 11:38:29'),
('DPT-2006-000004', '2020-06-26', '12117856', 11000, 'Y', 'brian', '2020-06-29 11:38:48', 'brian', '2020-06-29 11:38:48'),
('DPT-2007-000005', '2020-07-04', '12117857', 25000, 'Y', 'brian', '2020-07-04 15:26:42', 'brian', '2020-07-04 15:26:42'),
('DPT-2007-000006', '2020-07-11', '121178578', 12000, 'Y', 'brian', '2020-07-12 06:11:51', 'brian', '2020-07-12 06:11:51');

-- --------------------------------------------------------

--
-- Table structure for table `T_Withdrawal`
--

CREATE TABLE `T_Withdrawal` (
  `WithdrawalID` varchar(15) NOT NULL,
  `WithdrawalDate` date NOT NULL,
  `StudentID` varchar(15) NOT NULL,
  `TotalWithdrawal` double NOT NULL,
  `Description` longtext NOT NULL,
  `IsActive` varchar(1) NOT NULL,
  `EntryBy` varchar(20) NOT NULL,
  `EntryDate` datetime NOT NULL,
  `LastUpdateBy` varchar(20) NOT NULL,
  `LastUpdateDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `T_Withdrawal`
--

INSERT INTO `T_Withdrawal` (`WithdrawalID`, `WithdrawalDate`, `StudentID`, `TotalWithdrawal`, `Description`, `IsActive`, `EntryBy`, `EntryDate`, `LastUpdateBy`, `LastUpdateDate`) VALUES
('WTL-2006-000001', '2020-06-24', '1211785', 2000, '', 'Y', 'brian', '2020-06-24 22:22:20', 'brian', '2020-06-24 22:23:30'),
('WTL-2006-000002', '2020-06-24', '12117856', 4000, '', 'Y', 'brian', '2020-06-24 22:26:28', 'brian', '2020-06-29 11:39:01'),
('WTL-2007-000003', '2020-07-04', '12117857', 5000, '', 'Y', 'brian', '2020-07-04 15:34:51', 'brian', '2020-07-04 15:34:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `M_Class`
--
ALTER TABLE `M_Class`
  ADD PRIMARY KEY (`ClassID`);

--
-- Indexes for table `M_Months`
--
ALTER TABLE `M_Months`
  ADD PRIMARY KEY (`MonthID`);

--
-- Indexes for table `M_Setupprofile`
--
ALTER TABLE `M_Setupprofile`
  ADD PRIMARY KEY (`SetupprofileID`);

--
-- Indexes for table `M_Student`
--
ALTER TABLE `M_Student`
  ADD PRIMARY KEY (`StudentID`);

--
-- Indexes for table `M_User`
--
ALTER TABLE `M_User`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `T_Deposit`
--
ALTER TABLE `T_Deposit`
  ADD PRIMARY KEY (`DepositID`);

--
-- Indexes for table `T_Withdrawal`
--
ALTER TABLE `T_Withdrawal`
  ADD PRIMARY KEY (`WithdrawalID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `M_Setupprofile`
--
ALTER TABLE `M_Setupprofile`
  MODIFY `SetupprofileID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `M_User`
--
ALTER TABLE `M_User`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
