-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 18, 2015 at 02:05 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `planes_for_hire`
--

-- --------------------------------------------------------

--
-- Table structure for table `airport_locations`
--

CREATE TABLE IF NOT EXISTS `airport_locations` (
`id` int(10) unsigned NOT NULL,
  `airport` varchar(30) NOT NULL,
  `long` double NOT NULL,
  `lat` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `airport_locations`
--

INSERT INTO `airport_locations` (`id`, `airport`, `long`, `lat`) VALUES
(1, 'Philadelphia, PA', 39.9532, -75.15),
(2, 'Brooklyn, NY', 40.701231, -73.983114),
(3, 'Baltimore, MD', 39.293209, -76.616237),
(4, 'Miami, FL', 25.766924, -80.189667),
(5, 'Nashville, TN', 36.166583, -86.778122),
(6, 'Memphis, TN', 35.147435, -90.047005),
(7, 'Dallas, TX', 32.775608, -96.796914),
(8, 'San Antonio, TX', 29.424443, -98.493564),
(9, 'Houston, TX', 29.75998, -95.370514),
(10, 'Springfield, IL', 39.780452, -89.647856),
(11, 'Tacoma, WA', 47.253024, -122.446145),
(12, 'Chicago, IL', 41.877564, -87.62654),
(13, 'Las Vegas, NV', 36.169842, -115.140058),
(14, 'Phoenix, AZ', 33.448329, -112.073952),
(15, 'Denver, CO', 39.737602, -104.991869),
(16, 'Kansas City, MO', 39.107497, -94.574453),
(17, 'San Jose, CA', 37.330774, -121.882693),
(18, 'Minneapolis, MN', 44.977118, -93.262079),
(19, 'Detroit, MI', 42.33355, -83.047693),
(20, 'Albuquerque, NM', 35.117617, -106.607652);

-- --------------------------------------------------------

--
-- Table structure for table `customer_profile`
--

CREATE TABLE IF NOT EXISTS `customer_profile` (
`id` int(10) unsigned NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `street` varchar(60) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` char(2) NOT NULL,
  `zip` varchar(5) NOT NULL,
  `avatar` text,
  `email` varchar(30) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `password` varchar(30) NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_profile`
--

INSERT INTO `customer_profile` (`id`, `firstName`, `lastName`, `street`, `city`, `state`, `zip`, `avatar`, `email`, `phone`, `password`, `regDate`) VALUES
(41, 'Tam', 'Tran', '12345 Abc street', 'Abc-ville', 'MD', '99999', 'none specify', 'tamtran1@umbc.edu', '911', 'test', '2015-03-18 04:10:15'),
(43, 'Test', 'User', 'test', 'test', 'te', '09876', 'none specify', 'testuser@umbc.edu', '1234567890', 'test', '2015-03-18 05:18:21');

-- --------------------------------------------------------

--
-- Table structure for table `tamtran1@umbc.edu`
--

CREATE TABLE IF NOT EXISTS `tamtran1@umbc.edu` (
`id` int(10) unsigned NOT NULL,
  `origAirport` varchar(30) NOT NULL,
  `origLong` double NOT NULL,
  `origLat` double NOT NULL,
  `destAirport` varchar(30) NOT NULL,
  `destLong` double NOT NULL,
  `destLat` double NOT NULL,
  `dateTravel` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tamtran1@umbc.edu`
--

INSERT INTO `tamtran1@umbc.edu` (`id`, `origAirport`, `origLong`, `origLat`, `destAirport`, `destLong`, `destLat`, `dateTravel`) VALUES
(1, 'test airport', -45.678, 34.786, 'test airport 2', 78.123, 12.565, '2015-03-18 04:14:05');

-- --------------------------------------------------------

--
-- Table structure for table `testuser@umbc.edu`
--

CREATE TABLE IF NOT EXISTS `testuser@umbc.edu` (
`id` int(10) unsigned NOT NULL,
  `origAirport` varchar(30) NOT NULL,
  `origLong` double NOT NULL,
  `origLat` double NOT NULL,
  `destAirport` varchar(30) NOT NULL,
  `destLong` double NOT NULL,
  `destLat` double NOT NULL,
  `dateTravel` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `airport_locations`
--
ALTER TABLE `airport_locations`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_profile`
--
ALTER TABLE `customer_profile`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tamtran1@umbc.edu`
--
ALTER TABLE `tamtran1@umbc.edu`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testuser@umbc.edu`
--
ALTER TABLE `testuser@umbc.edu`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `airport_locations`
--
ALTER TABLE `airport_locations`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `customer_profile`
--
ALTER TABLE `customer_profile`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `tamtran1@umbc.edu`
--
ALTER TABLE `tamtran1@umbc.edu`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `testuser@umbc.edu`
--
ALTER TABLE `testuser@umbc.edu`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
