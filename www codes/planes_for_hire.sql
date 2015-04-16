-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 16, 2015 at 02:14 AM
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
  `password` text,
  `lastLogon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_setting`
--

INSERT INTO `admin_setting` (`id`, `lateFee`, `password`, `lastLogon`) VALUES
(1, 10.5, '$2a$10$T64hGnKT76GqAlaN2SYWnOeFA6B.lHwj5aCLAz/36qZSWOMrfZYBe', '2015-04-16 06:06:46');

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
(1, 'Los Angeles Airport, Los Angeles, CA', 33.948852, -118.408873),
(2, 'O Hare Airport, Chicago, IL', 41.988199, -87.907321),
(3, 'Dallas/Fort Worth Airport, Dallas/Fort Worth, TX', 32.916815, -97.041708),
(4, 'Denver Airport, Denver, CO', 39.85485, -104.674185),
(5, 'John F. Kennedy Airport, New York, NY', 40.643135, -73.779512),
(6, 'San Francisco Airport, San Francisco, CA', 37.623352, -122.379298),
(7, 'Charlotte Douglas Airport, Charlotte, NC', 35.214683, -80.945255),
(8, 'McCarran Airport, Las Vegas, NV', 36.084022, -115.153739),
(9, 'Phoenix Sky Harbor Airport, Phoenix, AZ', 33.437412, -112.008818),
(10, 'Miami Airport, Miami, FL', 25.79602, -80.287389),
(11, 'George Bush Intercontinental Airport, Houston, TX', 29.991707, -95.338843),
(12, 'Newark Liberty Airport, Newark/New York, NJ', 40.691483, -74.174805),
(13, 'Orlando Airport, Orlando, FL', 28.431215, -81.308083),
(14, 'Seattle Tacoma Airport, Seattle, WA', 47.450134, -122.309159),
(15, 'Minneapolis Saint Paul Airport, Minneapolis, MIN', 44.884877, -93.222972),
(16, 'Detroit Metropolitan Airport, Detroit, MI', 42.217443, -83.357444),
(17, 'Logan Continental Airport, Boston, MA', 42.36574, -71.009903),
(18, 'Philadelphia Airport, Philadelphia, PA', 39.874264, -75.242766),
(19, 'LaGuardia Airport, New York, NY', 40.776277, -73.873623),
(20, 'Fort Lauderdale Airport, Fort Lauderdale, FL', 26.074311, -80.150774),
(21, 'Hartsfield Jackson Atlanta Airport, Atlanta, GA', 33.63812, -84.42765),
(22, 'Baltimore Washington Airport, Baltimore, MD', 39.177271, -76.668735),
(23, 'Washington Dulles Airport, Washington D.C. , VA', 38.953917, -77.456539),
(24, 'Salt Lake City Airport, Salt Lake, UT	', 40.78916, -111.979071),
(25, 'Honolulu Airport, Honolulu, HI	', 21.324353, -157.925417),
(26, 'Portland Airport, Portland, OR', 45.589168, -122.595094),
(27, 'Great Falls Airport, Great Falls, MT', 47.48029, -111.363142),
(28, 'Idaho Falls Regional Airport, Idaho, ID', 43.515098, -112.067869),
(29, 'Bismarck Airport, Bismarck, ND', 46.773825, -100.755623),
(30, 'Pierre Regional Airport, Pierre, SD', 44.377832, -100.280123),
(31, 'North Platte Regional Airport, North Platte, NE', 41.133451, -100.697834),
(32, 'Hays Regional Airport, Hays, KS', 38.863272, -99.264902),
(33, 'Rolla National Airport, Rolla, MO', 38.131859, -91.766052),
(34, 'Golden Triangle Regional Airport, Columbus, MS', 33.454057, -88.589612),
(35, 'Albuquerque Sunport Airport, Albuquerque, NM', 35.043337, -106.612929);

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
  `password` text,
  `checkOutStatus` int(1) unsigned NOT NULL DEFAULT '0',
  `plane` varchar(30) DEFAULT NULL,
  `regDate` datetime NOT NULL,
  `balance` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_profile`
--

INSERT INTO `customer_profile` (`id`, `firstName`, `lastName`, `street`, `city`, `state`, `zip`, `avatar`, `email`, `phone`, `password`, `checkOutStatus`, `plane`, `regDate`, `balance`) VALUES
(68, 'Tam', 'Tran', '1000 Hilltop Circle', 'test', 'MD', '21250', 'default.jpg', 'tamtran1@umbc.edu', '4104551000', '$2a$10$9N/mCd0ZrZRDvSn.srAAu.WZqQnAKvh/vAFsRlGZNtafJsInCYkGW', 0, NULL, '2015-04-16 00:48:56', 0);

-- --------------------------------------------------------

--
-- Table structure for table `planes`
--

CREATE TABLE IF NOT EXISTS `planes` (
`id` int(10) unsigned NOT NULL,
  `model` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `currentLocation` varchar(90) DEFAULT NULL,
  `client` varchar(30) DEFAULT NULL,
  `leaseFrom` varchar(90) DEFAULT NULL,
  `returnTo` varchar(90) DEFAULT NULL,
  `returnDate` date DEFAULT NULL,
  `lastCheckout` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `planes`
--

INSERT INTO `planes` (`id`, `model`, `status`, `currentLocation`, `client`, `leaseFrom`, `returnTo`, `returnDate`, `lastCheckout`) VALUES
(1, 'Cessna 165 Airmaster', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-04-05 07:46:12'),
(2, 'Cessna 175 Skylark', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-04-05 06:40:44'),
(3, 'Cessna 177 Cardinal', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-04-05 07:47:59'),
(4, 'Cessna 180 Skywagon', 1, 'Dallas/Fort Worth Airport, Dallas/Fort Worth, TX', '', '', '', '0000-00-00', '2015-04-05 07:16:02'),
(5, 'Cessna 162 Skycatcher', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-04-05 06:40:01'),
(6, 'Cessna 205 Super Skywagon', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-04-05 06:40:28'),
(7, 'Cessna 210 Centurion', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-04-05 06:57:42'),
(8, 'Cessna T-50 Bobcat', 1, 'Idaho Falls Regional Airport, Idaho, ID', '', '', '', '0000-00-00', '2015-04-05 07:47:22'),
(9, 'Cessna 336 Skymaster', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-04-05 07:03:06'),
(10, 'Cessna 421 Golden Eagle', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-04-05 06:58:51'),
(11, 'Cessna 414 Chancellor', 1, 'Philadelphia Airport, Philadelphia, PA', '', '', '', '0000-00-00', '2015-04-05 07:47:07'),
(12, 'Cessna 305 Bird Dog', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-04-05 06:59:24'),
(13, 'Cessna 510 Citation Mustang', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-04-05 06:59:45'),
(14, 'Cessna 303 Crusader', 1, 'Denver Airport, Denver, CO', '', '', '', '0000-00-00', '2015-04-16 04:47:36'),
(15, 'Cessna Model CR-1', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-04-05 07:00:31'),
(16, 'Cessna Model CR-2', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-04-05 07:00:46'),
(17, 'Cessna Model CR-3', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-04-05 07:01:33'),
(18, 'Cessna 172 Skyhawk', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-04-05 07:01:51'),
(19, 'Cessna 182 SkyLane', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-04-05 07:02:08'),
(20, 'Cessna 320 Skyknight', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-04-05 07:02:44'),
(21, 'Bombardier Learjet 35', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-04-05 07:02:22'),
(22, 'Bombardier Learjet 40 XR', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-04-05 07:03:33'),
(23, 'Bombardier Learjet 60 XR', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-04-05 07:04:13'),
(24, 'Bombardier Challenger 605', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-04-05 07:04:35'),
(25, 'Bombardier Challenger 850', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-04-05 07:04:58'),
(26, 'Bombardier Challenger 950', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-04-05 07:05:13'),
(27, 'Bombardier Global 5000', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-04-05 07:05:37'),
(28, 'Bombardier Global 6000', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-04-05 07:06:02'),
(29, 'Dassault Falcon 10', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-04-05 07:06:28'),
(30, 'Embraer Phenom 300', 1, '', '', '', '', '0000-00-00', '2015-04-05 07:42:09');

-- --------------------------------------------------------

--
-- Table structure for table `tamtran1@umbc.edu`
--

CREATE TABLE IF NOT EXISTS `tamtran1@umbc.edu` (
`id` int(10) unsigned NOT NULL,
  `origAirport` varchar(90) DEFAULT NULL,
  `origLong` double DEFAULT NULL,
  `origLat` double DEFAULT NULL,
  `destAirport` varchar(90) DEFAULT NULL,
  `destLong` double DEFAULT NULL,
  `destLat` double DEFAULT NULL,
  `dateTravel` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `leaseModel` varchar(90) DEFAULT NULL,
  `lateFee` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=69;
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
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
