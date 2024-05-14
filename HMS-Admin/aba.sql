-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 14, 2024 at 06:03 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aba`
--

-- --------------------------------------------------------

--
-- Table structure for table `ab`
--

CREATE TABLE `ab` (
  `Id` varchar(10) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Pass` varchar(20) NOT NULL,
  `Email` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ab`
--

INSERT INTO `ab` (`Id`, `Name`, `Pass`, `Email`) VALUES
('1', 'q', 'sfgs', 'w'),
('2', 'gfd', 'dsfs', '3fsddsfsdf'),
('3', 'erew', '3', 'fwgfg'),
('4', 'efsdf', 'u', 'fdsffgsgf'),
('5', 'ghg', '5', 'fgcxdzszsa');

-- --------------------------------------------------------

--
-- Table structure for table `EP`
--

CREATE TABLE `EP` (
  `E_id` text NOT NULL,
  `Name` varchar(20) NOT NULL,
  `E_type` varchar(20) NOT NULL,
  `Speciality` varchar(20) DEFAULT NULL,
  `Bills` int(10) DEFAULT NULL,
  `R_status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `EP`
--

INSERT INTO `EP` (`E_id`, `Name`, `E_type`, `Speciality`, `Bills`, `R_status`) VALUES
('425', 'ertert', 'Patient', NULL, 5675757, 'Ready'),
('4324', 'gfsg', 'Doctor', 'Pediatrics', NULL, NULL),
('4324', 'rgtertg', 'Doctor', 'Pediatrics', NULL, NULL),
('78', 'ghgfg', 'Patient', NULL, 899, 'Not ready');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
