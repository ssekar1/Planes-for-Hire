-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 20, 2015 at 03:24 AM
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
-- Table structure for table `admin_setting`
--

CREATE TABLE IF NOT EXISTS `admin_setting` (
`id` int(10) unsigned NOT NULL,
  `lateFee` double NOT NULL,
  `password` varchar(30) DEFAULT NULL,
  `lastLogon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_setting`
--

INSERT INTO `admin_setting` (`id`, `lateFee`, `password`, `lastLogon`) VALUES
(1, 10.5, 'admin', '2015-03-20 07:14:14');

-- --------------------------------------------------------

--
-- Table structure for table `airport_locations`
--

CREATE TABLE IF NOT EXISTS `airport_locations` (
`id` int(10) unsigned NOT NULL,
  `airport` text NOT NULL,
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
  `password` varchar(30) DEFAULT NULL,
  `checkOutStatus` int(1) unsigned NOT NULL DEFAULT '0',
  `plane` varchar(30) DEFAULT NULL,
  `regDate` datetime NOT NULL,
  `balance` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_profile`
--

INSERT INTO `customer_profile` (`id`, `firstName`, `lastName`, `street`, `city`, `state`, `zip`, `avatar`, `email`, `phone`, `password`, `checkOutStatus`, `plane`, `regDate`, `balance`) VALUES
(41, 'Tam', 'Tran', '2', 'Farmville', 'AZ', '82323', 'none specify', 'tamtran1@umbc.edu', '911', 'test', 0, ' ', '2015-03-19 06:16:08', 0),
(51, 'Test', 'test', 'test', 'test', 'te', '12345', 'none specify', 'test', '12345', 'test', 0, ' ', '2015-03-20 03:09:10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `planes`
--

CREATE TABLE IF NOT EXISTS `planes` (
`id` int(10) unsigned NOT NULL,
  `model` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `client` varchar(30) DEFAULT NULL,
  `leaseFrom` varchar(30) DEFAULT NULL,
  `returnTo` varchar(30) DEFAULT NULL,
  `returnDate` date DEFAULT NULL,
  `lastCheckout` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `planes`
--

INSERT INTO `planes` (`id`, `model`, `status`, `client`, `leaseFrom`, `returnTo`, `returnDate`, `lastCheckout`) VALUES
(1, 'Cessna 165 Airmaster', 1, '', '', '', '0000-00-00', '2015-03-20 04:57:01'),
(2, 'Cessna 175 Skylark', 1, ' ', ' ', ' ', '0000-00-00', '2015-03-20 05:22:16'),
(3, 'Cessna 177 Cardinal', 1, ' ', ' ', ' ', '0000-00-00', '2015-03-20 05:38:11'),
(4, 'Cessna 180 Skywagon', 1, ' ', ' ', ' ', '0000-00-00', '2015-03-20 07:24:03'),
(5, 'Cessna 162 Skycatcher', 1, ' ', ' ', ' ', '0000-00-00', '2015-03-20 06:23:48'),
(6, 'Cessna 205 Super Skywagon', 1, ' ', ' ', ' ', '0000-00-00', '2015-03-20 07:01:16'),
(7, 'Cessna 210 Centurion', 1, ' ', ' ', ' ', '0000-00-00', '2015-03-20 06:52:29'),
(8, 'Cessna T-50 Bobcat', 1, '', '', '', '0000-00-00', '2015-03-20 05:37:57'),
(9, 'Cessna 336 Skymaster', 1, ' ', ' ', ' ', '0000-00-00', '2015-03-20 06:45:10'),
(10, 'Cessna 421 Golden Eagle', 1, ' ', ' ', ' ', '0000-00-00', '2015-03-20 07:10:22'),
(11, 'Cessna 414 Chancellor', 1, ' ', ' ', ' ', '0000-00-00', '2015-03-20 05:21:39'),
(12, 'Cessna 305 Bird Dog', 1, '', '', '', '0000-00-00', '2015-03-20 04:57:01'),
(13, 'Cessna 510 Citation Mustang', 1, '', '', '', '0000-00-00', '2015-03-20 00:51:36'),
(14, 'Cessna 303 Crusader', 1, ' ', ' ', ' ', '0000-00-00', '2015-03-20 05:27:22');

-- --------------------------------------------------------

--
-- Table structure for table `tamtran1@umbc.edu`
--

CREATE TABLE IF NOT EXISTS `tamtran1@umbc.edu` (
`id` int(10) unsigned NOT NULL,
  `origAirport` varchar(30) DEFAULT NULL,
  `origLong` double DEFAULT NULL,
  `origLat` double DEFAULT NULL,
  `destAirport` varchar(30) DEFAULT NULL,
  `destLong` double DEFAULT NULL,
  `destLat` double DEFAULT NULL,
  `dateTravel` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `leaseModel` varchar(30) DEFAULT NULL,
  `lateFee` double DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=162 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE IF NOT EXISTS `test` (
`id` int(10) unsigned NOT NULL,
  `origAirport` varchar(30) DEFAULT NULL,
  `origLong` double DEFAULT NULL,
  `origLat` double DEFAULT NULL,
  `destAirport` varchar(30) DEFAULT NULL,
  `destLong` double DEFAULT NULL,
  `destLat` double DEFAULT NULL,
  `dateTravel` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `leaseModel` varchar(30) DEFAULT NULL,
  `lateFee` double DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `origAirport`, `origLong`, `origLat`, `destAirport`, `destLong`, `destLat`, `dateTravel`, `leaseModel`, `lateFee`) VALUES
(1, 'Philadelphia, PA', 39.9532, -75.15, 'Baltimore, MD', 39.293209, -76.616237, '2015-03-20 07:09:40', 'Cessna 421 Golden Eagle', NULL),
(2, 'Philadelphia, PA', 39.9532, -75.15, 'Nashville, TN', 36.166583, -86.778122, '2015-03-20 07:23:51', 'Cessna 180 Skywagon', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_setting`
--
ALTER TABLE `admin_setting`
 ADD PRIMARY KEY (`id`);

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
-- Indexes for table `planes`
--
ALTER TABLE `planes`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tamtran1@umbc.edu`
--
ALTER TABLE `tamtran1@umbc.edu`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_setting`
--
ALTER TABLE `admin_setting`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `airport_locations`
--
ALTER TABLE `airport_locations`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `customer_profile`
--
ALTER TABLE `customer_profile`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `planes`
--
ALTER TABLE `planes`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tamtran1@umbc.edu`
--
ALTER TABLE `tamtran1@umbc.edu`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=162;
--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
