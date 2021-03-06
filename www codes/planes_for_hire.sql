-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2015 at 04:08 PM
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
  `lateFeeDemo` varchar(10) DEFAULT NULL,
  `password` text,
  `lastLogon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_setting`
--

INSERT INTO `admin_setting` (`id`, `lateFee`, `lateFeeDemo`, `password`, `lastLogon`) VALUES
(1, 100.5, 'on', '$2a$10$P675xl1NXV4eA9701grM1Oc6DSVfKXnLdytwvlTkHvPleGirmouYe', '2015-05-09 16:39:23');

-- --------------------------------------------------------

--
-- Table structure for table `airport_locations`
--

CREATE TABLE IF NOT EXISTS `airport_locations` (
`id` int(10) unsigned NOT NULL,
  `airport` text NOT NULL,
  `lat` double NOT NULL,
  `long` double NOT NULL,
  `planeWaitList` text
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `airport_locations`
--

INSERT INTO `airport_locations` (`id`, `airport`, `lat`, `long`, `planeWaitList`) VALUES
(1, 'Los Angeles Airport, Los Angeles, CA', 33.948852, -118.408873, 'C:19:"SplDoublyLinkedList":300:{i:0;:C:19:"SplDoublyLinkedList":50:{i:0;:s:18:"Cessna 175 Skylark";:s:10:"tam@am.tam";}:r:3;:r:3;:C:19:"SplDoublyLinkedList":33:{i:0;:s:20:"Cessna 320 Skyknight";}:r:9;:r:9;:r:3;:r:3;:C:19:"SplDoublyLinkedList":33:{i:0;:s:20:"Cessna 165 Airmaster";}:r:16;:r:16;:r:3;:r:16;:r:16;:r:16;:r:16;:r:3;:r:3;}'),
(2, 'O Hare Airport, Chicago, IL', 41.988199, -87.907321, 'C:19:"SplDoublyLinkedList":251:{i:0;:C:19:"SplDoublyLinkedList":33:{i:0;:s:20:"Cessna 165 Airmaster";}:r:3;:r:3;:r:3;:C:19:"SplDoublyLinkedList":31:{i:0;:s:18:"Cessna 175 Skylark";}:r:9;:C:19:"SplDoublyLinkedList":32:{i:0;:s:19:"Cessna 180 Skywagon";}:r:13;:r:9;:r:13;:r:3;:r:3;:r:3;}'),
(3, 'Dallas/Fort Worth Airport, Dallas/Fort Worth, TX', 32.916815, -97.041708, ''),
(4, 'Denver Airport, Denver, CO', 39.85485, -104.674185, 'C:19:"SplDoublyLinkedList":70:{i:0;:C:19:"SplDoublyLinkedList":33:{i:0;:s:20:"Cessna 165 Airmaster";}}'),
(5, 'John F. Kennedy Airport, New York, NY', 40.643135, -73.779512, ''),
(6, 'San Francisco Airport, San Francisco, CA', 37.623352, -122.379298, ''),
(7, 'Charlotte Douglas Airport, Charlotte, NC', 35.214683, -80.945255, ''),
(8, 'McCarran Airport, Las Vegas, NV', 36.084022, -115.153739, ''),
(9, 'Phoenix Sky Harbor Airport, Phoenix, AZ', 33.437412, -112.008818, ''),
(10, 'Miami Airport, Miami, FL', 25.79602, -80.287389, ''),
(11, 'George Bush Intercontinental Airport, Houston, TX', 29.991707, -95.338843, ''),
(12, 'Newark Liberty Airport, Newark/New York, NJ', 40.691483, -74.174805, ''),
(13, 'Orlando Airport, Orlando, FL', 28.431215, -81.308083, 'C:19:"SplDoublyLinkedList":97:{i:0;:C:19:"SplDoublyLinkedList":55:{i:0;:s:20:"Cessna 165 Airmaster";:s:13:"test@test.com";}:r:3;}'),
(14, 'Seattle Tacoma Airport, Seattle, WA', 47.450134, -122.309159, 'C:19:"SplDoublyLinkedList":100:{i:0;:C:19:"SplDoublyLinkedList":58:{i:0;:s:20:"Cessna 165 Airmaster";:s:16:"sundar@yahoo.com";}:r:3;}'),
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
(30, 'Pierre Regional Airport, Pierre, SD', 44.377832, -100.280123, 'C:19:"SplDoublyLinkedList":104:{i:0;:C:19:"SplDoublyLinkedList":52:{i:0;:s:20:"Cessna 165 Airmaster";:s:10:"tam@am.tam";}:r:3;:r:3;:r:3;}'),
(31, 'North Platte Regional Airport, North Platte, NE', 41.133451, -100.697834, ''),
(32, 'Hays Regional Airport, Hays, KS', 38.863272, -99.264902, ''),
(33, 'Rolla National Airport, Rolla, MO', 38.131859, -91.766052, ''),
(34, 'Golden Triangle Regional Airport, Columbus, MS', 33.454057, -88.589612, ''),
(35, 'Albuquerque Sunport Airport, Albuquerque, NM', 35.043337, -106.612929, ''),
(36, 'Gotham Airport, Gotham City, Gotham', 30.767007, -105.075076, ''),
(37, 'Metropolis Airport, Metropolis City, Metropolis', 42.260367, -117.495118, '');

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
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_profile`
--

INSERT INTO `customer_profile` (`id`, `firstName`, `lastName`, `street`, `city`, `state`, `zip`, `avatar`, `email`, `phone`, `password`, `travelHist`, `checkOutStatus`, `plane`, `regDate`, `balance`, `notification`) VALUES
(80, 'Tam', 'Tran', '1000 Hilltop Circle', 'new york', 'MD', '21250', 'default2.png', 'tamtran1@umbc.edu', '4104551000', '$2a$10$Sa5mUBeaecx2kZsHvex3UuEZSzv69bM7onpFarMAwHWJUYNFpQJXq', 'C:19:"SplDoublyLinkedList":9546:{i:0;:O:13:"TravelHistory":4:{s:6:"depart";s:28:"Detroit Metropolitan Airport";s:6:"arrive";s:30:"Minneapolis Saint Paul Airport";s:10:"travelDate";s:10:"2015-04-13";s:11:"leasedModel";s:20:"Cessna 320 Skyknight";}:O:13:"TravelHistory":4:{s:6:"depart";s:21:"Hays Regional Airport";s:6:"arrive";s:21:"San Francisco Airport";s:10:"travelDate";s:10:"2015-04-13";s:11:"leasedModel";s:21:"Bombardier Learjet 35";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:14:"O Hare Airport";s:10:"travelDate";s:10:"2015-04-28";s:11:"leasedModel";s:17:"Cessna Model CR-2";}:O:13:"TravelHistory":4:{s:6:"depart";s:34:"Hartsfield Jackson Atlanta Airport";s:6:"arrive";s:14:"O Hare Airport";s:10:"travelDate";s:10:"2015-04-28";s:11:"leasedModel";s:25:"Bombardier Challenger 950";}:O:13:"TravelHistory":4:{s:6:"depart";s:36:"George Bush Intercontinental Airport";s:6:"arrive";s:28:"Detroit Metropolitan Airport";s:10:"travelDate";s:10:"2015-04-20";s:11:"leasedModel";s:19:"Cessna 177 Cardinal";}:O:13:"TravelHistory":4:{s:6:"depart";s:28:"Detroit Metropolitan Airport";s:6:"arrive";s:21:"San Francisco Airport";s:10:"travelDate";s:10:"2015-04-27";s:11:"leasedModel";s:19:"Cessna 177 Cardinal";}:O:13:"TravelHistory":4:{s:6:"depart";s:16:"McCarran Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-22";s:11:"leasedModel";s:20:"Cessna 165 Airmaster";}:O:13:"TravelHistory":4:{s:6:"depart";s:21:"San Francisco Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-21";s:11:"leasedModel";s:20:"Cessna 165 Airmaster";}:O:13:"TravelHistory":4:{s:6:"depart";s:25:"Dallas/Fort Worth Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-06";s:11:"leasedModel";s:19:"Cessna 180 Skywagon";}:O:13:"TravelHistory":4:{s:6:"depart";s:25:"Dallas/Fort Worth Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-21";s:11:"leasedModel";s:20:"Cessna 165 Airmaster";}:O:13:"TravelHistory":4:{s:6:"depart";s:36:"George Bush Intercontinental Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-20";s:11:"leasedModel";s:18:"Cessna 175 Skylark";}:O:13:"TravelHistory":4:{s:6:"depart";s:21:"San Francisco Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-13";s:11:"leasedModel";s:19:"Cessna 177 Cardinal";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-21";s:11:"leasedModel";s:19:"Cessna 177 Cardinal";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:25:"Dallas/Fort Worth Airport";s:10:"travelDate";s:10:"2015-04-06";s:11:"leasedModel";s:19:"Cessna 180 Skywagon";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:21:"San Francisco Airport";s:10:"travelDate";s:10:"2015-04-20";s:11:"leasedModel";s:19:"Cessna 177 Cardinal";}:O:13:"TravelHistory":4:{s:6:"depart";s:21:"San Francisco Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-21";s:11:"leasedModel";s:19:"Cessna 177 Cardinal";}:O:13:"TravelHistory":4:{s:6:"depart";s:14:"O Hare Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-05-01";s:11:"leasedModel";s:18:"Cessna 175 Skylark";}:O:13:"TravelHistory":4:{s:6:"depart";s:14:"O Hare Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-05-03";s:11:"leasedModel";s:19:"Cessna 177 Cardinal";}:O:13:"TravelHistory":4:{s:6:"depart";s:14:"O Hare Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-05-04";s:11:"leasedModel";s:19:"Cessna 180 Skywagon";}:O:13:"TravelHistory":4:{s:6:"depart";s:14:"O Hare Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-05-04";s:11:"leasedModel";s:19:"Cessna 180 Skywagon";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-05-01";s:11:"leasedModel";s:20:"Cessna 165 Airmaster";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-05-03";s:11:"leasedModel";s:19:"Cessna 180 Skywagon";}:O:13:"TravelHistory":4:{s:6:"depart";s:14:"O Hare Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-05-12";s:11:"leasedModel";s:21:"Cessna 162 Skycatcher";}:O:13:"TravelHistory":4:{s:6:"depart";s:14:"O Hare Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-05-11";s:11:"leasedModel";s:25:"Cessna 205 Super Skywagon";}:O:13:"TravelHistory":4:{s:6:"depart";s:14:"O Hare Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-05-04";s:11:"leasedModel";s:20:"Cessna 210 Centurion";}:O:13:"TravelHistory":4:{s:6:"depart";s:14:"Denver Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-05-04";s:11:"leasedModel";s:18:"Cessna T-50 Bobcat";}:O:13:"TravelHistory":4:{s:6:"depart";s:14:"O Hare Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-05-18";s:11:"leasedModel";s:20:"Cessna 336 Skymaster";}:O:13:"TravelHistory":4:{s:6:"depart";s:14:"O Hare Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-05-04";s:11:"leasedModel";s:19:"Cessna 303 Crusader";}:O:13:"TravelHistory":4:{s:6:"depart";s:14:"O Hare Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-05-11";s:11:"leasedModel";s:17:"Cessna Model CR-2";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:14:"O Hare Airport";s:10:"travelDate";s:10:"2015-05-11";s:11:"leasedModel";s:20:"Cessna 165 Airmaster";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:14:"O Hare Airport";s:10:"travelDate";s:10:"2015-05-11";s:11:"leasedModel";s:18:"Cessna 175 Skylark";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:14:"O Hare Airport";s:10:"travelDate";s:10:"2015-05-11";s:11:"leasedModel";s:19:"Cessna 177 Cardinal";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:14:"O Hare Airport";s:10:"travelDate";s:10:"2015-05-11";s:11:"leasedModel";s:19:"Cessna 180 Skywagon";}:O:13:"TravelHistory":4:{s:6:"depart";s:14:"O Hare Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-05-04";s:11:"leasedModel";s:19:"Cessna 180 Skywagon";}:O:13:"TravelHistory":4:{s:6:"depart";s:14:"O Hare Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-05-11";s:11:"leasedModel";s:20:"Cessna 165 Airmaster";}:O:13:"TravelHistory":4:{s:6:"depart";s:14:"O Hare Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-05-11";s:11:"leasedModel";s:18:"Cessna 175 Skylark";}:O:13:"TravelHistory":4:{s:6:"depart";s:14:"O Hare Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-05-11";s:11:"leasedModel";s:19:"Cessna 177 Cardinal";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:14:"O Hare Airport";s:10:"travelDate";s:10:"2015-05-11";s:11:"leasedModel";s:20:"Cessna 165 Airmaster";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:14:"O Hare Airport";s:10:"travelDate";s:10:"2015-05-25";s:11:"leasedModel";s:18:"Cessna 175 Skylark";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:14:"O Hare Airport";s:10:"travelDate";s:10:"2015-05-04";s:11:"leasedModel";s:19:"Cessna 177 Cardinal";}:O:13:"TravelHistory":4:{s:6:"depart";s:14:"O Hare Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-05-11";s:11:"leasedModel";s:20:"Cessna 165 Airmaster";}:O:13:"TravelHistory":4:{s:6:"depart";s:14:"O Hare Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-05-04";s:11:"leasedModel";s:18:"Cessna 175 Skylark";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:14:"O Hare Airport";s:10:"travelDate";s:10:"2015-05-11";s:11:"leasedModel";s:20:"Cessna 165 Airmaster";}:O:13:"TravelHistory":4:{s:6:"depart";s:14:"O Hare Airport";s:6:"arrive";s:14:"Denver Airport";s:10:"travelDate";s:10:"2015-05-11";s:11:"leasedModel";s:20:"Cessna 165 Airmaster";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:14:"O Hare Airport";s:10:"travelDate";s:10:"2015-05-04";s:11:"leasedModel";s:18:"Cessna 175 Skylark";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:14:"O Hare Airport";s:10:"travelDate";s:10:"2015-05-04";s:11:"leasedModel";s:19:"Cessna 180 Skywagon";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:14:"O Hare Airport";s:10:"travelDate";s:10:"2015-05-18";s:11:"leasedModel";s:21:"Cessna 162 Skycatcher";}:O:13:"TravelHistory":4:{s:6:"depart";s:14:"O Hare Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-05-11";s:11:"leasedModel";s:20:"Cessna 320 Skyknight";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:14:"O Hare Airport";s:10:"travelDate";s:10:"2015-05-18";s:11:"leasedModel";s:20:"Cessna 320 Skyknight";}:O:13:"TravelHistory":4:{s:6:"depart";s:14:"Denver Airport";s:6:"arrive";s:14:"O Hare Airport";s:10:"travelDate";s:10:"2015-05-05";s:11:"leasedModel";s:20:"Cessna 165 Airmaster";}:O:13:"TravelHistory":4:{s:6:"depart";s:14:"O Hare Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-05-12";s:11:"leasedModel";s:20:"Cessna 165 Airmaster";}}', 0, '', '2015-04-24 01:36:29', 1039.5, ''),
(81, 'Test2', 'Test', 'Test', 'Test', 'TE', '09832', 'plane.jpg', 'test@test.com', '0029830498', '$2a$10$P7bzLA3q7MTWe6ikdCbty.Wz0GS.OzsjVWy8/8r1X.0moWZTAZzHW', 'C:19:"SplDoublyLinkedList":6130:{i:0;:O:13:"TravelHistory":4:{s:6:"depart";s:21:"San Francisco Airport";s:6:"arrive";s:23:"John F. Kennedy Airport";s:10:"travelDate";s:10:"2015-04-08";s:11:"leasedModel";s:21:"Bombardier Learjet 35";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:21:"San Francisco Airport";s:10:"travelDate";s:10:"2015-04-14";s:11:"leasedModel";s:20:"Cessna 165 Airmaster";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:14:"Denver Airport";s:10:"travelDate";s:10:"2015-04-14";s:11:"leasedModel";s:20:"Cessna 165 Airmaster";}:O:13:"TravelHistory":4:{s:6:"depart";s:14:"Denver Airport";s:6:"arrive";s:25:"Dallas/Fort Worth Airport";s:10:"travelDate";s:10:"2015-04-13";s:11:"leasedModel";s:20:"Cessna 165 Airmaster";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:21:"San Francisco Airport";s:10:"travelDate";s:10:"2015-04-27";s:11:"leasedModel";s:20:"Cessna 210 Centurion";}:O:13:"TravelHistory":4:{s:6:"depart";s:21:"San Francisco Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-20";s:11:"leasedModel";s:20:"Cessna 210 Centurion";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-14";s:11:"leasedModel";s:20:"Cessna 210 Centurion";}:O:13:"TravelHistory":4:{s:6:"depart";s:28:"Idaho Falls Regional Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-26";s:11:"leasedModel";s:18:"Cessna T-50 Bobcat";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:26:"Phoenix Sky Harbor Airport";s:10:"travelDate";s:10:"2015-04-20";s:11:"leasedModel";s:18:"Cessna T-50 Bobcat";}:O:13:"TravelHistory":4:{s:6:"depart";s:14:"Denver Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-22";s:11:"leasedModel";s:17:"Cessna Model CR-1";}:O:13:"TravelHistory":4:{s:6:"depart";s:26:"Phoenix Sky Harbor Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-21";s:11:"leasedModel";s:18:"Cessna T-50 Bobcat";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:16:"Honolulu Airport";s:10:"travelDate";s:10:"2015-04-28";s:11:"leasedModel";s:18:"Cessna T-50 Bobcat";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:14:"O Hare Airport";s:10:"travelDate";s:10:"2015-04-21";s:11:"leasedModel";s:20:"Cessna 320 Skyknight";}:O:13:"TravelHistory":4:{s:6:"depart";s:16:"Honolulu Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-20";s:11:"leasedModel";s:18:"Cessna T-50 Bobcat";}:O:13:"TravelHistory":4:{s:6:"depart";s:16:"Honolulu Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-13";s:11:"leasedModel";s:20:"Cessna 336 Skymaster";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-20";s:11:"leasedModel";s:19:"Cessna 305 Bird Dog";}:O:13:"TravelHistory":4:{s:6:"depart";s:28:"Baltimore Washington Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-13";s:11:"leasedModel";s:27:"Cessna 510 Citation Mustang";}:O:13:"TravelHistory":4:{s:6:"depart";s:14:"Denver Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-20";s:11:"leasedModel";s:19:"Cessna 303 Crusader";}:O:13:"TravelHistory":4:{s:6:"depart";s:14:"O Hare Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-13";s:11:"leasedModel";s:17:"Cessna Model CR-2";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:14:"O Hare Airport";s:10:"travelDate";s:10:"2015-04-29";s:11:"leasedModel";s:20:"Cessna 165 Airmaster";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:4:"test";s:10:"travelDate";s:10:"2015-04-29";s:11:"leasedModel";s:18:"Cessna 175 Skylark";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:5:"sjdhb";s:10:"travelDate";s:10:"2015-04-29";s:11:"leasedModel";s:18:"Cessna 175 Skylark";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:5:"sfbjb";s:10:"travelDate";s:10:"2015-04-29";s:11:"leasedModel";s:23:"Cessna 421 Golden Eagle";}:O:13:"TravelHistory":4:{s:6:"depart";s:14:"O Hare Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-29";s:11:"leasedModel";s:20:"Cessna 165 Airmaster";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-29";s:11:"leasedModel";s:8:"testtest";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:14:"O Hare Airport";s:10:"travelDate";s:10:"2015-04-29";s:11:"leasedModel";s:17:"Cessna Model CR-2";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:14:"O Hare Airport";s:10:"travelDate";s:10:"2015-04-29";s:11:"leasedModel";s:4:"test";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:25:"Dallas/Fort Worth Airport";s:10:"travelDate";s:10:"2015-04-29";s:11:"leasedModel";s:20:"Cessna 165 Airmaster";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:14:"O Hare Airport";s:10:"travelDate";s:10:"2015-04-30";s:11:"leasedModel";s:19:"Cessna 177 Cardinal";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:14:"O Hare Airport";s:10:"travelDate";s:10:"2015-04-30";s:11:"leasedModel";s:19:"Cessna 180 Skywagon";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:14:"Denver Airport";s:10:"travelDate";s:10:"2015-04-07";s:11:"leasedModel";s:18:"Cessna T-50 Bobcat";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:14:"O Hare Airport";s:10:"travelDate";s:10:"2015-04-30";s:11:"leasedModel";s:20:"Cessna 336 Skymaster";}:O:13:"TravelHistory":4:{s:6:"depart";s:25:"Dallas/Fort Worth Airport";s:6:"arrive";s:19:"Los Angeles Airport";s:10:"travelDate";s:10:"2015-04-30";s:11:"leasedModel";s:20:"Cessna 165 Airmaster";}}', 0, '', '2015-04-24 02:23:27', 1140.5, ''),
(88, 'Bruce', 'Wayne', '101 Dark Place', 'Gotham City', 'GO', '00001', 'tumblr_lbjzd23fss1qbzf0vo1_r1_500.gif', 'Batman@Batman.edu', '0010010001', '$2a$10$t4VeA9PVj3n0WHkh7WaDWuD64cTy0h/8/h91.tFD5BxxC1rCByuJS', 'C:19:"SplDoublyLinkedList":4:{i:0;}', 0, '', '2015-05-09 17:08:14', 0, ''),
(89, 'Clark', 'Kent', 'Superman Alley', 'Metropolis', 'ME', '10101', 'tumblr_m7j5b3OhAp1qkd0zgo9_r1_500.gif', 'Superman@manofsteel.com', '1001001000', '$2a$10$dADoi3IXZbYyXKycI7jy2uPWEYbF2v0em1mw4x15e/Xb6BD39168a', 'C:19:"SplDoublyLinkedList":4:{i:0;}', 0, '', '2015-05-09 18:16:33', 0, ''),
(90, 'Sundar', 'Sekar', 'UMBC Hilltop', 'Baltimore', 'MD', '21250', '2015-Lamborghini-Huracan-LP-610-4-Red-Wallpaper.jpg', 'sundar@yahoo.com', '1010101000', '$2a$10$VpfqBl5/TCOKyqzj93YaJOe8rVoISQKsUbL5FcOSzFXu4VkCLVLg.', 'C:19:"SplDoublyLinkedList":2500:{i:0;:O:13:"TravelHistory":4:{s:6:"depart";s:16:"McCarran Airport";s:6:"arrive";s:14:"O Hare Airport";s:10:"travelDate";s:10:"2015-05-09";s:11:"leasedModel";s:18:"Cessna 172 Skyhawk";}:O:13:"TravelHistory":4:{s:6:"depart";s:13:"Miami Airport";s:6:"arrive";s:28:"Detroit Metropolitan Airport";s:10:"travelDate";s:10:"2015-05-01";s:11:"leasedModel";s:24:"Bombardier Learjet 60 XR";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:22:"Salt Lake City Airport";s:10:"travelDate";s:10:"2015-05-11";s:11:"leasedModel";s:17:"Cessna Model CR-2";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:29:"North Platte Regional Airport";s:10:"travelDate";s:10:"2015-05-11";s:11:"leasedModel";s:17:"Cessna Model CR-1";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:34:"Hartsfield Jackson Atlanta Airport";s:10:"travelDate";s:10:"2015-05-11";s:11:"leasedModel";s:19:"Cessna 303 Crusader";}:O:13:"TravelHistory":4:{s:6:"depart";s:25:"Washington Dulles Airport";s:6:"arrive";s:25:"Dallas/Fort Worth Airport";s:10:"travelDate";s:10:"2015-05-11";s:11:"leasedModel";s:22:"Bombardier Global 5000";}:O:13:"TravelHistory":4:{s:6:"depart";s:20:"Philadelphia Airport";s:6:"arrive";s:25:"Washington Dulles Airport";s:10:"travelDate";s:10:"2015-05-11";s:11:"leasedModel";s:22:"Bombardier Global 6000";}:O:13:"TravelHistory":4:{s:6:"depart";s:20:"Philadelphia Airport";s:6:"arrive";s:25:"Washington Dulles Airport";s:10:"travelDate";s:10:"2015-05-11";s:11:"leasedModel";s:22:"Bombardier Global 6000";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:16:"Portland Airport";s:10:"travelDate";s:10:"2015-05-11";s:11:"leasedModel";s:27:"Cessna 510 Citation Mustang";}:O:13:"TravelHistory":4:{s:6:"depart";s:19:"Los Angeles Airport";s:6:"arrive";s:27:"Albuquerque Sunport Airport";s:10:"travelDate";s:10:"2015-05-11";s:11:"leasedModel";s:19:"Cessna 305 Bird Dog";}:O:13:"TravelHistory":4:{s:6:"depart";s:14:"O Hare Airport";s:6:"arrive";s:13:"Miami Airport";s:10:"travelDate";s:10:"2015-05-11";s:11:"leasedModel";s:25:"Bombardier Challenger 950";}:O:13:"TravelHistory":4:{s:6:"depart";s:14:"O Hare Airport";s:6:"arrive";s:13:"Miami Airport";s:10:"travelDate";s:10:"2015-05-11";s:11:"leasedModel";s:25:"Bombardier Challenger 950";}:O:13:"TravelHistory":4:{s:6:"depart";s:14:"O Hare Airport";s:6:"arrive";s:14:"Denver Airport";s:10:"travelDate";s:10:"2015-05-11";s:11:"leasedModel";s:20:"Cessna 320 Skyknight";}}', 0, '', '2015-05-09 18:22:00', 804, '');

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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `planes`
--

INSERT INTO `planes` (`id`, `model`, `status`, `currentLocation`, `client`, `leaseFrom`, `returnTo`, `returnDate`, `lastCheckout`) VALUES
(1, 'Cessna 165 Airmaster', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-05-08 17:43:33'),
(2, 'Cessna 175 Skylark', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-05-11 14:02:37'),
(3, 'Cessna 177 Cardinal', 1, 'O Hare Airport, Chicago, IL', '', '', '', '0000-00-00', '2015-05-01 07:05:13'),
(4, 'Cessna 180 Skywagon', 1, 'O Hare Airport, Chicago, IL', '', '', '', '0000-00-00', '2015-05-01 07:16:09'),
(5, 'Cessna 162 Skycatcher', 1, 'O Hare Airport, Chicago, IL', '', '', '', '0000-00-00', '2015-05-01 07:16:42'),
(6, 'Cessna 205 Super Skywagon', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-05-08 17:18:56'),
(7, 'Cessna 210 Centurion', 1, 'O Hare Airport, Chicago, IL', '', '', '', '0000-00-00', '2015-05-08 17:20:40'),
(8, 'Cessna T-50 Bobcat', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-05-01 06:28:03'),
(9, 'Cessna 336 Skymaster', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-05-01 06:36:00'),
(10, 'Cessna 421 Golden Eagle', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-04-29 08:15:18'),
(11, 'Cessna 414 Chancellor', 1, 'Los Angeles Airport, Los Angeles, CA', '', '', '', '0000-00-00', '2015-05-01 00:09:49'),
(12, 'Cessna 305 Bird Dog', 1, 'Albuquerque Sunport Airport, Albuquerque, NM', '', '', '', '0000-00-00', '2015-05-11 14:05:05'),
(13, 'Cessna 510 Citation Mustang', 1, 'Portland Airport, Portland, OR', '', '', '', '0000-00-00', '2015-05-11 14:04:48'),
(14, 'Cessna 303 Crusader', 1, 'Hartsfield Jackson Atlanta Airport, Atlanta, GA', '', '', '', '0000-00-00', '2015-05-11 14:03:15'),
(15, 'Cessna Model CR-1', 1, 'North Platte Regional Airport, North Platte, NE', '', '', '', '0000-00-00', '2015-05-11 14:00:19'),
(16, 'Cessna Model CR-2', 1, 'Salt Lake City Airport, Salt Lake, UT	', '', '', '', '0000-00-00', '2015-05-11 14:00:01'),
(17, 'Cessna Model CR-3', 1, 'Great Falls Airport, Great Falls, MT', '', '', '', '0000-00-00', '2015-04-30 06:44:10'),
(18, 'Cessna 172 Skyhawk', 1, 'O Hare Airport, Chicago, IL', '', '', '', '0000-00-00', '2015-05-09 16:40:21'),
(19, 'Cessna 182 SkyLane', 1, 'O Hare Airport, Chicago, IL', '', '', '', '0000-00-00', '2015-05-08 17:02:10'),
(20, 'Cessna 320 Skyknight', 1, 'Denver Airport, Denver, CO', '', '', '', '0000-00-00', '2015-05-11 14:06:54'),
(21, 'Bombardier Learjet 35', 1, 'John F. Kennedy Airport, New York, NY', '', '', '', '0000-00-00', '2015-04-24 07:08:17'),
(22, 'Bombardier Learjet 40 XR', 1, 'Minneapolis Saint Paul Airport, Minneapolis, MIN', '', '', '', '0000-00-00', '2015-05-08 17:45:47'),
(23, 'Bombardier Learjet 60 XR', 1, 'Detroit Metropolitan Airport, Detroit, MI', '', '', '', '0000-00-00', '2015-05-09 16:40:41'),
(24, 'Bombardier Challenger 605', 1, 'Great Falls Airport, Great Falls, MT', '', '', '', '0000-00-00', '2015-05-08 17:19:56'),
(25, 'Bombardier Challenger 850', 1, 'Golden Triangle Regional Airport, Columbus, MS', '', '', '', '0000-00-00', '2015-04-24 05:42:07'),
(26, 'Bombardier Challenger 950', 1, 'Miami Airport, Miami, FL', '', '', '', '0000-00-00', '2015-05-11 14:06:07'),
(27, 'Bombardier Global 5000', 1, 'Dallas/Fort Worth Airport, Dallas/Fort Worth, TX', '', '', '', '0000-00-00', '2015-05-11 14:03:43'),
(28, 'Bombardier Global 6000', 1, 'Washington Dulles Airport, Washington D.C. , VA', '', '', '', '0000-00-00', '2015-05-11 14:04:05'),
(29, 'Dassault Falcon 10', 1, 'Minneapolis Saint Paul Airport, Minneapolis, MIN', '', '', '', '0000-00-00', '2015-04-24 06:08:39'),
(30, 'Embraer Phenom 300', 1, 'Rolla National Airport, Rolla, MO', '', '', '', '0000-00-00', '2015-04-24 06:02:18'),
(31, 'The BatPlane', 1, 'Gotham Airport, Gotham City, Gotham', '', '', '', '0000-00-00', '2015-04-24 06:02:18'),
(32, 'Man Of Steel', 1, 'Metropolis Airport, Metropolis City, Metropolis', '', '', '', '0000-00-00', '2015-04-24 06:02:18');

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
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `customer_profile`
--
ALTER TABLE `customer_profile`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT for table `planes`
--
ALTER TABLE `planes`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
