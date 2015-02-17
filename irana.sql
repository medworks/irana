-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2015 at 11:07 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

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
-- Table structure for table `debtpayment`
--

CREATE TABLE IF NOT EXISTS `debtpayment` (
`id` int(11) NOT NULL,
  `oid` int(11) NOT NULL,
  `refid` varchar(30) NOT NULL,
  `pegiri` bigint(20) NOT NULL,
  `selorder` bigint(20) NOT NULL,
  `regdate` datetime NOT NULL,
  `errcode` varchar(10) NOT NULL,
  `confirm` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
`id` int(11) NOT NULL,
  `propid` int(11) NOT NULL,
  `planid` int(11) NOT NULL,
  `selorder` bigint(20) unsigned NOT NULL,
  `orderdate` datetime NOT NULL,
  `kind` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `gig` int(11) NOT NULL,
  `paystatus` tinyint(1) NOT NULL,
  `price` double NOT NULL,
  `remove` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `propid`, `planid`, `selorder`, `orderdate`, `kind`, `status`, `gig`, `paystatus`, `price`, `remove`) VALUES
(2, 1, -1, 0, '2014-09-05 19:14:12', 0, 2, 1, 1, 36936, 0),
(3, 1, -1, 0, '2014-09-05 19:14:12', 0, 1, 1, 1, 36936, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
`id` int(11) NOT NULL,
  `oid` int(11) NOT NULL,
  `refid` varchar(30) NOT NULL,
  `pegiri` bigint(20) NOT NULL,
  `selorder` bigint(20) NOT NULL,
  `regdate` datetime NOT NULL,
  `errcode` varchar(10) NOT NULL,
  `confirm` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE IF NOT EXISTS `plans` (
`id` int(11) NOT NULL,
  `pname` varchar(100) NOT NULL,
  `month` int(11) NOT NULL,
  `gig` int(11) NOT NULL,
  `night` tinyint(1) NOT NULL,
  `modem` tinyint(1) NOT NULL,
  `price` double NOT NULL,
  `percent` tinyint(3) unsigned NOT NULL,
  `special` tinyint(1) NOT NULL,
  `position` int(11) NOT NULL,
  `remove` tinyint(1) NOT NULL,
  `hispecial` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=157 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `pname`, `month`, `gig`, `night`, `modem`, `price`, `percent`, `special`, `position`, `remove`, `hispecial`) VALUES
(50, 'خانواده پیش پرداخت - 3 ماهه - 3 گیگ', 3, 1, 0, 0, 162000, 5, 1, 0, 0, 0),
(51, 'خانواده پیش پرداخت - 6 ماهه - 3 گیگ', 6, 1, 0, 0, 324000, 5, 0, 0, 0, 0),
(52, 'خانواده پیش پرداخت - یکساله - 12 گیگ', 12, 1, 0, 0, 648000, 5, 0, 0, 0, 0),
(53, '64 کیلوبایت - 3 ماهه - 9 گیگ', 3, 3, 0, 0, 275400, 5, 1, 0, 0, 0),
(54, '64 کیلوبایت - 6 ماهه - 18 گیگ', 6, 3, 0, 0, 550800, 5, 0, 0, 0, 0),
(55, '64 کیلوبایت - یکساله - 36 گیگ', 12, 3, 0, 0, 1101600, 5, 0, 0, 0, 0),
(56, '128 کیلوبایت - 3 ماهه - 15 گیگ', 3, 5, 0, 0, 356400, 5, 1, 0, 0, 0),
(57, '128 کیلوبایت - 6 ماهه - 30 گیگ', 6, 5, 0, 0, 712800, 5, 0, 0, 0, 0),
(58, '128 کیلوبایت - یکساله - 60 گیگ', 12, 5, 0, 0, 1425600, 5, 0, 0, 0, 0),
(110, '256 کیلوبایت - 3 ماهه - 15 گیگ', 3, 5, 0, 0, 421200, 5, 1, 0, 0, 0),
(111, '256 کیلوبایت - 6 ماهه - 30 گیگ', 6, 5, 0, 0, 842400, 5, 0, 0, 0, 0),
(112, '256 کیلوبایت - یکساله - 15 گیگ', 12, 5, 0, 0, 1684800, 5, 0, 0, 0, 0),
(113, 'طرح برنزی ( سرعت 512)- 3 ماهه - 9 گیگ', 3, 3, 0, 0, 405000, 5, 1, 0, 0, 0),
(114, 'طرح برنزی ( سرعت 512)- 3 ماهه - 15 گیگ', 3, 5, 0, 0, 502200, 5, 0, 0, 0, 0),
(115, 'طرح برنزی ( سرعت 512)- 6 ماهه - 18 گیگ', 6, 3, 0, 0, 810000, 5, 0, 0, 0, 0),
(116, 'طرح برنزی ( سرعت 512)- 6 ماهه - 30 گیگ', 6, 5, 0, 0, 1004400, 5, 0, 0, 0, 0),
(117, 'طرح برنزی ( سرعت 512)- یکساله - 36 گیگ', 12, 3, 0, 0, 1620000, 5, 0, 0, 0, 0),
(118, 'طرح برنزی ( سرعت 512)- یکساله - 60 گیگ', 12, 5, 0, 0, 2008800, 5, 0, 0, 0, 0),
(119, 'طرح نقره ای (سرعت 1024 ) - 3 ماهه - 9 گیگ', 3, 3, 0, 0, 453600, 5, 1, 0, 0, 0),
(120, 'طرح نقره ای (سرعت 1024 ) - 3 ماهه - 15 گیگ', 3, 5, 0, 0, 567000, 5, 0, 0, 0, 0),
(121, 'طرح نقره ای (سرعت 1024 ) - 3 ماهه - 24 گیگ', 3, 8, 0, 0, 891000, 5, 0, 0, 0, 0),
(122, 'طرح نقره ای (سرعت 1024 ) - 6 ماهه - 18 گیگ', 6, 3, 0, 0, 907200, 5, 0, 0, 0, 0),
(123, 'طرح نقره ای (سرعت 1024 ) - 6 ماهه - 30 گیگ', 6, 5, 0, 0, 1134000, 5, 0, 0, 0, 0),
(124, 'طرح نقره ای (سرعت 1024 ) - 6 ماهه - 48 گیگ', 6, 8, 0, 0, 1782000, 5, 0, 0, 0, 0),
(125, 'طرح نقره ای (سرعت 1024 ) - یکساله - 36 گیگ', 12, 3, 0, 0, 1814400, 5, 0, 0, 0, 0),
(126, 'طرح نقره ای (سرعت 1024 ) - یکساله - 60 گیگ', 12, 5, 0, 0, 2268000, 5, 0, 0, 0, 0),
(127, 'طرح نقره ای (سرعت 1024 ) - یکساله - 96 گیگ', 12, 8, 0, 0, 3564000, 5, 0, 0, 0, 0),
(128, 'طرح طلایی (سرعت 2048 ) - 3 ماهه - 9 گیگ', 3, 3, 0, 0, 567000, 5, 1, 0, 0, 0),
(129, 'طرح طلایی (سرعت 2048 ) - 3 ماهه - 15 گیگ', 3, 5, 0, 0, 696600, 5, 0, 0, 0, 0),
(130, 'طرح طلایی (سرعت 2048 ) - 3 ماهه - 24 گیگ', 3, 8, 0, 0, 1004400, 5, 0, 0, 0, 0),
(131, 'طرح طلایی (سرعت 2048 ) - 6 ماهه - 18 گیگ', 6, 3, 0, 0, 1134000, 5, 0, 0, 0, 0),
(132, 'طرح طلایی (سرعت 2048 ) - 6 ماهه - 30 گیگ', 6, 5, 0, 0, 1393200, 5, 0, 0, 0, 0),
(133, 'طرح طلایی (سرعت 2048 ) - 6 ماهه - 48 گیگ', 6, 8, 0, 0, 2008800, 5, 0, 0, 0, 0),
(134, 'طرح طلایی (سرعت 2048 ) - یکساله - 36 گیگ', 12, 3, 0, 0, 2268000, 5, 0, 0, 0, 0),
(135, 'طرح طلایی (سرعت 2048 ) - یکساله - 60 گیگ', 12, 5, 0, 0, 2786400, 5, 0, 0, 0, 0),
(136, 'طرح طلایی (سرعت 2048 ) - یکساله - 96 گیگ', 12, 8, 0, 0, 4017600, 5, 0, 0, 0, 0),
(137, 'کمپین تابستان - 256کیلوبایت - 36 گیگ', 12, 3, 0, 0, 1166400, 5, 1, 0, 0, 0),
(138, 'کمپین تابستان - 256کیلوبایت - 60 گیگ', 12, 5, 0, 0, 1425600, 5, 0, 0, 0, 0),
(139, 'کمپین تابستان - 512 کیلوبایت - 36 گیگ', 12, 3, 0, 0, 1425600, 5, 0, 0, 0, 0),
(140, 'کمپین تابستان - 512 کیلوبایت - 60 گیگ', 12, 5, 0, 0, 1684800, 5, 0, 0, 0, 0),
(141, 'کمپین تابستان - 1 مگابایت - 36 گیگ', 12, 3, 0, 0, 1620000, 5, 0, 0, 0, 0),
(142, 'کمپین تابستان - 1 مگابایت - 60 گیگ + مودم رایگان + شبانه رایگان', 12, 5, 1, 1, 2008800, 5, 1, 0, 0, 0),
(143, 'کمپین تابستان - 2 مگابایت - 36 گیگ + مودم رایگان + شبانه رایگان', 12, 3, 1, 1, 1814400, 5, 1, 0, 0, 0),
(144, 'کمپین تابستان - 2 مگابایت - 60 گیگ + مودم رایگان + شبانه رایگان', 12, 5, 1, 1, 2268000, 5, 1, 0, 0, 0),
(145, 'کمپین تابستان - 2 مگابایت - 96 گیگ + مودم رایگان + شبانه رایگان', 12, 8, 1, 1, 3564000, 5, 1, 0, 0, 0),
(146, 'کمپین تابستان - 5 مگابایت - 36 گیگ + مودم رایگان ', 12, 3, 0, 1, 2268000, 5, 1, 0, 0, 0),
(147, 'کمپین تابستان - 1 مگابایت - 84 گیگ + شبانه رایگان', 12, 7, 1, 0, 2008800, 5, 0, 0, 0, 0),
(148, 'کمپین تابستان - 2 مگابایت - 60 گیگ + شبانه رایگان', 12, 5, 1, 0, 1814400, 5, 0, 0, 0, 0),
(149, 'کمپین تابستان - 2 مگابایت - 84 گیگ + شبانه رایگان ', 12, 7, 1, 0, 2268000, 5, 0, 0, 0, 0),
(150, 'کمپین تابستان - 2 مگابایت - 120 گیگ  + شبانه رایگان', 12, 10, 1, 0, 3564000, 5, 0, 0, 0, 0),
(151, 'کمپین تابستان - 5 مگابایت - 60 گیگ ', 12, 5, 0, 0, 2268000, 5, 0, 0, 0, 0),
(152, 'کمپین تجاری 5 مگابایت + 3ماهه + 15 گیگ', 3, 5, 0, 0, 729000, 5, 1, 0, 0, 0),
(153, 'کمپین تجاری 5 مگابایت + یکساله + 60 گیگ', 12, 5, 0, 0, 2916000, 5, 0, 0, 0, 0),
(154, 'کمپین تجاری 10 مگابایت + 3ماهه + 15 گیگ', 3, 5, 0, 0, 972000, 5, 1, 0, 0, 0),
(155, 'کمپین تجاری 10 مگابایت + یکساله + 120 گیگ', 12, 10, 0, 0, 3888000, 5, 0, 0, 0, 0),
(156, 'gjhgjhgjh', 5, 10, 1, 1, 5000000, 2, 1, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE IF NOT EXISTS `properties` (
`id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `planid` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `fullname`, `tel`, `mobile`, `email`, `planid`) VALUES
(2, 'hjhe', '05112426224', '22222', 'entezar.6659@yahoo.com', -1),
(3, '', '5116098198', '', '', 93);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
`id` int(11) NOT NULL,
  `key` varchar(30) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`) VALUES
(1, 'Site_Theme_Name', 'default'),
(2, 'About_System', 'گروه بازرگانی ایرانا با هدف ارائه رهيافت‌های جامع و خدمات تخصصی در زمينه شبكه های رايانه ای ، طراحی سایت ، اعطاء نمایندگی پیشرفته ترین پنل ارسال اس ام اس ، ارائه امنیت شبکه ، ويدئو کنفرانس Polycom ،  بر مبنای متدولوژی‌های نوين انفورماتيك در سال 1388 تأسيس شد. مبنای فعاليت شركت  بر پايه استفاده از متخصصين مجرب و تجهيزات مدرن در انجام پروژه‌های  كامپيوتری استوار است و بر همين اساس با دريافت نمايندگی رسمی از شركتهای معتبر توليد كننده تجهيزات ، به تدريج در سالهاي اوليه فعاليت خود، به پايگاهی مطمئن در ارائه محصولات معتبر و متنوع شبكه های كامپيوتری تبديل گرديد.\r\nهمچنين با عنايت به اعتقاد مديريت شركت مبنی بر استفاده از نيروهای متخصص، كليه كارشناسان اين شركت  در واحدهای فنی  و مهندسی فروش موفق به دريافت مدارك بین المللی مرتبط با راهکارهای مورد استفاده گردیده اند.\r\nگروه بازرگانی ایرانا در سال 1389 با دریافت نمایندگی رسمی فروش، تمدید و شارژ اینترنت مخابرات بر آن شد تا تمام نیاز های مشترکین مخابرات در این حوزه را برآورده نماید که ارتباط ، پاسخ سریع و ارائه راهکارهای نوین گویای این مطلب میباشد.'),
(3, 'Site_Title', 'گروه بازرگانی ایرانا'),
(4, 'Site_KeyWords', 'اینترنت,مخابرات,صبانت,مودم،اس ام اس،رایگان،تخفیف،پول،شارژ،2020،ir،www.ir2020.ir ،شارژ اینترنت مخابرات خراسان رضوی،'),
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
(32, 'SmsText', 'آقا/خانم {user} به شماره خط {tel} سفارش شما با مشخصات {order_info} ثبت و اعمال شد.\r\nبا تشکر\r\nگروه بازرگانی ایرانا\r\n051-38555560\r\n\r\n'),
(33, 'SmsLineNumber', '+98100009'),
(34, 'Bank_Terminal_ID', '1144896'),
(35, 'Bank_User_Name', 'irana'),
(36, 'Bank_Pass_Word', '41833070'),
(37, 'Email_Text', '<p style="direction:rtl;">\r\nبا سلام\r\n<br/>\r\nآقا/خانم {user} ، به شماره خط {tel}  و همراه {mobile} \r\n<br/>\r\nدرخواست شما با مشخصات {order_info} \r\n<br/>\r\nدر مورخه {date} با موفقیت ثبت شد.\r\n<br/>\r\n************************************\r\n<br/>\r\nمشخصات پرداخت به شرح ذیل می باشند :\r\n<br/>\r\nبانک : درگاه پرداخت الکترونیک بانک ملت\r\n<br/>\r\nکد پیگیری : {payment_code}\r\n<br/>\r\nتاریخ پرداخت : {date}\r\n<br/>\r\n************************************\r\n<br/>\r\n با تشکر از اعتماد شما - گروه بازرگانی ایرانا\r\n051-38555560\r\n<br/>\r\n</p>');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `family` varchar(50) NOT NULL,
  `image` varchar(60) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(35) NOT NULL,
  `type` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `family`, `image`, `email`, `username`, `password`, `type`) VALUES
(1, 'Media', 'Teq', '', 'admin@mediateq.ir', 'admin', '432bd1bccd491f10eb6f14d7a98cba14', 0);

-- --------------------------------------------------------

--
-- Table structure for table `volumes`
--

CREATE TABLE IF NOT EXISTS `volumes` (
`id` int(11) NOT NULL,
  `fvol` tinyint(3) unsigned NOT NULL,
  `tvol` tinyint(3) unsigned NOT NULL,
  `price` double NOT NULL,
  `percent` tinyint(3) unsigned NOT NULL,
  `position` int(11) NOT NULL,
  `remove` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `volumes`
--

INSERT INTO `volumes` (`id`, `fvol`, `tvol`, `price`, `percent`, `position`, `remove`) VALUES
(1, 1, 5, 38880, 5, 0, 0),
(4, 6, 10, 28080, 5, 0, 0),
(5, 11, 99, 17280, 5, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `debtpayment`
--
ALTER TABLE `debtpayment`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `volumes`
--
ALTER TABLE `volumes`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `debtpayment`
--
ALTER TABLE `debtpayment`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=157;
--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `volumes`
--
ALTER TABLE `volumes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
