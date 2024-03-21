-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2024 at 02:32 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `godlovesme`
--

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `user_id` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`user_id`, `Username`, `Password`) VALUES
(1, 'Jaymark', 'password'),
(2, 'Emilfred', 'caranguian'),
(3, 'Balansay', 'tongco');

-- --------------------------------------------------------

--
-- Table structure for table `tbinformation`
--

CREATE TABLE `tbinformation` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Age` int(11) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Contact` bigint(20) DEFAULT NULL,
  `Birthday` date DEFAULT NULL,
  `Gender` varchar(255) DEFAULT NULL,
  `Gmail` varchar(255) DEFAULT NULL,
  `Bloodtype` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbinformation`
--

INSERT INTO `tbinformation` (`ID`, `user_id`, `Name`, `Age`, `Address`, `Contact`, `Birthday`, `Gender`, `Gmail`, `Bloodtype`) VALUES
(2, 2, 'Emilfred Caranguian', 21, 'Sangandaan', 9356543975, '2000-05-04', 'male', 'emilfredcaranguian@gmail.com', 'O'),
(3, 3, 'Rubylyn Balansay', 21, 'IDK', 9356587965, '2002-05-02', 'female', 'rubylynbalansay@gmail.com', 'A+'),
(4, 1, 'Jaymark Fuellas Besa', 22, 'Caloocan', 9356523541, '2002-07-19', 'male', 'jaymark.besa19@gmail.com', 'A+');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbinformation`
--
ALTER TABLE `tbinformation`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbinformation`
--
ALTER TABLE `tbinformation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbinformation`
--
ALTER TABLE `tbinformation`
  ADD CONSTRAINT `tbinformation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `register` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
