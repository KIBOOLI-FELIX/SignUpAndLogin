-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 02, 2023 at 07:24 AM
-- Server version: 5.7.36
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `userId` int(11) NOT NULL,
  `firstName` varchar(100) DEFAULT NULL,
  `lastName` varchar(100) DEFAULT NULL,
  `userName` varchar(50) NOT NULL,
  `userPassword` varchar(200) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `userPic` varchar(250) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(20) NOT NULL DEFAULT 'inactive',
  `uniId` varchar(32) NOT NULL,
  `activationDate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`userId`, `firstName`, `lastName`, `userName`, `userPassword`, `email`, `userPic`, `createdAt`, `status`, `uniId`, `activationDate`) VALUES
(1, NULL, NULL, 'felix', '$2y$10$QQqlp0SjPPeHp6uNY1MO.O7eiaCBpu5e6iWgBebzRsjcN6obSR0V.', 'kiboolifelix@gmail.com', '', '2023-01-18 23:32:14', 'active', '3e51a93b0d42e1b7688b42cddc591b35', '2023-01-18 02:32:14'),
(2, NULL, NULL, 'kiboolif', '$2y$10$f/VkaGnzkuklCgrCw7TIaOZwzY6UWs3fwSEdrPvDaJbvI2Bq/nphm', 'root@gmail.com', '', '2023-05-02 10:19:39', 'inactive', '6579cba8777faf04ccabd8edf085e485', '2023-05-02 02:19:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userName` (`userName`),
  ADD UNIQUE KEY `emailId` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
