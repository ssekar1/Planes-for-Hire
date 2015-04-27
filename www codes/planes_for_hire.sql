-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 25, 2015 at 06:37 PM
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
  `lat` double NOT NULL,
  `planeWaitList` text
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `airport_locations`
--

INSERT INTO `airport_locations` (`id`, `airport`, `long`, `lat`, `planeWaitList`) VALUES
(1, 'Los Angeles Airport, Los Angeles, CA', 33.948852, -118.408873, 'C:19:"SplDoublyLinkedList":500:{i:0;:s:20:"Cessna 165 Airmaster";:s:18:"Cessna 175 Skylark";:s:19:"Cessna 177 Cardinal";:s:21:"Cessna 162 Skycatcher";:s:19:"Cessna 180 Skywagon";:s:25:"Cessna 205 Super Skywagon";:s:21:"Cessna 414 Chancellor";:s:20:"Cessna 210 Centurion";:s:18:"Cessna T-50 Bobcat";:s:17:"Cessna Model CR-1";:s:20:"Cessna 320 Skyknight";:s:20:"Cessna 336 Skymaster";:s:23:"Cessna 421 Golden Eagle";:s:19:"Cessna 305 Bird Dog";:s:27:"Cessna 510 Citation Mustang";:s:19:"Cessna 303 Crusader";:s:17:"Cessna Model CR-2";}'),
(2, 'O Hare Airport, Chicago, IL', 41.988199, -87.907321, 'C:19:"SplDoublyLinkedList":146:{i:0;:s:20:"Cessna 165 Airmaster";:s:19:"Cessna 177 Cardinal";:s:18:"Cessna 175 Skylark";:s:21:"Cessna 162 Skycatcher";:s:19:"Cessna 305 Bird Dog";}'),
(3, 'Dallas/Fort Worth Airport, Dallas/Fort Worth, TX', 32.916815, -97.041708, 'C:19:"SplDoublyLinkedList":4:{i:0;}'),
(4, 'Denver Airport, Denver, CO', 39.85485, -104.674185, 'C:19:"SplDoublyLinkedList":31:{i:0;:s:18:"Cessna 175 Skylark";}'),
(5, 'John F. Kennedy Airport, New York, NY', 40.643135, -73.779512, 'C:19:"SplDoublyLinkedList":4:{i:0;}'),
(6, 'San Francisco Airport, San Francisco, CA', 37.623352, -122.379298, 'C:19:"SplDoublyLinkedList":4:{i:0;}'),
(7, 'Charlotte Douglas Airport, Charlotte, NC', 35.214683, -80.945255, ''),
(8, 'McCarran Airport, Las Vegas, NV', 36.084022, -115.153739, 'C:19:"SplDoublyLinkedList":60:{i:0;:s:20:"Cessna 210 Centurion";:s:18:"Cessna 175 Skylark";}'),
(9, 'Phoenix Sky Harbor Airport, Phoenix, AZ', 33.437412, -112.008818, ''),
(10, 'Miami Airport, Miami, FL', 25.79602, -80.287389, ''),
(11, 'George Bush Intercontinental Airport, Houston, TX', 29.991707, -95.338843, 'C:19:"SplDoublyLinkedList":61:{i:0;:s:20:"Cessna 336 Skymaster";:s:19:"Cessna 177 Cardinal";}'),
(12, 'Newark Liberty Airport, Newark/New York, NJ', 40.691483, -74.174805, ''),
(13, 'Orlando Airport, Orlando, FL', 28.431215, -81.308083, 'C:19:"SplDoublyLinkedList":4:{i:0;}'),
(14, 'Seattle Tacoma Airport, Seattle, WA', 47.450134, -122.309159, ''),
(15, 'Minneapolis Saint Paul Airport, Minneapolis, MIN', 44.884877, -93.222972, ''),
(16, 'Detroit Metropolitan Airport, Detroit, MI', 42.217443, -83.357444, ''),
(17, 'Logan Continental Airport, Boston, MA', 42.36574, -71.009903, ''),
(18, 'Philadelphia Airport, Philadelphia, PA', 39.874264, -75.242766, ''),
(19, 'LaGuardia Airport, New York, NY', 40.776277, -73.873623, ''),
(20, 'Fort Lauderdale Airport, Fort Lauderdale, FL', 26.074311, -80.150774, ''),
(21, 'Hartsfield Jackson Atlanta Airport, Atlanta, GA', 33.63812, -84.42765, ''),
(22, 'Baltimore Washington Airport, Baltimore, MD', 39.177271, -76.668735, ''),
(23, 'Washington Dulles Airport, Washington D.C. , VA', 38.953917, -77.456539, ''),
(24, 'Salt Lake City Airport, Salt Lake, UT	', 40.78916, -111.979071, ''),
(25, 'Honolulu Airport, Honolulu, HI	', 21.324353, -157.925417, ''),
(26, 'Portland Airport, Portland, OR', 45.589168, -122.595094, ''),
(27, 'Great Falls Airport, Great Falls, MT', 47.48029, -111.363142, ''),
(28, 'Idaho Falls Regional Airport, Idaho, ID', 43.515098, -112.067869, ''),
(29, 'Bismarck Airport, Bismarck, ND', 46.773825, -100.755623, ''),
(30, 'Pierre Regional Airport, Pierre, SD', 44.377832, -100.280123, ''),
(31, 'North Platte Regional Airport, North Platte, NE', 41.133451, -100.697834, ''),
(32, 'Hays Regional Airport, Hays, KS', 38.863272, -99.264902, ''),
(33, 'Rolla National Airport, Rolla, MO', 38.131859, -91.766052, ''),
(34, 'Golden Triangle Regional Airport, Columbus, MS', 33.454057, -88.589612, ''),
(35, 'Albuquerque Sunport Airport, Albuquerque, NM', 35.043337, -106.612929, '');

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
  `travelHist` text,
  `checkOutStatus` int(1) unsigned NOT NULL DEFAULT '0',
  `plane` varchar(30) DEFAULT NULL,
  `regDate` datetime NOT NULL,
  `balance` double NOT NULL,
  `notification` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_profile`
--

INSERT INTO `customer_profile` (`id`, `firstName`, `lastName`, `street`, `city`, `state`, `zip`, `avatar`, `email`, `phone`, `password`, `travelHist`, `checkOutStatus`, `plane`, `regDate`, `balance`, `notification`) VALUES
(80, 'Tam', 'Tran', '1000 Hilltop Circle', 'Baltimore', 'MD', '21250', 'default.jpg', 'tamtran1@umbc.edu', '4104551000', '$2a$10$239CuRNuDq4BdXwfzV9o.OY5sn0iICHeWhAHlrQQeD7oFjSjY23MG', 'C:19:"SplDoublyLinkedList":5652:{i:0;:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:25:"Washington Dulles Airport";s:10:"travelDate";s:10:"2015-04-27";s:11:"leasedModel";s:22:"Bombardier Global 5000";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:27:"Albuquerque Sunport Airport";s:10:"travelDate";s:10:"2015-04-20";s:11:"leasedModel";s:18:"Cessna 182 SkyLane";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:22:"Rolla National Airport";s:10:"travelDate";s:10:"2015-04-27";s:11:"leasedModel";s:18:"Embraer Phenom 300";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:34:"Hartsfield Jackson Atlanta Airport";s:10:"travelDate";s:10:"2015-04-13";s:11:"leasedModel";s:25:"Bombardier Challenger 950";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:20:"Philadelphia Airport";s:10:"travelDate";s:10:"2015-04-14";s:11:"leasedModel";s:22:"Bombardier Global 6000";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:30:"Minneapolis Saint Paul Airport";s:10:"travelDate";s:10:"2015-04-13";s:11:"leasedModel";s:18:"Dassault Falcon 10";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:36:"George Bush Intercontinental Airport";s:10:"travelDate";s:10:"2015-04-27";s:11:"leasedModel";s:19:"Cessna 177 Cardinal";}:O:13:"TravelHistory":4:{s:6:"depart";s:13:"Miami Airport";s:6:"arrive";s:14:"Denver Airport";s:10:"travelDate";s:10:"2015-04-20";s:11:"leasedModel";s:19:"Cessna 305 Bird Dog";}:O:13:"TravelHistory":4:{s:6:"depart";s:16:"Bismarck Airport";s:6:"arrive";s:28:"Baltimore Washington Airport";s:10:"travelDate";s:10:"2015-04-20";s:11:"leasedModel";s:27:"Cessna 510 Citation Mustang";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Great Falls Airport";s:6:"arrive";s:13:"Miami Airport";s:10:"travelDate";s:10:"2015-04-20";s:11:"leasedModel";s:24:"Bombardier Learjet 60 XR";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:36:"George Bush Intercontinental Airport";s:10:"travelDate";s:10:"2015-04-20";s:11:"leasedModel";s:18:"Cessna 175 Skylark";}:O:13:"TravelHistory":4:{s:6:"depart";s:16:"Portland Airport";s:6:"arrive";s:19:"Great Falls Airport";s:10:"travelDate";s:10:"2015-04-13";s:11:"leasedModel";s:17:"Cessna Model CR-3";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:16:"McCarran Airport";s:10:"travelDate";s:10:"2015-04-21";s:11:"leasedModel";s:20:"Cessna 165 Airmaster";}:O:13:"TravelHistory":4:{s:6:"depart";s:28:"Detroit Metropolitan Airport";s:6:"arrive";s:30:"Minneapolis Saint Paul Airport";s:10:"travelDate";s:10:"2015-04-13";s:11:"leasedModel";s:20:"Cessna 320 Skyknight";}:O:13:"TravelHistory":4:{s:6:"depart";s:21:"Hays Regional Airport";s:6:"arrive";s:21:"San Francisco Airport";s:10:"travelDate";s:10:"2015-04-13";s:11:"leasedModel";s:21:"Bombardier Learjet 35";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:14:"O Hare Airport";s:10:"travelDate";s:10:"2015-04-28";s:11:"leasedModel";s:17:"Cessna Model CR-2";}:O:13:"TravelHistory":4:{s:6:"depart";s:34:"Hartsfield Jackson Atlanta Airport";s:6:"arrive";s:14:"O Hare Airport";s:10:"travelDate";s:10:"2015-04-28";s:11:"leasedModel";s:25:"Bombardier Challenger 950";}:O:13:"TravelHistory":4:{s:6:"depart";s:36:"George Bush Intercontinental Airport";s:6:"arrive";s:28:"Detroit Metropolitan Airport";s:10:"travelDate";s:10:"2015-04-20";s:11:"leasedModel";s:19:"Cessna 177 Cardinal";}:O:13:"TravelHistory":4:{s:6:"depart";s:28:"Detroit Metropolitan Airport";s:6:"arrive";s:21:"San Francisco Airport";s:10:"travelDate";s:10:"2015-04-27";s:11:"leasedModel";s:19:"Cessna 177 Cardinal";}:O:13:"TravelHistory":4:{s:6:"depart";s:16:"McCarran Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-22";s:11:"leasedModel";s:20:"Cessna 165 Airmaster";}:O:13:"TravelHistory":4:{s:6:"depart";s:21:"San Francisco Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-21";s:11:"leasedModel";s:20:"Cessna 165 Airmaster";}:O:13:"TravelHistory":4:{s:6:"depart";s:25:"Dallas/Fort Worth Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-06";s:11:"leasedModel";s:19:"Cessna 180 Skywagon";}:O:13:"TravelHistory":4:{s:6:"depart";s:25:"Dallas/Fort Worth Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-21";s:11:"leasedModel";s:20:"Cessna 165 Airmaster";}:O:13:"TravelHistory":4:{s:6:"depart";s:36:"George Bush Intercontinental Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-20";s:11:"leasedModel";s:18:"Cessna 175 Skylark";}:O:13:"TravelHistory":4:{s:6:"depart";s:21:"San Francisco Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-13";s:11:"leasedModel";s:19:"Cessna 177 Cardinal";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-21";s:11:"leasedModel";s:19:"Cessna 177 Cardinal";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:25:"Dallas/Fort Worth Airport";s:10:"travelDate";s:10:"2015-04-06";s:11:"leasedModel";s:19:"Cessna 180 Skywagon";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:21:"San Francisco Airport";s:10:"travelDate";s:10:"2015-04-20";s:11:"leasedModel";s:19:"Cessna 177 Cardinal";}:O:13:"TravelHistory":4:{s:6:"depart";s:21:"San Francisco Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-21";s:11:"leasedModel";s:19:"Cessna 177 Cardinal";}}', 0, '', '2015-04-24 01:36:29', 1039.5, 'Cessna 510 Citation Mustang|Los Angeles Airport, Los Angeles, CA|33.948852|-118.408873'),
(81, 'Test', 'Test', 'Test', 'Test', 'MD', '12345', 'default.jpg', 'test', '0987654321', '$2a$10$L7.gU0fPVs0gkpQpsuyp8OkDWat2MYlk9estjHc2i6DuryCxt3zYS', 'C:19:"SplDoublyLinkedList":3596:{i:0;:O:13:"TravelHistory":4:{s:6:"depart";s:21:"San Francisco Airport";s:6:"arrive";s:23:"John F. Kennedy Airport";s:10:"travelDate";s:10:"2015-04-08";s:11:"leasedModel";s:21:"Bombardier Learjet 35";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:21:"San Francisco Airport";s:10:"travelDate";s:10:"2015-04-14";s:11:"leasedModel";s:20:"Cessna 165 Airmaster";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:14:"Denver Airport";s:10:"travelDate";s:10:"2015-04-14";s:11:"leasedModel";s:20:"Cessna 165 Airmaster";}:O:13:"TravelHistory":4:{s:6:"depart";s:14:"Denver Airport";s:6:"arrive";s:25:"Dallas/Fort Worth Airport";s:10:"travelDate";s:10:"2015-04-13";s:11:"leasedModel";s:20:"Cessna 165 Airmaster";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:21:"San Francisco Airport";s:10:"travelDate";s:10:"2015-04-27";s:11:"leasedModel";s:20:"Cessna 210 Centurion";}:O:13:"TravelHistory":4:{s:6:"depart";s:21:"San Francisco Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-20";s:11:"leasedModel";s:20:"Cessna 210 Centurion";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-14";s:11:"leasedModel";s:20:"Cessna 210 Centurion";}:O:13:"TravelHistory":4:{s:6:"depart";s:28:"Idaho Falls Regional Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-26";s:11:"leasedModel";s:18:"Cessna T-50 Bobcat";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:26:"Phoenix Sky Harbor Airport";s:10:"travelDate";s:10:"2015-04-20";s:11:"leasedModel";s:18:"Cessna T-50 Bobcat";}:O:13:"TravelHistory":4:{s:6:"depart";s:14:"Denver Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-22";s:11:"leasedModel";s:17:"Cessna Model CR-1";}:O:13:"TravelHistory":4:{s:6:"depart";s:26:"Phoenix Sky Harbor Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-21";s:11:"leasedModel";s:18:"Cessna T-50 Bobcat";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:16:"Honolulu Airport";s:10:"travelDate";s:10:"2015-04-28";s:11:"leasedModel";s:18:"Cessna T-50 Bobcat";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:14:"O Hare Airport";s:10:"travelDate";s:10:"2015-04-21";s:11:"leasedModel";s:20:"Cessna 320 Skyknight";}:O:13:"TravelHistory":4:{s:6:"depart";s:16:"Honolulu Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-20";s:11:"leasedModel";s:18:"Cessna T-50 Bobcat";}:O:13:"TravelHistory":4:{s:6:"depart";s:16:"Honolulu Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-13";s:11:"leasedModel";s:20:"Cessna 336 Skymaster";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-20";s:11:"leasedModel";s:19:"Cessna 305 Bird Dog";}:O:13:"TravelHistory":4:{s:6:"depart";s:28:"Baltimore Washington Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-13";s:11:"leasedModel";s:27:"Cessna 510 Citation Mustang";}:O:13:"TravelHistory":4:{s:6:"depart";s:14:"Denver Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-20";s:11:"leasedModel";s:19:"Cessna 303 Crusader";}:O:13:"TravelHistory":4:{s:6:"depart";s:14:"O Hare Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-13";s:11:"leasedModel";s:17:"Cessna Model CR-2";}}', 0, '', '2015-04-24 02:23:27', 997.5, ''),
(82, 'test2', 'jhb', 'lhb', 'lkb', 'kj', '97', 'default.jpg', 'test2', '987', '$2a$10$VyIYuv79LuwM7NQ5aYlv/.gMMjeAMzbhj84APau5LRAlFss.vFBc6', 'C:19:"SplDoublyLinkedList":1910:{i:0;:O:13:"TravelHistory":4:{s:6:"depart";s:25:"Dallas/Fort Worth Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-13";s:11:"leasedModel";s:19:"Cessna 180 Skywagon";}:O:13:"TravelHistory":4:{s:6:"depart";s:26:"Phoenix Sky Harbor Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-21";s:11:"leasedModel";s:21:"Cessna 162 Skycatcher";}:O:13:"TravelHistory":4:{s:6:"depart";s:14:"Denver Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-13";s:11:"leasedModel";s:25:"Cessna 205 Super Skywagon";}:O:13:"TravelHistory":4:{s:6:"depart";s:14:"O Hare Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-28";s:11:"leasedModel";s:20:"Cessna 210 Centurion";}:O:13:"TravelHistory":4:{s:6:"depart";s:30:"Minneapolis Saint Paul Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-20";s:11:"leasedModel";s:20:"Cessna 320 Skyknight";}:O:13:"TravelHistory":4:{s:6:"depart";s:20:"Philadelphia Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-13";s:11:"leasedModel";s:23:"Cessna 421 Golden Eagle";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-13";s:11:"leasedModel";s:23:"Cessna 421 Golden Eagle";}:O:13:"TravelHistory":4:{s:6:"depart";s:20:"Philadelphia Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-20";s:11:"leasedModel";s:21:"Cessna 414 Chancellor";}:O:13:"TravelHistory":4:{s:6:"depart";s:14:"Denver Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-14";s:11:"leasedModel";s:19:"Cessna 305 Bird Dog";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:14:"O Hare Airport";s:10:"travelDate";s:10:"2015-04-21";s:11:"leasedModel";s:19:"Cessna 303 Crusader";}}', 0, '', '2015-04-25 05:30:20', 567, 'Cessna Model CR-2|Los Angeles Airport, Los Angeles, CA|33.948852|-118.408873');

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
  `lastCheckout` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `memberWaitList` text
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `planes`
--

INSERT INTO `planes` (`id`, `model`, `status`, `currentLocation`, `client`, `leaseFrom`, `returnTo`, `returnDate`, `lastCheckout`, `memberWaitList`) VALUES
(1, 'Cessna 165 Airmaster', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-04-25 22:05:31', 'C:19:"SplDoublyLinkedList":16:{i:0;:s:4:"test";}'),
(2, 'Cessna 175 Skylark', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-04-25 09:08:50', 'C:19:"SplDoublyLinkedList":4:{i:0;}'),
(3, 'Cessna 177 Cardinal', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-04-25 21:58:33', 'C:19:"SplDoublyLinkedList":4:{i:0;}'),
(4, 'Cessna 180 Skywagon', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-04-25 09:32:22', 'C:19:"SplDoublyLinkedList":4:{i:0;}'),
(5, 'Cessna 162 Skycatcher', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-04-25 19:26:20', 'C:19:"SplDoublyLinkedList":4:{i:0;}'),
(6, 'Cessna 205 Super Skywagon', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-04-25 19:39:18', 'C:19:"SplDoublyLinkedList":4:{i:0;}'),
(7, 'Cessna 210 Centurion', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-04-25 19:49:55', 'C:19:"SplDoublyLinkedList":4:{i:0;}'),
(8, 'Cessna T-50 Bobcat', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-04-25 22:08:43', 'C:19:"SplDoublyLinkedList":4:{i:0;}'),
(9, 'Cessna 336 Skymaster', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-04-25 21:59:54', 'C:19:"SplDoublyLinkedList":4:{i:0;}'),
(10, 'Cessna 421 Golden Eagle', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-04-25 21:59:41', 'C:19:"SplDoublyLinkedList":4:{i:0;}'),
(11, 'Cessna 414 Chancellor', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-04-25 22:01:08', 'C:19:"SplDoublyLinkedList":4:{i:0;}'),
(12, 'Cessna 305 Bird Dog', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-04-25 22:05:42', 'C:19:"SplDoublyLinkedList":4:{i:0;}'),
(13, 'Cessna 510 Citation Mustang', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-04-25 22:30:03', 'C:19:"SplDoublyLinkedList":42:{i:0;:s:17:"tamtran1@umbc.edu";:s:4:"test";}'),
(14, 'Cessna 303 Crusader', 1, 'O Hare Airport, Chicago, IL', '', '', '', '0000-00-00', '2015-04-25 22:34:52', 'C:19:"SplDoublyLinkedList":4:{i:0;}'),
(15, 'Cessna Model CR-1', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-04-25 20:00:54', 'C:19:"SplDoublyLinkedList":4:{i:0;}'),
(16, 'Cessna Model CR-2', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-04-25 22:36:01', 'C:19:"SplDoublyLinkedList":17:{i:0;:s:5:"test2";}'),
(17, 'Cessna Model CR-3', 1, 'Great Falls Airport, Great Falls, MT', '', '', '', '0000-00-00', '2015-04-24 06:13:24', ''),
(18, 'Cessna 172 Skyhawk', 1, 'McCarran Airport, Las Vegas, NV', '', '', '', '0000-00-00', '2015-04-24 05:14:42', ''),
(19, 'Cessna 182 SkyLane', 1, 'Albuquerque Sunport Airport, Albuquerque, NM', '', '', '', '0000-00-00', '2015-04-24 05:48:56', ''),
(20, 'Cessna 320 Skyknight', 1, 'O Hare Airport, Chicago, IL', '', '', '', '0000-00-00', '2015-04-25 21:55:21', 'C:19:"SplDoublyLinkedList":4:{i:0;}'),
(21, 'Bombardier Learjet 35', 1, 'John F. Kennedy Airport, New York, NY', '', '', '', '0000-00-00', '2015-04-24 07:08:17', ''),
(22, 'Bombardier Learjet 40 XR', 1, 'Salt Lake City Airport, Salt Lake, UT	', '', '', '', '0000-00-00', '2015-04-24 03:12:00', ''),
(23, 'Bombardier Learjet 60 XR', 1, 'Miami Airport, Miami, FL', '', '', '', '0000-00-00', '2015-04-24 06:12:45', ''),
(24, 'Bombardier Challenger 605', 1, 'Minneapolis Saint Paul Airport, Minneapolis, MIN', '', '', '', '0000-00-00', '2015-04-24 03:37:57', ''),
(25, 'Bombardier Challenger 850', 1, 'Golden Triangle Regional Airport, Columbus, MS', '', '', '', '0000-00-00', '2015-04-24 05:42:07', ''),
(26, 'Bombardier Challenger 950', 1, 'O Hare Airport, Chicago, IL', '', '', '', '0000-00-00', '2015-04-24 07:03:26', ''),
(27, 'Bombardier Global 5000', 1, 'Washington Dulles Airport, Washington D.C. , VA', '', '', '', '0000-00-00', '2015-04-24 05:48:26', ''),
(28, 'Bombardier Global 6000', 1, 'Philadelphia Airport, Philadelphia, PA', '', '', '', '0000-00-00', '2015-04-24 06:08:13', ''),
(29, 'Dassault Falcon 10', 1, 'Minneapolis Saint Paul Airport, Minneapolis, MIN', '', '', '', '0000-00-00', '2015-04-24 06:08:39', ''),
(30, 'Embraer Phenom 300', 1, 'Rolla National Airport, Rolla, MO', '', '', '', '0000-00-00', '2015-04-24 06:02:18', '');

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
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `customer_profile`
--
ALTER TABLE `customer_profile`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT for table `planes`
--
ALTER TABLE `planes`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
