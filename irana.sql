-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2014 at 06:42 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
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
  `orderdate` datetime NOT NULL,
  `kind` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `gig` int(11) NOT NULL,
  `paystatus` tinyint(1) NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=70 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `propid`, `planid`, `orderdate`, `kind`, `status`, `gig`, `paystatus`, `price`) VALUES
(2, 1, 3, '2014-08-16 00:00:00', 2, 2, 0, 1, 0),
(4, 2, -1, '2014-08-16 00:00:00', 2, 1, 0, 0, 0),
(5, 2, -1, '2014-08-16 00:00:00', 0, 2, 95, 0, 0),
(9, 4, -1, '2014-08-20 00:00:00', 0, 1, 2, 0, 0),
(10, 5, 3, '2014-08-20 00:00:00', 2, 2, 0, 0, 0),
(11, 1, -1, '2014-08-21 00:00:00', 1, 2, 0, 1, 0),
(12, 6, -1, '2014-08-21 00:00:00', 0, 2, 10, 0, 0),
(14, 8, 20, '2014-08-23 00:00:00', 3, 2, 0, 0, 0),
(15, 9, 20, '2014-08-23 00:00:00', 3, 1, 0, 0, 0),
(16, 10, 20, '2014-08-23 00:00:00', 3, 1, 0, 1, 0),
(17, 11, 20, '2014-08-23 00:00:00', 3, 1, 0, 0, 0),
(18, 12, 20, '2014-08-23 04:16:20', 3, 1, 0, 1, 0),
(40, 3, -1, '2014-08-30 00:00:00', 0, 1, 10, 0, 0),
(41, 3, -1, '2014-08-30 00:00:00', 0, 1, 10, 0, 0),
(42, 3, -1, '2014-08-30 07:37:45', 0, 1, 10, 1, 0),
(43, 3, -1, '2014-08-30 00:00:00', 0, 1, 10, 0, 0),
(44, 3, -1, '2014-08-30 00:00:00', 0, 1, 10, 0, 0),
(45, 3, -1, '2014-08-30 00:00:00', 0, 1, 10, 0, 0),
(46, 13, -1, '2014-08-30 00:00:00', 0, 1, 10, 0, 0),
(47, 14, -1, '2014-08-30 00:00:00', 0, 1, 10, 0, 0),
(48, 15, -1, '2014-08-30 00:00:00', 0, 1, 10, 0, 0),
(49, 15, -1, '2014-08-30 00:00:00', 0, 1, 10, 0, 0),
(50, 15, -1, '2014-08-30 00:00:00', 0, 1, 10, 0, 0),
(51, 15, -1, '2014-08-30 00:00:00', 0, 1, 10, 0, 0),
(52, 15, -1, '2014-08-30 00:00:00', 0, 1, 10, 0, 0),
(53, 15, -1, '2014-08-30 00:00:00', 0, 1, 10, 0, 0),
(54, 15, -1, '2014-08-30 00:00:00', 0, 1, 10, 0, 0),
(55, 15, -1, '2014-08-30 00:00:00', 0, 1, 10, 0, 0),
(56, 15, -1, '2014-08-30 00:00:00', 0, 1, 10, 0, 0),
(57, 3, -1, '2014-08-30 00:00:00', 0, 1, 1, 0, 0),
(58, 3, -1, '2014-08-30 00:00:00', 0, 1, 2, 0, 0),
(59, 3, -1, '2014-08-30 00:00:00', 0, 1, 2, 0, 0),
(60, 3, -1, '2014-08-30 00:00:00', 0, 1, 2, 0, 0),
(61, 16, -1, '2014-08-30 00:00:00', 0, 1, 2, 0, 0),
(62, 16, -1, '2014-08-30 00:00:00', 0, 1, 2, 0, 0),
(63, 16, -1, '2014-08-30 00:00:00', 0, 1, 2, 0, 0),
(64, 16, -1, '2014-08-30 00:00:00', 0, 1, 2, 0, 0),
(65, 16, -1, '2014-08-30 00:00:00', 0, 1, 2, 0, 0),
(66, 16, -1, '2014-08-30 00:00:00', 0, 1, 2, 0, 0),
(67, 16, -1, '2014-08-30 00:00:00', 0, 1, 2, 1, 0),
(68, 16, -1, '2014-08-31 13:42:00', 0, 1, 2, 1, 0),
(69, 16, -1, '2014-08-31 13:53:52', 0, 1, 2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oid` int(11) NOT NULL,
  `refid` varchar(30) NOT NULL,
  `pegiri` bigint(20) NOT NULL,
  `selorder` bigint(20) NOT NULL,
  `regdate` datetime NOT NULL,
  `errcode` int(11) NOT NULL,
  `confirm` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `oid`, `refid`, `pegiri`, `selorder`, `regdate`, `errcode`, `confirm`) VALUES
(1, 0, '', 0, 0, '1899-11-30 00:00:00', 0, 0),
(2, 0, '', 0, 0, '1899-11-30 00:00:00', 0, 0),
(3, 63, '', 102525603132, 1158736103088412160, '1899-11-30 00:00:00', 0, 0),
(4, 64, '', 0, 0, '2014-08-30 00:00:00', 0, 0),
(5, 65, '', 102525854966, 2075903209257658352, '2014-08-30 00:00:00', 0, 0),
(6, 66, '', 102526085306, 1749706043244830671, '2014-08-30 00:00:00', 0, 0),
(7, 67, '', 0, 1623802958450699580, '2014-08-31 00:00:00', 0, 0),
(8, 68, '', 102526399779, 609186533326008918, '2014-08-31 00:00:00', 0, 1),
(9, 69, '37879453AA72B200', 102526476282, 2147422430328097164, '2014-08-31 00:32:58', 0, 1);

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
  `special` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `pname`, `month`, `gig`, `night`, `modem`, `price`, `percent`, `special`) VALUES
(3, 'طلایی - سه ماهه  - 9 گیگ', 3, 3, 0, 0, 567000, 5, 0),
(4, 'طلایی - سه ماهه - 15 گیگ', 3, 5, 0, 0, 696600, 5, 0),
(5, 'طلایی - سه ماهه - 24 گیگ', 3, 8, 0, 0, 1004400, 5, 0),
(6, 'طلایی - شش ماهه - 18 گیگ', 6, 3, 0, 0, 1134000, 5, 0),
(7, 'طلایی - شش ماهه - 30 گیگ', 6, 5, 0, 0, 139200, 5, 0),
(9, 'طلایی - شش ماهه - 48 گیگ', 6, 8, 0, 0, 2008800, 5, 0),
(10, 'طلایی - یکساله  - 36 گیگ', 12, 3, 0, 0, 2268000, 5, 0),
(11, 'طلایی - یکساله - 60 گیگ', 12, 5, 0, 0, 2786400, 5, 0),
(12, 'طلایی - یکساله - 96 گیگ', 12, 8, 0, 0, 4017600, 5, 0),
(13, 'نقره ای - سه ماهه - 9 گیگ', 3, 3, 0, 0, 453600, 5, 0),
(14, 'نقره ای - سه ماهه - 15 گیگ', 3, 5, 0, 0, 567000, 5, 0),
(15, 'نقره ای - سه ماهه - 24 گیگ', 3, 8, 0, 0, 891000, 5, 0),
(16, 'نقره ای - شش ماهه - 18 گیگ', 6, 3, 0, 0, 907200, 5, 0),
(17, 'نقره ای - شش ماهه - 30 گیگ', 6, 5, 0, 0, 1134000, 5, 0),
(18, 'نقره ای - شش ماهه - 48 گیگ', 6, 8, 0, 0, 1782000, 5, 0),
(19, 'نقره ای - یکساله - 36 گیگ', 12, 3, 0, 0, 1814400, 5, 0),
(20, 'نقره ای - یکساله - 60 گیگ', 12, 5, 0, 0, 2268000, 5, 0),
(21, 'نقره ای - یکساله - 96 گیگ', 12, 8, 0, 0, 3564000, 5, 0),
(22, 'برنزی - سه ماهه - 9 گیگ', 3, 3, 0, 0, 405000, 5, 0),
(23, 'برنزی - سه ماهه - 15 گیگ', 3, 5, 0, 0, 502200, 5, 0),
(24, 'برنزی - شش ماهه - 18 گیگ', 6, 3, 0, 0, 810000, 5, 0),
(25, 'برنزی - شش ماهه - 30 گیگ', 6, 5, 0, 0, 1004400, 5, 0),
(26, 'برنزی - یکساله - 36 گیگ', 12, 3, 0, 0, 1620000, 5, 0),
(27, 'برنزی - یکساله - 60 گیگ', 12, 5, 0, 0, 2008800, 5, 0),
(28, 'طرح 256 - سه ماهه - 15 گیگ', 3, 5, 0, 0, 421200, 5, 0),
(29, 'طرح 256 - شش ماهه - 30 گیگ', 6, 5, 0, 0, 842400, 5, 0),
(30, 'طرح 256 - یکساله  - 60 گیگ', 12, 5, 0, 0, 1684800, 5, 0),
(31, 'طرح 128 - سه ماهه - 15 گیگ', 3, 5, 0, 0, 356400, 5, 0),
(32, 'طرح 128 - شش ماهه - 30 گیگ', 6, 5, 0, 0, 712800, 5, 0),
(33, 'طرح 128 - یکساله - 15 گیگ', 12, 5, 0, 0, 1425600, 5, 0),
(34, 'طرح 64 - سه ماهه - 9 گیگ', 3, 3, 0, 0, 275400, 5, 0),
(35, 'طرح 64 - شش ماهه - 18 گیگ', 6, 3, 0, 0, 550800, 5, 0),
(36, 'طرح 64 - یکساله - 9 گیگ', 12, 3, 0, 0, 1101600, 5, 0),
(37, 'خانواده - سه ماهه - 3 گیگ', 3, 1, 0, 0, 162000, 5, 0),
(38, 'خانواده - سه ماهه - 6 گیگ', 6, 1, 0, 0, 324000, 5, 0),
(39, 'خانواده - یکساله  - 12 گیگ', 12, 1, 0, 0, 648000, 5, 0),
(40, 'طرح 256 - یکساله  - 36 گیگ', 12, 3, 0, 0, 1166400, 5, 0),
(41, 'طرح 256 - یکساله - 60 گیگ', 12, 5, 0, 0, 1425600, 5, 0),
(42, 'طرح 512 - یکساله - 36 گیگ', 12, 3, 0, 0, 1425600, 5, 0),
(43, 'طرح 512 - یکساله - 60 گیگ', 12, 5, 0, 0, 1684800, 5, 0),
(44, '1Mbps - یکساله - 36 گیگ', 12, 3, 0, 0, 1620000, 5, 0),
(45, '1Mbps - یکساله - 60 گیگ + مورم رایگان+شبانه رایگان', 12, 5, 1, 1, 2008800, 5, 0),
(46, '2Mbps - یکساله - 36 گیگ + مورم رایگان+شبانه رایگان', 12, 3, 1, 1, 1814400, 5, 0),
(47, '2Mbps - یکساله - 60 گیگ + مورم رایگان+شبانه رایگان', 12, 5, 1, 1, 2268000, 5, 0),
(48, '2Mbps - یکساله - 96 گیگ + مورم رایگان+شبانه رایگان', 12, 8, 1, 1, 3564000, 5, 0),
(49, '5Mbps - یکساله - 36 گیگ + مورم رایگان+شبانه رایگان', 12, 3, 1, 1, 2268000, 5, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `fullname`, `tel`, `mobile`, `email`, `planid`) VALUES
(1, 'سویزی', '5116640222', '09356222811', 'sal@ggg.com', 3),
(2, 'امیر امیری', '5118555560', '09123456789', 'دشسئ@غشاخخ.زخئ', 3),
(3, '', '', '', '', -1),
(4, 'سعید حاتمی', '62626262', '09366903366', 'hatami4560@yahoo.com', -1),
(5, 'مجتبی امجدی', '7623666', '09151091162', 'amjadi.m@gmail.com', 3),
(6, 'سویزی', '5116634996', '09356222811', 'info@ir2020.ir', -1),
(7, 'مجتبی امجدی', '5117614153', '09151091162', 'amjadi.mojtaba@gmail.com', -1),
(8, 'احمد جوان', '5116690215', '09356222811', 'nam@tahoo.com', 20),
(9, 'احمد جوان', '5116690215', '09356222811', 'nam@tahoo.com', 20),
(10, 'احمد جوان', '5116690215', '09356222811', 'nam@tahoo.com', 20),
(11, 'احمد جوان', '5116690215', '09356222811', 'nam@tahoo.com', 20),
(12, 'احمد جوان', '5116690215', '09356222811', 'nam@tahoo.com', 20),
(13, '', '5118585855', '', '', -1),
(14, '', '5118796457', '', '', -1),
(15, '', '5116625875', '', '', -1),
(16, 'سعید حاتمی', '5139595959', '09151204395', 'hatami4560@yahoo.com', -1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(30) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`) VALUES
(1, 'Site_Theme_Name', 'default'),
(2, 'About_System', 'گروه بازرگانی ایرانا با هدف ارائه رهيافت‌های جامع و خدمات تخصصی در زمينه شبكه های رايانه ای ، طراحی سایت ، اعطاء نمایندگی پیشرفته ترین پنل ارسال اس ام اس ، ارائه امنیت شبکه ، ويدئو کنفرانس Polycom ،  بر مبنای متدولوژی‌های نوين انفورماتيك در سال 1388 تأسيس شد. مبنای فعاليت شركت  بر پايه استفاده از متخصصين مجرب و تجهيزات مدرن در انجام پروژه‌های  كامپيوتری استوار است و بر همين اساس با دريافت نمايندگی رسمی از شركتهای معتبر توليد كننده تجهيزات ، به تدريج در سالهاي اوليه فعاليت خود، به پايگاهی مطمئن در ارائه محصولات معتبر و متنوع شبكه های كامپيوتری تبديل گرديد.\r\nهمچنين با عنايت به اعتقاد مديريت شركت مبنی بر استفاده از نيروهای متخصص، كليه كارشناسان اين شركت  در واحدهای فنی  و مهندسی فروش موفق به دريافت مدارك بین المللی مرتبط با راهکارهای مورد استفاده گردیده اند.\r\nگروه بازرگانی ایرانا در سال 1389 با دریافت نمایندگی رسمی فروش، تمدید و شارژ اینترنت مخابرات بر آن شد تا تمام نیاز های مشترکین مخابرات در این حوزه را برآورده نماید که ارتباط ، پاسخ سریع و ارائه راهکارهای نوین گویای این مطلب میباشد.'),
(3, 'Site_Title', 'گروه بازرگانی ایرانا'),
(4, 'Site_KeyWords', 'اینترنت,مخابرات,صبانت,مودم،اس ام اس،رایگان،تخفیف،پول،شارژ،'),
(5, 'Site_Describtion', 'گروه بازرگانی ایرانا نماینده رسمی تمدید و ثبت محصولات اینترنت مخابرات'),
(6, 'Admin_Email', 'admin@mediateq.ir'),
(7, 'News_Email', 'news@mediateq.ir'),
(8, 'Contact_Email', 'info@ir2020.ir'),
(9, 'Max_Page_Number', '5'),
(10, 'Max_Post_Number', '3'),
(11, 'FaceBook_Add', 'facebook.com'),
(12, 'Twitter_Add', 'twitter.com'),
(13, 'Rss_Add', '127.0.01/media/rssfeed.php'),
(14, 'YouTube_Add', 'youtube.com'),
(15, 'Tell_Number', '38555560'),
(16, 'Fax_Number', '38555560'),
(17, 'Address', 'مشهد- چهارراه لشکر-مجتمع تجاری اداری آسیا-واحد203\r\n'),
(18, 'Is_Smtp_Active', 'yes'),
(19, 'Smtp_Host', 'smtp.gmail.com'),
(20, 'Smtp_User_Name', 'hatami4510@gmail.com'),
(21, 'Smtp_Pass_Word', '12345'),
(22, 'Smtp_Port', '465'),
(23, 'Email_Sender_Name', 'گروه مدیاتک'),
(24, 'WellCome_Title', ''),
(25, 'WellCome_Body', ''),
(26, 'Gplus_Add', 'www.googleplus.com'),
(27, 'About_Pic_Name', 'about_pic.jpg'),
(28, 'Percent_Off', '5'),
(29, 'Extra_Tax', '0'),
(30, 'SmsUserName', 'ir2020'),
(31, 'SmsPassWord', '123456'),
(32, 'SmsText', 'آقا / خانم {user} به شماره خط {tel}  سفارش شما تایید شد.\nگروه ایرانا\n\n'),
(33, 'SmsLineNumber', '+98100009'),
(34, 'Bank_Terminal_ID', '11111'),
(35, 'Bank_User_Name', 'irana'),
(36, 'Bank_Pass_Word', '111111'),
(37, 'Email_Text', 'jhkohjk');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `family`, `image`, `email`, `username`, `password`, `type`) VALUES
(1, 'Media', 'Teq', '', 'admin@mediateq.ir', 'admin', '432bd1bccd491f10eb6f14d7a98cba14', 0),
(2, 'Nasrollah', 'Soveizi', '', 'nasrollah.soveizi@gmail.com', 'irana', '8d8cda7113daffca47e93653e4eb4e56', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `volumes`
--

INSERT INTO `volumes` (`id`, `fvol`, `tvol`, `price`, `percent`) VALUES
(1, 1, 5, 1000, 5),
(4, 5, 10, 28080, 5),
(5, 10, 99, 17280, 5);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
