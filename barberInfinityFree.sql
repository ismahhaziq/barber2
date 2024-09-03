-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2024 at 04:50 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `barber`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `App_ID` int(11) NOT NULL,
  `App_Date` date NOT NULL,
  `App_Time` time NOT NULL,
  `App_Status` varchar(255) NOT NULL,
  `Service_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`App_ID`, `App_Date`, `App_Time`, `App_Status`, `Service_ID`, `User_ID`, `Comment`) VALUES
(333, '2024-01-17', '10:46:00', 'Approved', 11, 35, ''),
(334, '2024-01-18', '06:48:00', 'RejectedData', 10, 35, 'Busy');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `Service_ID` int(11) NOT NULL,
  `Service_Name` varchar(255) NOT NULL,
  `Minutes` varchar(255) NOT NULL,
  `Available` varchar(11) NOT NULL,
  `Service_Price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`Service_ID`, `Service_Name`, `Minutes`, `Available`, `Service_Price`) VALUES
(10, 'Signature Haircut', '20', 'Yes', 18),
(11, 'Signature Hot Shave', '10', 'Yes', 15),
(12, 'Haircut & Hot Shave Combo', '35', 'Yes', 30),
(13, 'Head Massage', '20 ', 'Yes', 15);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `User_ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `User_Name` varchar(255) NOT NULL,
  `User_PhoneNum` varchar(255) DEFAULT NULL,
  `User_Email` varchar(255) NOT NULL,
  `User_Password` varchar(255) NOT NULL,
  `User_Type` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`User_ID`, `Name`, `User_Name`, `User_PhoneNum`, `User_Email`, `User_Password`, `User_Type`) VALUES
(31, 'user', 'user', '01172514020', 'user@gmail.com', '202cb962ac59075b964b07152d234b70', 'user'),
(32, 'isuma', 'isuma', '011', 'isuma', '1bb893847b399135293db470cc13e801', 'user'),
(33, 'admin', 'admin', '123222', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(34, 'MUHAMMAD HAKIM BIN RASDI', 'hakim', '222', 'hakimrasdi@gmail.com', 'f4a2758416b3aeb34bf1c29f2ccc7e25', 'user'),
(35, 'amira', 'amira', '12234', 'amira@gmail.com', 'f4a2758416b3aeb34bf1c29f2ccc7e25', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`App_ID`),
  ADD KEY `Service_ID` (`Service_ID`),
  ADD KEY `App_Date` (`App_Date`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`Service_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `App_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=335;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `Service_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`Service_ID`) REFERENCES `services` (`Service_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
