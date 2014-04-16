-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 16, 2014 at 10:34 AM
-- Server version: 5.1.53
-- PHP Version: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mysql_barhop`
--
CREATE DATABASE `mysql_barhop` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `mysql_barhop`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_area`
--

CREATE TABLE IF NOT EXISTS `tbl_area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_area`
--

INSERT INTO `tbl_area` (`id`, `name`) VALUES
(1, 'Taguig'),
(2, 'Makati'),
(4, 'Quezon City');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barinfo`
--

CREATE TABLE IF NOT EXISTS `tbl_barinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `area_id` int(11) NOT NULL,
  `Category` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `daysOpen` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `maleCount` int(11) NOT NULL,
  `femaleCount` int(11) NOT NULL,
  `contactNumber` int(11) NOT NULL,
  `mapUrl` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `lastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tbl_barinfo`
--

INSERT INTO `tbl_barinfo` (`id`, `name`, `area_id`, `Category`, `image`, `address`, `daysOpen`, `maleCount`, `femaleCount`, `contactNumber`, `mapUrl`, `lastUpdate`, `deleted`) VALUES
(1, 'Hyve', 1, '', '', '', '', 50, 21, 0, '', '2014-03-31 00:54:31', 0),
(2, 'Prive', 1, '', '', '', '', 22, 30, 0, '', '2014-04-10 12:40:16', 0),
(3, 'Imperial', 1, '', '', '', '', 41, 100, 0, '', '2014-04-11 22:23:48', 0),
(4, 'Urbn', 1, '', '', '', '', 0, 0, 0, '', '2014-04-10 12:40:49', 0),
(5, 'Aracama', 1, '', '', '', '', 0, 0, 0, '', '2014-04-10 12:40:49', 0),
(6, 'Haze', 1, '', '', '', '', 0, 0, 0, '', '2014-04-10 12:41:06', 0),
(7, 'Black Market', 2, '', '', '', '', 0, 0, 0, '', '2014-04-10 12:41:49', 0),
(8, '71 Gramercy', 2, '', '', '', '', 0, 0, 0, '', '2014-04-10 12:41:49', 0),
(9, 'Palladium', 2, '', '', '', '', 0, 0, 0, '', '2014-04-10 12:42:17', 0),
(10, 'Club Icon', 2, '', '', '', '', 0, 0, 0, '', '2014-04-10 12:42:17', 0),
(11, 'Dragon', 4, '', '', '', '', 0, 0, 0, '', '2014-04-10 12:44:22', 0),
(12, 'Prime', 4, '', '', '', '', 0, 0, 0, '', '2014-04-10 12:44:27', 0),
(13, 'Vanity', 4, '', '', '', '', 0, 0, 0, '', '2014-04-10 12:44:31', 0),
(14, 'Space', 4, '', '', '', '', 0, 0, 0, '', '2014-04-10 12:44:39', 0),
(15, 'Excess', 4, '', '', '', '', 0, 0, 0, '', '2014-04-10 12:44:35', 0),
(16, 'Guilly''s', 4, '', '', '', '', 0, 0, 0, '', '2014-04-10 12:44:43', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_level`
--

CREATE TABLE IF NOT EXISTS `tbl_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aliasName` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `expNeeded` int(11) NOT NULL,
  `maxStamina` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_level`
--

INSERT INTO `tbl_level` (`id`, `aliasName`, `expNeeded`, `maxStamina`) VALUES
(1, 'Novice', 100, 100),
(2, 'Rookie', 200, 120),
(3, 'Admiral', 500, 140),
(4, 'Master', 1000, 150);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mingle`
--

CREATE TABLE IF NOT EXISTS `tbl_mingle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `user_token` int(11) NOT NULL,
  `receiver_token` int(11) NOT NULL,
  `lastUpdate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `tbl_mingle`
--

INSERT INTO `tbl_mingle` (`id`, `user_id`, `receiver_id`, `user_token`, `receiver_token`, `lastUpdate`, `deleted`) VALUES
(26, 9, 1, 0, 0, '2014-04-12 03:32:43', 0),
(24, 9, 4, 0, 0, '2014-04-10 01:43:15', 0),
(21, 3, 4, 0, 0, '0000-00-00 00:00:00', 0),
(22, 4, 3, 0, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_minglearea`
--

CREATE TABLE IF NOT EXISTS `tbl_minglearea` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_minglearea`
--

INSERT INTO `tbl_minglearea` (`id`, `area`) VALUES
(1, 'Entrance'),
(2, 'Exit'),
(3, 'Near the comfort room'),
(4, 'At the counter');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status`
--

CREATE TABLE IF NOT EXISTS `tbl_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_status`
--

INSERT INTO `tbl_status` (`id`, `status`) VALUES
(1, 'Really, not in the mood'),
(2, 'Currently having fun with my friends'),
(3, 'I feel like dancing with someone'),
(4, 'I''m not quite sure yet'),
(5, 'Very much ready to Mingle');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `userlog_id` int(11) NOT NULL,
  `lvl_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `currentBar_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_user`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_usercurrentbar`
--

CREATE TABLE IF NOT EXISTS `tbl_usercurrentbar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `bar_id` int(11) DEFAULT NULL,
  `entryStatus` int(11) NOT NULL,
  `lastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_usercurrentbar`
--

INSERT INTO `tbl_usercurrentbar` (`id`, `user_id`, `bar_id`, `entryStatus`, `lastUpdate`) VALUES
(1, 1, 3, 1, '2014-04-12 02:24:10'),
(3, 3, 3, 1, '2014-04-01 22:05:08'),
(4, 4, 3, 0, '2014-04-12 02:24:05'),
(6, 8, 3, 0, '2014-04-12 02:24:02'),
(7, 9, 3, 1, '2014-04-09 21:59:23'),
(9, 11, 3, 0, '2014-04-12 02:23:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_userinfo`
--

CREATE TABLE IF NOT EXISTS `tbl_userinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `log_id` int(11) NOT NULL,
  `lvl_id` int(11) NOT NULL,
  `rfidTag` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `gender` text COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `currentExp` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `stamina` int(11) NOT NULL,
  `nextRefresh` date NOT NULL,
  `image` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `lastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rfidTag` (`rfidTag`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_userinfo`
--

INSERT INTO `tbl_userinfo` (`id`, `log_id`, `lvl_id`, `rfidTag`, `gender`, `email`, `currentExp`, `status_id`, `stamina`, `nextRefresh`, `image`, `lastUpdate`, `deleted`) VALUES
(1, 1, 1, '0001', 'Male', 'lrgbairan@gmail.com', 99, 5, 100, '2014-04-13', '1.jpg', '2014-04-12 18:48:27', 0),
(3, 3, 3, '0003', 'Male', 'emman@gmail.com', 50, 1, 140, '2014-04-12', '3.jpg', '2014-04-12 02:49:51', 0),
(4, 4, 1, '0004', 'Male', 'marvin@gmail.com', 100, 5, 0, '2014-04-12', '4.jpg', '2014-04-12 02:49:55', 0),
(8, 18, 1, '0005', 'Male', 'bairan@gmail.com', 0, 2, 0, '0000-00-00', '8.jpg', '2014-04-12 02:50:03', 0),
(9, 19, 1, '1010101016', 'male', 'naughtyson@gmail.com', 80, 5, 100, '2014-04-17', '9.jpg', '2014-04-16 15:22:37', 0),
(11, 22, 1, '1010101099', 'male', 'lrgbairan@gmail.com', 0, 1, 100, '2014-04-12', '11.jpg', '2014-04-12 02:50:18', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_userlog`
--

CREATE TABLE IF NOT EXISTS `tbl_userlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `tbl_userlog`
--

INSERT INTO `tbl_userlog` (`id`, `username`, `password`) VALUES
(1, 'superkidluigi', 'a'),
(3, 'emman', 'deiparine'),
(4, 'marvin', 'haduca'),
(18, 'bairan', 'b'),
(19, 'naughtyson', 'naughtyson'),
(22, 'lrgbairan', 'protos');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_usercurrentbar`
--
ALTER TABLE `tbl_usercurrentbar`
  ADD CONSTRAINT `tbl_usercurrentbar_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `tbl_userinfo` (`id`) ON DELETE CASCADE;
