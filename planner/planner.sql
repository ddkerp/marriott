-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2017 at 03:40 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `planner`
--

DROP TABLE IF EXISTS `planner`;
CREATE TABLE IF NOT EXISTS `planner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `groom_name` varchar(255) NOT NULL,
  `bride_name` varchar(255) NOT NULL,
  `groom_pimage` varchar(255) NOT NULL,
  `bride_pimage` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `header_image` varchar(255) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `bride_description` text NOT NULL,
  `groom_description` text NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `published_date` datetime NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `planner_gallery`
--

DROP TABLE IF EXISTS `planner_gallery`;
CREATE TABLE IF NOT EXISTS `planner_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `planner_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `image_title` varchar(255) NOT NULL,
  `image_description` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `planner_guest`
--

DROP TABLE IF EXISTS `planner_guest`;
CREATE TABLE IF NOT EXISTS `planner_guest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `planner_id` int(11) NOT NULL,
  `guest_name` varchar(255) NOT NULL,
  `guest_image` varchar(255) NOT NULL,
  `guest_relation` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
