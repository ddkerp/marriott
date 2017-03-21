-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2017 at 04:58 PM
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

CREATE TABLE IF NOT EXISTS  `planner` (

 `id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
 `url` VARCHAR( 255 ) NOT NULL ,
 `groom_name` VARCHAR( 255 ) NOT NULL ,
 `bride_name` VARCHAR( 255 ) NOT NULL ,
 `groom_pimage` VARCHAR( 255 ) NOT NULL ,
 `bride_pimage` VARCHAR( 255 ) NOT NULL ,
 `event_date` DATE NOT NULL ,
 `session_id` VARCHAR( 255 ) NOT NULL ,
 `status` TINYINT( 1 ) NOT NULL ,
 `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ,
 `published_date` DATETIME NOT NULL ,
 `ip_address` VARCHAR( 255 ) NOT NULL ,
PRIMARY KEY (  `id` )
) ENGINE = INNODB DEFAULT CHARSET = latin1 AUTO_INCREMENT =1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
