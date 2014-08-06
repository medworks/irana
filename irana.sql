-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2014 at 11:50 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `irana`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `propid` int(11) NOT NULL,
  `planid` int(11) NOT NULL,
  `orderdate` varchar(10) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `gig` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `propid`, `planid`, `orderdate`, `status`, `gig`) VALUES
(1, 12, -1, '2014-08-06', 0, 2),
(2, 13, 5, '2014-08-06', 2, 0),
(3, 0, 5, '2014-08-06', 2, 0),
(4, 14, -1, '2014-08-06', 0, 5),
(5, 0, 6, '2014-08-06', 2, 0),
(6, 14, 3, '2014-08-06', 2, 0),
(7, 14, 5, '2014-08-06', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE IF NOT EXISTS `plans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pname` varchar(100) NOT NULL,
  `month` int(11) NOT NULL,
  `gig` int(11) NOT NULL,
  `night` tinyint(1) NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `pname`, `month`, `gig`, `night`, `price`) VALUES
(1, 'طلایی شش ماهه 3 گیگ + بدون شبانه', 6, 3, 0, 567000),
(2, 'طلایی سه ماهه 3 گیگ + بدون شبانه', 3, 3, 0, 1131000),
(3, 'طلایی 12 ماهه 3 گیگ + بدون شبانه', 12, 3, 0, 2268000),
(4, 'طلایی سه ماهه 5 گیگ + بدون شبانه', 3, 5, 0, 696600),
(5, 'طلایی 6 ماهه 5 گیگ + بدون شبانه', 6, 5, 0, 1393200),
(6, 'طلایی 12 ماهه 5 گیگ + بدون شبانه', 12, 5, 0, 2786400),
(7, 'طلایی 3ماهه 8 گیگ + بدون شبانه', 3, 8, 0, 1004400),
(8, 'طلایی 6 ماهه 8 گیگ + بدون شبانه', 6, 8, 0, 2008800);

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE IF NOT EXISTS `properties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `planid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `fullname`, `tel`, `mobile`, `email`, `planid`) VALUES
(3, 'سعید حاتمی', '5116623685', '09151204395', 'hatami4560@yahoo.com', 1),
(5, 'مجتبی امجدی', '5117613679', '09151091162', 'amjadi.m@gmail.com', 0),
(11, 'رضا احدی', '5118796457', '09151105478', 'hatami4510@gmail.com', 0),
(12, 'رضا اکبری', '5116625875', '09151146587', 'aaaa@bbb.com', NULL),
(13, '', '5116625875', '', '', NULL),
(14, 'سعید رمضانی', '5118585855', '09154557884', 'aaaa@bbb.com', 5);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
