-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2015 at 05:31 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `airport_locations`
--

INSERT INTO `airport_locations` (`id`, `airport`, `long`, `lat`) VALUES
(1, 'Los Angeles International Airport, Los Angeles, CA', 33.948852, -118.408873),
(2, 'O''Hare International Airport, Chicago, IL', 41.988199, -87.907321),
(3, 'Dallas/Fort Worth International Airport, Dallas/Fort Worth, TX', 32.916815, -97.041708),
(4, 'Denver International Airport, Denver, CO', 39.85485, -104.674185),
(5, 'John F. Kennedy International Airport, New York, NY', 40.643135, -73.779512),
(6, 'San Francisco International Airport, San Francisco, CA', 37.623352, -122.379298),
(7, 'Charlotte Douglas International Airport, Charlotte, NC', 35.214683, -80.945255),
(8, 'McCarran International Airport, Las Vegas, NV', 36.084022, -115.153739),
(9, 'Phoenix Sky Harbor International Airport, Phoenix, AZ', 33.437412, -112.008818),
(10, 'Miami International Airport, Miami, FL', 25.79602, -80.287389),
(11, 'George Bush Intercontinental Airport, Houston, TX', 29.991707, -95.338843),
(12, 'Newark Liberty International Airport, Newark/New York, NJ', 40.691483, -74.174805),
(13, 'Orlando International Airport, Orlando, FL', 28.431215, -81.308083),
(14, 'Seattle Tacoma International Airport, Seattle, WA', 47.450134, -122.309159),
(15, 'Minneapolis Saint Paul International Airport, Minneapolis, MIN', 44.884877, -93.222972),
(16, 'Detroit Metropolitan Wayne County Airport, Detroit, MI', 42.217443, -83.357444),
(17, 'Logan International Airport, Boston, MA', 42.36574, -71.009903),
(18, 'Philadelphia International Airport, Philadelphia, PA', 39.874264, -75.242766),
(19, 'LaGuardia Airport, New York, NY', 40.776277, -73.873623),
(20, 'Fort Lauderdale Hollywood International Airport, Fort Lauderdale, FL', 26.074311, -80.150774),
(21, 'Hartsfield Jackson Atlanta International Airport, Atlanta, GA', 33.63812, -84.42765),
(22, 'Baltimore Washington International Airport, Baltimore, MD', 39.177271, -76.668735),
(23, 'Washington Dulles International Airport, Washington D.C. , VA', 38.953917, -77.456539),
(24, 'Salt Lake City International Airport, Salt Lake, UT	', 40.78916, -111.979071),
(25, 'Honolulu International Airport, Honolulu, HI	', 21.324353, -157.925417),
(26, 'Portland International Airport, Portland, OR', 45.589168, -122.595094),
(27, 'Great Falls International Airport, Great Falls, MT', 47.48029, -111.363142),
(28, 'Idaho Falls Regional Airport, Idaho, ID', 43.515098, -112.067869),
(29, 'Bismarck Airport, Bismarck, ND', 46.773825, -100.755623),
(30, 'Pierre Regional Airport, Pierre, SD', 44.377832, -100.280123),
(31, 'North Platte Regional Airport, North Platte, NE', 41.133451, -100.697834),
(32, 'Hays Regional Airport, Hays, KS', 38.863272, -99.264902),
(33, 'Rolla National Airport, Rolla, MO', 38.131859, -91.766052),
(34, 'Golden Triangle Regional Airport, Columbus, MS', 33.454057, -88.589612),
(35, 'Albuquerque International Sunport Airport, Albuquerque, NM', 35.043337, -106.612929);

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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

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
(14, 'Cessna 303 Crusader', 1, ' ', ' ', ' ', '0000-00-00', '2015-03-20 05:27:22'),
(15, 'Cessna Model CR-1', 1, ' ', ' ', ' ', '0000-00-00', '2015-03-20 04:00:00'),
(16, 'Cessna Model CR-2', 1, ' ', ' ', ' ', '0000-00-00', '2015-03-20 04:00:00'),
(17, 'Cessna Model CR-3', 1, ' ', ' ', ' ', '0000-00-00', '2015-03-20 04:00:00'),
(18, 'Cessna 172 Skyhawk', 1, ' ', ' ', ' ', '0000-00-00', '2015-03-20 04:00:00'),
(19, 'Cessna 182 SkyLane', 1, ' ', ' ', ' ', '0000-00-00', '2015-03-20 04:00:00'),
(20, 'Cessna 320 Skyknight', 1, ' ', ' ', ' ', '0000-00-00', '2015-03-20 04:00:00'),
(21, 'Bombardier Learjet 35', 1, ' ', ' ', ' ', '0000-00-00', '2015-03-20 04:00:00'),
(22, 'Bombardier Learjet 40 XR', 1, ' ', ' ', ' ', '0000-00-00', '2015-03-20 04:00:00'),
(23, 'Bombardier Learjet 60 XR', 1, ' ', ' ', ' ', '0000-00-00', '2015-03-20 04:00:00'),
(24, 'Bombardier Challenger 605', 1, ' ', ' ', ' ', '0000-00-00', '2015-03-20 04:00:00'),
(25, 'Bombardier Challenger 850', 1, ' ', ' ', ' ', '0000-00-00', '2015-03-20 04:00:00'),
(26, 'Bombardier Challenger 950', 1, ' ', ' ', ' ', '0000-00-00', '2015-03-20 04:00:00'),
(27, 'Bombardier Global 5000', 1, ' ', ' ', ' ', '0000-00-00', '2015-03-20 04:00:00'),
(28, 'Bombardier Global 6000', 1, ' ', ' ', ' ', '0000-00-00', '2015-03-20 04:00:00'),
(29, 'Dassault Falcon 10', 1, ' ', ' ', ' ', '0000-00-00', '2015-03-20 04:00:00'),
(30, 'Embraer Phenom 300', 1, ' ', ' ', ' ', '0000-00-00', '2015-03-20 04:00:00');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `airport_locations`
--
ALTER TABLE `airport_locations`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `customer_profile`
--
ALTER TABLE `customer_profile`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `planes`
--
ALTER TABLE `planes`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `tamtran1@umbc.edu`
--
ALTER TABLE `tamtran1@umbc.edu`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
