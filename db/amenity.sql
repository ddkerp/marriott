-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 21, 2016 at 09:11 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `marriou2_marriott`
--

-- --------------------------------------------------------

--
-- Table structure for table `amenity`
--

DROP TABLE IF EXISTS `amenity`;
CREATE TABLE IF NOT EXISTS `amenity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created_bydate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `amenity`
--

INSERT INTO `amenity` (`id`, `name`, `image`, `class`, `status`, `created_bydate`) VALUES
(1, 'Full-service spa', '', 'icon-spa-xlarge', 1, '2016-12-06 16:30:04'),
(2, 'Pool', '', 'icon-pool-xlarge', 1, '2016-12-06 16:30:04'),
(3, 'Bar', '', 'icon-bar-xlarge', 1, '2016-12-06 16:33:17'),
(4, 'Laundry', '', 'icon-laundry-xlarge', 1, '2016-12-06 16:33:17'),
(5, 'Airport Shuttle ', '', 'icon-airport-shuttle-xlarge', 1, '2016-12-06 16:33:17'),
(6, '24-Hour Room Service', '', 'icon-hr-room-service-xlarge', 1, '2016-12-06 16:33:17');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
