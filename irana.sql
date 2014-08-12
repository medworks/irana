-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2014 at 10:27 AM
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
  `kind` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `gig` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `propid`, `planid`, `orderdate`, `kind`, `status`, `gig`) VALUES
(1, 12, -1, '2014-08-06', 0, 2, 2),
(2, 13, 5, '2014-08-06', 1, 1, 0),
(3, 0, 5, '2014-08-06', 2, 1, 0),
(4, 14, -1, '2014-08-06', 0, 1, 5),
(5, 0, 6, '2014-08-06', 2, 1, 0),
(6, 14, 3, '2014-08-06', 2, 1, 0),
(7, 14, 5, '2014-08-06', 2, 1, 0),
(8, 14, -1, '2014-08-12', 0, 1, 5),
(9, 13, 5, '2014-08-06', 1, 1, 0),
(10, 14, -1, '2014-08-06', 0, 1, 5),
(11, 14, -1, '2014-08-12', 0, 1, 5),
(12, 12, -1, '2014-08-06', 0, 1, 2);

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
  `modem` tinyint(1) NOT NULL,
  `price` double NOT NULL,
  `percent` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `pname`, `month`, `gig`, `night`, `modem`, `price`, `percent`) VALUES
(1, 'طلایی شش ماهه 3 گیگ + بدون شبانه', 6, 3, 0, 0, 567000, 2),
(2, 'طلایی سه ماهه 3 گیگ + بدون شبانه', 3, 3, 0, 0, 1131000, 5),
(3, 'طلایی 12 ماهه 3 گیگ + بدون شبانه', 12, 3, 0, 0, 2268000, 0),
(4, 'طلایی سه ماهه 5 گیگ + بدون شبانه', 3, 5, 0, 0, 696600, 0),
(5, 'طلایی 6 ماهه 5 گیگ + بدون شبانه', 6, 5, 0, 0, 1393200, 0),
(6, 'طلایی 12 ماهه 5 گیگ + بدون شبانه', 12, 5, 0, 0, 2786400, 0),
(7, 'طلایی 3ماهه 8 گیگ + بدون شبانه', 3, 8, 0, 0, 1004400, 0),
(8, 'طلایی 6 ماهه 8 گیگ + بدون شبانه', 6, 8, 0, 0, 2008800, 0),
(9, 'نقره داغ 3 ماهه 5 گیگ', 3, 5, 1, 0, 0, 3),
(10, 'نقره داغ 3 ماهه 5 گیگ', 3, 5, 1, 0, 0, 3),
(12, 'نقره داغ 12 ماهه 6 گیگ', 12, 6, 1, 1, 950000, 5),
(13, 'نقره داغ 12 ماهه 8 گیگ', 3, 5, 1, 1, 950000, 3),
(14, 'نقره داغ 12 ماهه 6 گیگ', 6, 6, 0, 0, 450000, 10);

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

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(30) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`) VALUES
(1, 'Site_Theme_Name', 'default'),
(2, 'About_System', 'گروه مدیا تک بر در سال 1392 تشکیل و به جهت رفاه حال مشتریان عزیز'),
(3, 'Site_Title', 'شرکت ایرانا'),
(4, 'Site_KeyWords', 'مدیا تک - سی ام اس - مدیریت محتوا'),
(5, 'Site_Describtion', 'این سایت بر پایه phpطراحی شده است که باعث سهولت در'),
(6, 'Admin_Email', 'admin@mediateq.ir'),
(7, 'News_Email', 'news@mediateq.ir'),
(8, 'Contact_Email', 'info@mediateq.ir'),
(9, 'Max_Page_Number', '5'),
(10, 'Max_Post_Number', '3'),
(11, 'FaceBook_Add', 'facebook.com'),
(12, 'Twitter_Add', 'twitter.com'),
(13, 'Rss_Add', '127.0.01/media/rssfeed.php'),
(14, 'YouTube_Add', 'youtube.com'),
(15, 'Tell_Number', '7623666'),
(16, 'Fax_Number', '7634562'),
(17, 'Address', 'جهت تست آدرس\r\nتست دوم'),
(18, 'Is_Smtp_Active', 'yes'),
(19, 'Smtp_Host', 'smtp.gmail.com'),
(20, 'Smtp_User_Name', 'hatami4510@gmail.com'),
(21, 'Smtp_Pass_Word', '12345'),
(22, 'Smtp_Port', '465'),
(23, 'Email_Sender_Name', 'گروه مدیاتک'),
(24, 'WellCome_Title', ''),
(25, 'WellCome_Body', ''),
(26, 'Gplus_Add', 'www.googleplus.com'),
(27, 'About_Pic_Name', 'about_pic.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `family` varchar(50) NOT NULL,
  `image` varchar(60) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(35) NOT NULL,
  `type` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `family`, `image`, `email`, `username`, `password`, `type`) VALUES
(1, 'سعید', 'حاتمی', '../userspics/logo.png', 'hatami4560@yahoo.com', 'php', '5f93f983524def3dca464469d2cf9f3e', 0),
(2, 'علی رضا', 'صادقی نژاد', './newspics/editnews.png', 'r.sadeghi@yahoo.com', 'reza', '4510', 1),
(3, 'علی', 'قائمی', './newspics/works.png', 'ali.ghaemi@gmail.com', 'ghaemi', '827ccb0eea8a706c4c34a16891f84e7b', 0),
(4, 'آرش', 'خویتندار', './newspics/addworks.png', 'arash.kh@gmail.com', 'arash', '827ccb0eea8a706c4c34a16891f84e7b', 0);

-- --------------------------------------------------------

--
-- Table structure for table `volumes`
--

CREATE TABLE IF NOT EXISTS `volumes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fvol` tinyint(3) unsigned NOT NULL,
  `tvol` tinyint(3) unsigned NOT NULL,
  `price` double NOT NULL,
  `percent` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `volumes`
--

INSERT INTO `volumes` (`id`, `fvol`, `tvol`, `price`, `percent`) VALUES
(1, 1, 5, 3600, 5),
(3, 6, 10, 2600, 5),
(4, 10, 99, 1600, 5);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
