-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 30, 2014 at 09:01 AM
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
  `category` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `daysOpen` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `budget` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `entranceFee` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `popular` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `maleCount` int(11) NOT NULL,
  `femaleCount` int(11) NOT NULL,
  `contactNumber` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `mapUrl` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `lastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tbl_barinfo`
--

INSERT INTO `tbl_barinfo` (`id`, `name`, `area_id`, `category`, `image`, `address`, `description`, `daysOpen`, `budget`, `entranceFee`, `popular`, `maleCount`, `femaleCount`, `contactNumber`, `mapUrl`, `lastUpdate`, `deleted`) VALUES
(1, 'Hyve', 1, '', '', '', '', '', '', '', '', 51, 21, '0', '', '2014-04-30 00:48:35', 0),
(2, 'Prive', 1, '', '', '', '', '', '', '', '', 22, 30, '0', '', '2014-04-10 12:40:16', 0),
(3, 'Imperial', 1, 'Club, Ice Bar', 'imperial.jpg', 'Unit D, The Fort Entertainment Center, 28th Street Corner 5th, BGC, Taguig City ', 'Imperial is a high class bar that provides its customers with an icy feel inside', 'Mon - Thu: 9:00 pm - 4:00 am, Fri - Sat: 9:00 pm - 5:30 am', 'P500 - P750', 'P500', 'Ice Bar environment', 41, 100, '0917-542-8831', '', '2014-04-17 11:23:55', 0),
(4, 'Urbn', 1, '', '', '', '', '', '', '', '', 0, 0, '0', '', '2014-04-10 12:40:49', 0),
(5, 'Aracama', 1, '', '', '', '', '', '', '', '', 0, 0, '0', '', '2014-04-10 12:40:49', 0),
(6, 'Haze', 1, '', '', '', '', '', '', '', '', 0, 0, '0', '', '2014-04-10 12:41:06', 0),
(7, 'Black Market', 2, '', '', '', '', '', '', '', '', 0, 0, '0', '', '2014-04-10 12:41:49', 0),
(8, '71 Gramercy', 2, '', '', '', '', '', '', '', '', 0, 0, '0', '', '2014-04-10 12:41:49', 0),
(9, 'Palladium', 2, '', '', '', '', '', '', '', '', 0, 0, '0', '', '2014-04-10 12:42:17', 0),
(10, 'Club Icon', 2, '', '', '', '', '', '', '', '', 0, 0, '0', '', '2014-04-10 12:42:17', 0),
(11, 'Dragon', 4, '', '', '', '', '', '', '', '', 0, 0, '0', '', '2014-04-10 12:44:22', 0),
(12, 'Prime', 4, '', '', '', '', '', '', '', '', 0, 0, '0', '', '2014-04-10 12:44:27', 0),
(13, 'Vanity', 4, '', '', '', '', '', '', '', '', 0, 0, '0', '', '2014-04-10 12:44:31', 0),
(14, 'Space', 4, '', '', '', '', '', '', '', '', 0, 0, '0', '', '2014-04-10 12:44:39', 0),
(15, 'Excess', 4, '', '', '', '', '', '', '', '', 0, 0, '0', '', '2014-04-10 12:44:35', 0),
(16, 'Guilly''s', 4, '', '', '', '', '', '', '', '', 0, 0, '0', '', '2014-04-10 12:44:43', 0);

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
(26, 3, 1, 0, 0, '2014-04-26 13:30:03', 0),
(24, 4, 3, 0, 0, '2014-04-26 13:30:07', 0),
(21, 2, 3, 0, 0, '2014-04-26 13:30:13', 0),
(22, 3, 2, 0, 0, '2014-04-26 13:30:17', 0);

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
-- Table structure for table `tbl_promoterlog`
--

CREATE TABLE IF NOT EXISTS `tbl_promoterlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `bar_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_promoterlog`
--

INSERT INTO `tbl_promoterlog` (`id`, `username`, `password`, `bar_id`) VALUES
(1, 'Hyve', 'Hyve', 1),
(2, 'Imperial', '2', 3);

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
-- Table structure for table `tbl_taglist`
--

CREATE TABLE IF NOT EXISTS `tbl_taglist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rfidTag` varchar(128) NOT NULL,
  `unique_id` varchar(4) NOT NULL,
  `isRegistered` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_taglist`
