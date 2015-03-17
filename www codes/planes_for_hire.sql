-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 17, 2015 at 02:45 AM
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
-- Table structure for table `airport_location`
--

CREATE TABLE IF NOT EXISTS `airport_location` (
`id` int(10) unsigned NOT NULL,
  `locName` varchar(10) NOT NULL,
  `long` double NOT NULL,
  `lat` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `zip` int(5) unsigned NOT NULL,
  `avatar` text,
  `email` varchar(30) NOT NULL,
  `phone` int(11) NOT NULL,
  `regDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `travel_history`
--

CREATE TABLE IF NOT EXISTS `travel_history` (
`id` int(10) unsigned NOT NULL,
  `airportName` varchar(10) NOT NULL,
  `long` double NOT NULL,
  `lat` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `airport_location`
--
ALTER TABLE `airport_location`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_profile`
--
ALTER TABLE `customer_profile`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `travel_history`
--
ALTER TABLE `travel_history`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `airport_location`
--
ALTER TABLE `airport_location`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customer_profile`
--
ALTER TABLE `customer_profile`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `travel_history`
--
ALTER TABLE `travel_history`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
