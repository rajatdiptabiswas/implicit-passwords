-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 13, 2019 at 07:00 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `major`
--

-- --------------------------------------------------------

--
-- Table structure for table `AskedAuth`
--

CREATE TABLE `AskedAuth` (
  `UserID` int(11) NOT NULL,
  `AuthSpace` int(11) NOT NULL,
  `Answer` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `AskedAuth`
--

INSERT INTO `AskedAuth` (`UserID`, `AuthSpace`, `Answer`) VALUES
(43, 1, '17'),
(42, 1, '3'),
(0, 1, '5'),
(42, 3, '5'),
(42, 0, 'Kolkata'),
(42, 2, 'Kolkata'),
(44, 2, 'Sydney'),
(44, 1, '3'),
(44, 3, '2'),
(45, 3, '4'),
(45, 1, '3'),
(45, 2, 'Kolkata'),
(46, 3, '3'),
(46, 2, 'Kolkata'),
(46, 1, '4'),
(47, 3, '4'),
(47, 1, '3'),
(47, 2, 'shimla'),
(48, 2, 'Kolkata');

-- --------------------------------------------------------

--
-- Table structure for table `ImplicitPasswords`
--

CREATE TABLE `ImplicitPasswords` (
  `ImplicitPasswordsID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `AuthSpaceID` int(11) NOT NULL,
  `Answer` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ImplicitPasswords`
--

INSERT INTO `ImplicitPasswords` (`ImplicitPasswordsID`, `UserID`, `AuthSpaceID`, `Answer`) VALUES
(1, 1, 1, 'Michael Jackson'),
(2, 42, 1, 'Amitabh Bachchan'),
(4, 42, 2, 'Kolkata'),
(5, 43, 3, 'Manchester united'),
(6, 43, 4, 'Lays cream n onion'),
(7, 43, 2, 'google engineer'),
(8, 44, 2, 'Sydney'),
(9, 44, 1, 'Michael Jackson'),
(10, 44, 3, 'Australia cricket team'),
(11, 45, 2, 'Kolkata'),
(12, 45, 1, 'Michael Jackson'),
(13, 45, 3, 'Indian Football Team'),
(14, 46, 2, 'Kolkata'),
(15, 46, 1, 'Michael Jackson'),
(16, 46, 3, 'Indian Football Team'),
(17, 47, 1, 'sonu nigam'),
(18, 47, 2, 'shimla'),
(19, 47, 3, 'chennai super kings'),
(20, 48, 1, 'sonu nigam'),
(21, 48, 3, 'Indian football team'),
(22, 48, 2, 'Kolkata');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `UserID` int(100) NOT NULL,
  `UserName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `UserEmail` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CreatedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Active` int(11) NOT NULL DEFAULT '1',
  `Password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Stores all the users even inactive.';

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`UserID`, `UserName`, `UserEmail`, `CreatedDate`, `Active`, `Password`) VALUES
(42, 'tuhinspatra', 'a1@b.com', '2019-11-11 22:17:34', 1, '81dc9bdb52d04dc20036dbd8313ed055'),
(43, 'rdb', 'a2@b.com', '2019-11-12 14:21:16', 1, '81dc9bdb52d04dc20036dbd8313ed055'),
(44, 'tuhin', 'tuhin@gmail.com', '2019-11-27 15:11:58', 1, '81dc9bdb52d04dc20036dbd8313ed055'),
(45, 'tuhin_1', 'mynameistuhin1@gmail.com', '2019-11-27 15:22:48', 1, '81dc9bdb52d04dc20036dbd8313ed055'),
(46, 'tuhin1', 'tuhin11@gmail.com', '2019-11-27 16:11:40', 1, '81dc9bdb52d04dc20036dbd8313ed055'),
(47, 'uj', 'uj@pj.com', '2019-11-27 23:14:01', 1, '81dc9bdb52d04dc20036dbd8313ed055'),
(48, 'sarsijsir', 'a111@b.com', '2019-11-28 10:51:14', 1, '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ImplicitPasswords`
--
ALTER TABLE `ImplicitPasswords`
  ADD PRIMARY KEY (`ImplicitPasswordsID`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `UserID` (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ImplicitPasswords`
--
ALTER TABLE `ImplicitPasswords`
  MODIFY `ImplicitPasswordsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `UserID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