--

INSERT INTO `tbl_taglist` (`id`, `rfidTag`, `unique_id`, `isRegistered`) VALUES
(1, '0000000001', '0ABC', 1),
(2, '0000000002', 'BSD2', 1),
(3, '0000000003', 'SDS2', 1),
(4, '0000000004', 'ASW6', 1),
(5, '0000000005', '00A2', 1),
(6, '0000000006', '123A', 1),
(7, '0000000007', 'LKI2', 1),
(8, '0000000008', '090T', 0),
(9, '0000000009', 'BJU3', 0),
(10, '0000000010', '3Y57', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tbl_usercurrentbar`
--

INSERT INTO `tbl_usercurrentbar` (`id`, `user_id`, `bar_id`, `entryStatus`, `lastUpdate`) VALUES
(1, 1, 3, 1, '2014-04-30 15:33:15'),
(3, 2, 3, 1, '2014-04-26 13:29:31'),
(4, 3, 3, 1, '2014-04-30 15:26:46'),
(6, 4, 3, 1, '2014-04-30 15:26:50'),
(7, 5, 0, 0, '2014-04-30 15:27:10'),
(9, 6, 3, 1, '2014-04-30 15:26:56'),
(12, 11, 0, 0, '2014-04-26 14:46:04');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_userinfo`
--

CREATE TABLE IF NOT EXISTS `tbl_userinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rfid` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `log_id` int(11) NOT NULL,
  `lvl_id` int(11) NOT NULL,
  `gender` text COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `currentExp` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `status` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `stamina` int(11) NOT NULL,
  `nextRefresh` date NOT NULL,
  `image` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `lastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_userinfo`
--

INSERT INTO `tbl_userinfo` (`id`, `rfid`, `log_id`, `lvl_id`, `gender`, `email`, `currentExp`, `status_id`, `status`, `stamina`, `nextRefresh`, `image`, `lastUpdate`, `deleted`) VALUES
(1, '0000000001', 1, 1, 'Male', 'lrgbairan@gmail.com', 99, 2, 'Live life to the fullest', 100, '2014-05-01', '1.jpg', '2014-04-30 16:59:39', 0),
(2, '0000000002', 3, 3, 'Male', 'emman@gmail.com', 50, 1, '', 140, '2014-04-12', '3.jpg', '2014-04-26 13:29:00', 0),
(3, '0000000003', 4, 1, 'Male', 'marvin@gmail.com', 100, 2, '', 0, '2014-04-12', '4.jpg', '2014-04-26 13:29:05', 0),
(4, '0000000004', 18, 1, 'Male', 'bairan@gmail.com', 0, 2, '', 0, '0000-00-00', '8.jpg', '2014-04-26 13:29:10', 0),
(5, '0000000005', 19, 1, 'male', 'naughtyson@gmail.com', 80, 2, '', 100, '2014-04-23', '9.jpg', '2014-04-26 13:29:14', 0),
(6, '0000000006', 22, 1, 'male', 'lrgbairan@gmail.com', 0, 1, '', 100, '2014-04-12', '11.jpg', '2014-04-26 13:29:19', 0),
(11, '0000000007', 27, 1, 'Male', 'dozmic@gmail.com', 0, 1, '', 100, '2014-04-27', '', '2014-04-26 14:46:04', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=28 ;

--
-- Dumping data for table `tbl_userlog`
--

INSERT INTO `tbl_userlog` (`id`, `username`, `password`) VALUES
(1, 'superkidluigi', 'a'),
(3, 'emman', 'deiparine'),
(4, 'marvin', 'haduca'),
(18, 'bairan', 'b'),
(19, 'naughtyson', 'naughtyson'),
(22, 'lrgbairan', 'protos'),
(27, 'dozmic', 'dozmic');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_usercurrentbar`
--
ALTER TABLE `tbl_usercurrentbar`
  ADD CONSTRAINT `tbl_usercurrentbar_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_userinfo` (`id`) ON DELETE CASCADE;
