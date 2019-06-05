-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 04, 2019 at 06:51 PM
-- Server version: 5.6.44-cll-lve
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `luiscobi_iot`
--

-- --------------------------------------------------------

--
-- Table structure for table `Lugares`
--

CREATE TABLE `Lugares` (
  `idLugares` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `ocupado` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Lugares`
--

INSERT INTO `Lugares` (`idLugares`, `nombre`, `ocupado`) VALUES
(1, 'Lugar 1', 0),
(2, 'Lugar 2', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Lugares`
--
ALTER TABLE `Lugares`
  ADD PRIMARY KEY (`idLugares`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Lugares`
--
ALTER TABLE `Lugares`
  MODIFY `idLugares` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
