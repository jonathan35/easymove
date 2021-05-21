-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2021 at 11:50 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `easymove`
--

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `text_in_desktop` longtext DEFAULT NULL,
  `text_in_mobile` longtext DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `text_in_desktop`, `text_in_mobile`, `banner`, `position`, `status`, `created`, `modified`) VALUES
(2, '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', 'photo/60484589a24cd.jpg', 2, '1', '2020-10-27 13:28:12', '2021-03-10 12:05:29'),
(9, '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', 'photo/60497621b308e.jpg', 0, '1', '2021-03-11 09:44:45', '2021-03-11 09:45:05');

-- --------------------------------------------------------

--
-- Table structure for table `banner_dashboard`
--

CREATE TABLE `banner_dashboard` (
  `id` int(11) NOT NULL,
  `banner_dashboard` varchar(255) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `id` int(11) NOT NULL,
  `region_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `branch_name` varchar(255) DEFAULT NULL,
  `type` varchar(25) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(25) DEFAULT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `branch_location` varchar(1000) DEFAULT NULL,
  `branch_location_coordinate` varchar(255) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `region_id`, `company_id`, `branch_name`, `type`, `contact_person`, `mobile_number`, `address`, `branch_location`, `branch_location_coordinate`, `status`, `created`, `modified`) VALUES
(1, 1, 1, 'Taka Sdn. Bhd. Tabuan Branch', 'Headquarter', 'Tonny', '12121212', 'addres asdsad asdasdasd', 'Taka Patisserie, Jalan Tabuan Tranquility, Tabuan Jaya, Kuching, Sarawak, Malaysia', '1.5125012504193178,110.38926830000001', '1', '2021-04-09 15:22:31', '2021-04-12 19:32:05'),
(2, 1, 1, 'Taka sdn bhd (R.H. Plaza)', 'Branch', 'Jonny', '12312321312', 'addasda sdasdas dasdasdasdas d', 'Taka Cake House, 900B, R.H Plaza, Kuching, Sarawak, Malaysia', '1.5039154504169283,110.35120765000002', NULL, NULL, '2021-04-13 10:24:19');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `location` int(11) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `location`, `category`, `photo`, `position`, `status`, `created`, `modified`) VALUES
(1, 1, 'Mulu Caves Tours', NULL, NULL, '1', '2020-11-24 12:11:34', '2020-11-24 12:11:34'),
(2, 1, 'BEACH RESORT', NULL, 0, '2', '2020-11-24 12:11:34', '2020-11-26 11:53:59'),
(4, 1, 'National Park Tours', NULL, NULL, '1', '2020-11-24 12:11:34', '2020-11-24 12:11:34'),
(5, 1, 'Batang Ai Resort ', NULL, 0, '2', '2020-11-24 12:11:34', '2020-11-26 11:54:14'),
(6, 1, 'WILDLIFE TOURS', NULL, NULL, '1', '2020-11-24 12:11:34', '2020-11-24 12:11:34'),
(8, 1, 'Kuching Day Tours', NULL, NULL, '1', '2020-11-24 12:11:34', '2020-11-24 12:11:34'),
(9, 1, 'black coder', NULL, 0, '2', '2020-11-24 12:11:34', '2020-11-26 11:53:36'),
(10, 2, '3D/2N Mt Kinabalu Summit Trek', NULL, NULL, '0', '2020-11-24 12:11:34', '2020-11-24 12:11:34'),
(12, 2, 'K K City Tour', NULL, NULL, '0', '2020-11-24 12:11:34', '2020-11-24 12:11:34'),
(13, 2, ' Sepilok Orangutan Rehabilitation Centre', NULL, NULL, '0', '2020-11-24 12:11:34', '2020-11-24 12:11:34'),
(14, 2, '3D2N Kinabatangan River Wildlife Safari', NULL, NULL, '0', '2020-11-24 12:11:34', '2020-11-24 12:11:34'),
(15, 2, 'Sandakan Wildlife Tours', NULL, NULL, '1', '2020-11-24 12:11:34', '2020-11-24 12:11:34'),
(16, 2, 'Lok Kawi Wildlife Park', NULL, NULL, '0', '2020-11-24 12:11:34', '2020-11-24 12:11:34'),
(17, 2, '3D2N Tabin Wildlife Reserve', NULL, NULL, '0', '2020-11-24 12:11:34', '2020-11-24 12:11:34'),
(18, 2, 'Padas Whitewater Rafting', NULL, NULL, '0', '2020-11-24 12:11:34', '2020-11-24 12:11:34'),
(19, 2, 'Gaya Island', NULL, NULL, '0', '2020-11-24 12:11:34', '2020-11-24 12:11:34'),
(20, 2, 'Kinabalu Park', NULL, NULL, '1', '2020-11-24 12:11:34', '2020-11-24 12:11:34'),
(21, 2, 'Sandakan Day Tours', NULL, NULL, '1', '2020-11-24 12:11:34', '2020-11-24 12:11:34'),
(22, 2, 'Welcome To Sabah', NULL, 0, '2', '2020-11-24 12:11:34', '2020-11-26 11:54:35'),
(23, 2, 'K.K. Day Tours', NULL, NULL, '1', '2020-11-24 12:11:34', '2020-11-24 12:11:34');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `company_name`, `status`, `created`, `modified`) VALUES
(1, 'Taka Sdn. Bhd.', '1', '2021-04-09 15:18:42', '2021-04-09 15:18:42'),
(2, 'H&L Supermarket Sdn Bhd', '1', '2021-04-09 15:20:23', '2021-04-09 15:20:23');

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `title`, `content`, `status`, `created`, `modified`) VALUES
(1, 'Contact Us', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<div class=\"row\">\r\n<div class=\"col-12 col-md-12\">\r\n<p><strong style=\"font-size: 30px;\">Administration Office</strong><br /><span style=\"color: #808080;\">Sublot 47, 48 &amp; 49, Block A, 1st-3rd Flr, Demak Laut&nbsp; Commercial Centre Phase 3, Jalan Bako, Petra Jaya, Kuching, Sarawak. Malaysia.</span></p>\r\n<p><span style=\"color: #808080;\">TEL :6082-439732,&nbsp; Fax :608243976 /432359</span></p>\r\n<p>&nbsp;</p>\r\n<p><strong style=\"font-size: 30px;\">Kuala Lumpur Office<br /></strong><span style=\"color: #808080;\">Suite 8-8,8th Floor, Wisma UOA II, No 21, Jalan Pinang, 50450 Kuala Lumpur, Malaysia.</span></p>\r\n<p><span style=\"color: #808080;\">Tel :6082-21811999/603-21610178 Fax:603-21660637</span></p>\r\n<p>&nbsp;</p>\r\n</div>\r\n<div class=\"col-12 col-md-12\">\r\n<p><strong style=\"font-size: 30px;\">Sejingkat Fab. Yard</strong><br /><span style=\"color: #808080;\">Lot 343, Block 8, Muara Tebas Land District, Sejingkat, Off Jalan Bako, 93050 Kuching, Sarawak, Malaysia.<br /></span></p>\r\n<p><span style=\"color: #808080;\">Tel:6082-432640 Fax:6082433146</span></p>\r\n<p>&nbsp;</p>\r\n<p><strong style=\"font-size: 30px;\">Demak Fab. Yard </strong><br /><span style=\"color: #808080;\">Lot 1010, Block 8, Muara Tebas Land District, Demak Laut Industrial Estate Phase III, 93050 Kuching, Sarawak, Malaysia.<br /></span></p>\r\n<p><span style=\"color: #808080;\">Tel:432353 Fax:432352</span></p>\r\n<p>&nbsp;</p>\r\n</div>\r\n</div>\r\n<div class=\"row\">\r\n<div class=\"col-12\"><!--<p><iframe style=\"border: 0;\" tabindex=\"0\" src=\".google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.3454652410464!2d110.35509576004047!3d1.556877502372591!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31fba7ea00f1b6b1%3A0xcceb8f812855f8cc!2sMing%20Ming%20Travel%20Service%20Sdn.%20Bhd.!5e0!3m2!1sen!2smy!4v1609293965588!5m2!1sen!2smy\" width=\"100%\" height=\"50vh\" frameborder=\"0\" allowfullscreen=\"allowfullscreen\" aria-hidden=\"false\"></iframe></p>-->\r\n<p><a href=\".google.com/maps/place/Ming+Ming+Travel+Service+Sdn.+Bhd./@1.5568775,110.3550958,17z/data=!4m5!3m4!1s0x31fba7ea00f1b6b1:0xcceb8f812855f8cc!8m2!3d1.5571778!4d110.354849\" target=\"_blank\" rel=\"noopener\"><span style=\"color: #808080;\"><img src=\"../../photo/603341298d44b.png\" alt=\"\" width=\"1124\" height=\"576\" /></span></a></p>\r\n</div>\r\n</div>\r\n</body>\r\n</html>', '1', '2020-10-27 13:43:52', '2021-02-22 13:30:24'),
(2, 'Home Welcome', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p style=\"text-align: center;\"><br /><img src=\"../../images/logo.gif\" alt=\"\" /></p>\r\n<h1 style=\"text-align: center;\">Welcome to Borneo Tours</h1>\r\n<div class=\"row\" style=\"text-align: center;\">\r\n<div class=\"col-12 col-md-8 offset-md-2\">Welcome to the world of Inter-Borneo Tours! A family runs business to realize the love of travel; to search for new vistas and experience and to see for ourselves the rich diversity of history, people and their cultures that make up the world.</div>\r\n</div>\r\n<p style=\"text-align: center;\"><br /><br /></p>\r\n</body>\r\n</html>', NULL, '2020-10-27 13:43:52', '2020-11-30 10:23:54');

-- --------------------------------------------------------

--
-- Table structure for table `developer`
--

CREATE TABLE `developer` (
  `id` int(11) NOT NULL,
  `developer_photo` varchar(255) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `developer`
--

INSERT INTO `developer` (`id`, `developer_photo`, `position`, `status`, `created`, `modified`) VALUES
(1, 'photo/5fa0aed81c68e.png', 1, '1', '2020-10-27 13:36:40', '2020-11-03 09:14:00'),
(2, 'photo/5fa0aeeb8a211.png', 2, '1', '2020-10-27 13:36:43', '2020-11-03 09:14:19'),
(3, 'photo/5fa0af0e2a35d.jpg', 3, '1', '2020-10-27 13:36:48', '2020-11-03 09:14:54'),
(4, 'photo/5fa0af137c1b4.png', 4, '1', '2020-10-27 13:36:52', '2020-11-03 09:14:59'),
(5, 'photo/5fa0af1a14eb1.jpg', 5, '1', '2020-10-27 13:36:58', '2020-11-03 09:15:06'),
(6, 'photo/5fa0af216b190.jpg', 6, '1', '2020-10-27 13:37:01', '2020-11-03 09:15:13'),
(7, 'photo/5fa0af296d32f.jpg', 7, '1', '2020-10-27 13:37:57', '2020-11-03 09:15:21');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `id` int(11) NOT NULL,
  `region` int(11) DEFAULT NULL,
  `vehicle_type` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `working_time` varchar(25) DEFAULT NULL,
  `mobile_number` int(11) DEFAULT NULL,
  `emergency_contact_number` varchar(1000) DEFAULT NULL,
  `plate_number` varchar(255) DEFAULT NULL,
  `branch_location_coordinate` varchar(255) DEFAULT NULL,
  `vehicle_belonging` varchar(255) DEFAULT NULL,
  `photo_of_ic` varchar(255) DEFAULT NULL,
  `photo_of_driving_license` varchar(255) DEFAULT NULL,
  `vehicle_front_view` varchar(255) DEFAULT NULL,
  `vehicle_back_view` varchar(255) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`id`, `region`, `vehicle_type`, `name`, `working_time`, `mobile_number`, `emergency_contact_number`, `plate_number`, `branch_location_coordinate`, `vehicle_belonging`, `photo_of_ic`, `photo_of_driving_license`, `vehicle_front_view`, `vehicle_back_view`, `status`, `created`, `modified`) VALUES
(1, 1, 1, 'Jonathan', 'full', 2147483647, '0123213213', '123213213', NULL, 'Jonathan', 'photo/6073ec22d5882.jpg', 'photo/6073ec22d753d.jpg', 'photo/6073ec22d898e.jpg', 'photo/6073ec3b87145.jpg', '1', '2021-04-12 14:43:46', '2021-04-12 14:52:23');

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE `guest` (
  `id` int(11) NOT NULL,
  `session` varchar(255) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `ic` varchar(255) DEFAULT NULL,
  `sarawakian` varchar(3) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`id`, `session`, `item_id`, `first_name`, `last_name`, `ic`, `sarawakian`, `created`, `modified`) VALUES
(1, 'hls8h47htmk9fkjtu0pujtm0sv', 27, 'Ali', 'Abu', '2222', 'on', '2021-01-04 18:27:13', '2021-01-04 19:39:33'),
(2, 'hls8h47htmk9fkjtu0pujtm0sv', 26, 'Ali', 'Abu', '2222', 'on', '2021-01-04 18:27:13', '2021-01-04 19:02:04'),
(3, 'hls8h47htmk9fkjtu0pujtm0sv', 28, 'G2', 'G22', '444', 'on', '2021-01-04 19:39:33', '2021-01-04 19:45:24'),
(4, 'n1sgparkp3l9upi01spkukk5ur', 29, 'Jonathan1', 'wong2', '1111', 'off', '2021-01-08 15:48:01', '2021-01-08 16:10:06'),
(5, 'n1sgparkp3l9upi01spkukk5ur', 30, 'aaa', 'bbhb', '2222', 'on', '2021-01-08 15:48:01', '2021-01-08 16:10:06'),
(6, 'duhjflootihakjt5jmmpgr9h6p', 31, 'Jonathan', 'wong', '1221212212121212', 'on', '2021-01-12 09:22:42', '2021-01-12 09:22:42'),
(7, 'duhjflootihakjt5jmmpgr9h6p', 32, 'Jonathan', 'woon', '23443523453425', 'on', '2021-01-12 09:24:52', '2021-01-12 09:24:52'),
(8, '16g0ujs5nae42klur9e4ov4goq', 33, 'Jonathan', 'wong', '2323423435232453245', 'on', '2021-01-12 09:29:32', '2021-01-12 09:29:32'),
(9, '8qlc3abjk8pitfojvoga7ilr96', 35, 'mark ', 'lee', 'xxxxxxxxxx', 'on', '2021-01-13 10:00:55', '2021-01-13 10:00:55'),
(10, '8qlc3abjk8pitfojvoga7ilr96', 36, 'louis ', 'abeng', 'ccccccc', 'off', '2021-01-13 10:05:39', '2021-01-13 10:05:39'),
(11, '8qlc3abjk8pitfojvoga7ilr96', 38, 'ah ', 'peng', '123456', 'off', '2021-01-13 11:51:22', '2021-01-13 11:51:22');

-- --------------------------------------------------------

--
-- Table structure for table `home_block`
--

CREATE TABLE `home_block` (
  `id` int(11) NOT NULL,
  `block_text` varchar(255) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `home_block`
--

INSERT INTO `home_block` (`id`, `block_text`, `position`, `status`, `created`, `modified`) VALUES
(1, 'Numerous of deals done', 1, '1', '2020-10-27 13:42:15', '2020-10-27 13:42:15'),
(2, '40 team members at your services', 2, '1', '2020-10-27 13:42:26', '2020-10-27 13:42:26'),
(3, '24/7 available around the clock', 3, '1', '2020-10-27 13:42:33', '2020-10-27 13:42:33');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `session` varchar(255) DEFAULT NULL,
  `tour_id` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date` varchar(10) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit_price` decimal(11,2) DEFAULT NULL,
  `total_price` decimal(11,2) DEFAULT NULL,
  `sarawakian_unit_price` decimal(11,2) DEFAULT NULL,
  `sarawakian_total_price` decimal(11,2) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `session`, `tour_id`, `photo`, `name`, `date`, `quantity`, `unit_price`, `total_price`, `sarawakian_unit_price`, `sarawakian_total_price`, `status`, `created`, `modified`) VALUES
(29, 'n1sgparkp3l9upi01spkukk5ur', 40, 'photo/55f7b5f35c098.jpg', '5D4N Mulu headhunters Trail', '2021-01-27', 1, '2150.00', '2150.00', NULL, NULL, NULL, '2021-01-08 15:46:23', '2021-01-08 15:46:23'),
(30, 'n1sgparkp3l9upi01spkukk5ur', 101, 'photo/5fd845fd4ba36.jpg', 'BAKO NATIONAL PARK (DAY TRIP)', '2021-01-27', 1, '220.00', '220.00', '110.00', '110.00', NULL, '2021-01-08 15:47:36', '2021-01-08 16:10:06'),
(32, 'duhjflootihakjt5jmmpgr9h6p', 60, 'photo/5576a18c03178.jpg', 'BOS-7D K K City Tour', '2021-01-20', 1, '100.00', '100.00', '50.00', '50.00', NULL, '2021-01-12 09:24:37', '2021-01-12 09:24:52'),
(33, '16g0ujs5nae42klur9e4ov4goq', 63, 'photo/54f96616c895b.jpg', 'Orangutans & Monkeys', '2021-01-13', 1, '100.00', '100.00', '50.00', '50.00', NULL, '2021-01-12 09:29:23', '2021-01-12 09:29:32'),
(40, 's5hlgrrhcj4uhnhq8n4tqeqhqb', 60, 'photo/5576a18c03178.jpg', 'BOS-7D K K City Tour', '2021-01-26', 1, '100.00', '100.00', NULL, NULL, NULL, '2021-01-18 17:09:04', '2021-01-18 17:09:04'),
(39, 'gj5k35jmhdfe4pgb72o8j0302t', 63, 'photo/54f96616c895b.jpg', 'Orangutans & Monkeys', '2021-01-20', 1, '100.00', '100.00', NULL, NULL, NULL, '2021-01-14 09:53:04', '2021-01-14 09:53:04'),
(38, '8qlc3abjk8pitfojvoga7ilr96', 60, 'photo/5576a18c03178.jpg', 'BOS-7D K K City Tour', '2021-01-22', 1, '100.00', '100.00', NULL, NULL, NULL, '2021-01-13 11:11:49', '2021-01-13 11:11:49'),
(22, 'hls8h47htmk9fkjtu0pujtm0sv', 60, 'photo/5576a18c03178.jpg', 'BOS-7D K K City Tour', '2021-01-12', 1, '100.00', '100.00', '50.00', '50.00', NULL, '2021-01-04 11:38:10', '2021-01-04 19:45:24'),
(28, 'hls8h47htmk9fkjtu0pujtm0sv', 39, 'photo/5fc09048093f1.jpg', 'Annah Rais Bidayuh Longhouse', '2021-01-20', 2, '400.00', '800.00', '200.00', '400.00', NULL, '2021-01-04 19:45:06', '2021-01-04 19:45:24');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `admin_group` int(11) DEFAULT NULL,
  `region` int(11) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(150) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `temp_password` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `admin_group`, `region`, `name`, `email`, `username`, `password`, `temp_password`, `status`, `created`, `modified`) VALUES
(1, 1, 5, 'Administrator', 'jonathan.wphp@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', NULL, 1, '2020-07-30 14:31:35', '2020-09-04 15:47:13'),
(3, 2, 1, 'jonathan', 'jonathan.wphp@gmail.com', 'jonathan', 'a4e383d5c41e7c852c1fc0d6dd85f117', NULL, 1, '2021-04-08 16:57:56', '2021-04-08 16:57:56'),
(4, 1, 1, 'Kuching', 'kuching@asdasd.com', 'kuching', 'afa47cbc204eb255a23b159fe0a1a079', NULL, 1, '2021-04-08 16:58:30', '2021-04-08 16:58:30');

-- --------------------------------------------------------

--
-- Table structure for table `merchant`
--

CREATE TABLE `merchant` (
  `id` int(11) NOT NULL,
  `company` int(11) DEFAULT NULL,
  `branch` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `temp_password` varchar(255) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `merchant`
--

INSERT INTO `merchant` (`id`, `company`, `branch`, `username`, `password`, `temp_password`, `status`, `created`, `modified`) VALUES
(1, 1, 1, 'Takatabuan1', '0cfa2db0ddd8fd49eda7645f3b79f284', NULL, '1', '2021-04-09 15:22:31', '2021-04-13 14:47:08'),
(2, 1, 2, 'Takarhplaza1', '72b8e1a17d9fd2dc85a514e2ebe402e7', NULL, '1', '2021-04-13 10:40:16', '2021-04-13 14:18:18'),
(3, 1, 2, 'Takatabuan1', 'Takatabuan1', NULL, '1', '2021-04-13 14:34:30', '2021-04-13 14:46:01');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `tour` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `message` longtext DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `date` varchar(19) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `tour`, `name`, `email`, `contact`, `message`, `status`, `date`, `created`, `modified`) VALUES
(6, 'BOS-5C 3D2N Mulu Cave Splendor   ', 'Ali', 'ali@ali.com', '12121212', 'ali message ', 'Read', '2020-11-27 11:28:25', '2020-11-27 11:28:25', '2020-12-17 15:27:59'),
(4, 'Package', 'Jonathan Wong', 'jonathan.wphp@gmail.com', '0168653947', 'Testing message, can i ask you about the location. asdsadsdasdsadsadsadd asd', 'New', '2020-10-30 14:57:47', '2020-10-30 14:57:47', '2020-11-03 17:46:10'),
(5, 'BOS/2A Bako National Park', 'Jonathan', 'jonathan@gmail.com', '111', 'asdsad', 'New', '2020-11-25 16:49:14', '2020-11-25 16:49:14', '2020-11-25 16:50:56'),
(7, '2D1N KAMPUNG STING, BENGOH, PADAWAN', 'Jonathana ', 'qwq@asdsad.com', 'wwqe', 'asdasdasdas dsadas dd', 'Read', '2021-01-08 15:44:06', '2021-01-08 15:44:06', '2021-01-12 13:38:15');

-- --------------------------------------------------------

--
-- Table structure for table `message_contact`
--

CREATE TABLE `message_contact` (
  `id` int(11) NOT NULL,
  `region` varchar(255) DEFAULT NULL,
  `zone` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `business_field` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `date` varchar(19) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message_contact`
--

INSERT INTO `message_contact` (`id`, `region`, `zone`, `company_name`, `business_field`, `mobile_number`, `address`, `status`, `date`, `created`, `modified`) VALUES
(1, '1', '1', 'Jonathan', '3242343423', '23222222', 'asdasdasd asdasdasd', 'New', '2021-04-08 16:43:25', '2021-04-08 16:43:25', '2021-04-08 16:43:25'),
(2, '1', '1', 'Jonathan', '3242343423', '23222222', 'asdasdasd asdasdasd', 'Read', '2021-04-08 16:44:03', '2021-04-08 16:44:03', '2021-04-09 15:30:26');

-- --------------------------------------------------------

--
-- Table structure for table `navigator`
--

CREATE TABLE `navigator` (
  `id` int(11) NOT NULL,
  `section` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `news_date` date DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `conceal_date` date DEFAULT NULL,
  `file_attachment` varchar(255) DEFAULT NULL,
  `news_content` longtext DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `photo`, `news_date`, `release_date`, `conceal_date`, `file_attachment`, `news_content`, `position`, `status`, `created`, `modified`) VALUES
(1, 'About Our Services', 'photo/606e9de57132f.jpg', '2021-04-15', '2021-04-15', '2021-12-15', NULL, 'Take your brand to the next level by customizing your own promotional message to your receivers! With marketing tools, you can now bring your brand to light and make your promotional message pop in front of your customers.', 2, '1', '2020-11-03 17:40:34', '2021-04-09 16:15:17'),
(3, 'Sign Up as Merchant Today!', 'photo/60700cfb1150f.jpg', '2021-04-09', '2021-04-23', '2021-09-16', NULL, 'Grow your business and reach more hungry customers with online food delivery! Click here to find out more how to be a EasyDelivery Merchant-partner today!', 3, '1', '2021-04-09 16:14:51', '2021-04-09 16:14:51'),
(2, 'Welcome to Our New Website', 'photo/606e9d60eaff6.jpg', '2021-04-15', '2021-04-15', '2021-12-15', 'photo/5fa1277a80a83.png', 'Welcome to Our New Website. So needless to say, it is important that your website is doing the best job it can, representing your company and brand. Nothing reflects worse on a brand than a static and archaic website. Are you questioning whether its time for a new redesign for your company’s website? If so, we’ve compiled a list of some critical reasons to consider building a new website.', 1, '1', '2020-11-03 17:48:42', '2021-04-08 14:09:05');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `session` varchar(255) DEFAULT NULL,
  `trip` int(11) DEFAULT NULL,
  `region` int(11) DEFAULT NULL,
  `zone` int(11) DEFAULT NULL,
  `company` int(11) DEFAULT NULL,
  `branch` int(11) DEFAULT NULL,
  `branch_name` varchar(255) DEFAULT NULL,
  `merchant` int(11) DEFAULT NULL,
  `driver` int(11) DEFAULT NULL,
  `driver_name` varchar(255) DEFAULT NULL,
  `driver_phone` varchar(255) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `origin` varchar(400) DEFAULT NULL,
  `destination` varchar(400) DEFAULT NULL,
  `origin_coordinate` varchar(400) DEFAULT NULL,
  `destination_coordinate` varchar(400) DEFAULT NULL,
  `distance` decimal(11,2) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `time` varchar(25) DEFAULT NULL,
  `message` longtext DEFAULT NULL,
  `requirement` longtext DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL,
  `accepted_datetime` datetime DEFAULT NULL,
  `collected_datetime` datetime DEFAULT NULL,
  `delivered_datetime` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `session`, `trip`, `region`, `zone`, `company`, `branch`, `branch_name`, `merchant`, `driver`, `driver_name`, `driver_phone`, `customer_name`, `phone`, `origin`, `destination`, `origin_coordinate`, `destination_coordinate`, `distance`, `address`, `time`, `message`, `requirement`, `status`, `accepted_datetime`, `collected_datetime`, `delivered_datetime`, `created`, `modified`) VALUES
(1, 'cpcm2kfeb6cn4q962sqo31ph0j', 2, 1, 1, 1, 1, 'Taka Sdn. Bhd. Tabuan Branch', 1, NULL, NULL, NULL, 'Jonathan', '016837745675', 'Taka Patisserie, Jalan Tabuan Tranquility, Tabuan Jaya, Kuching, Sarawak, Malaysia', 'A.S.D Solutions Company, Wee Kheng Chiang, Jalan Datuk Wee Kheng Chiang, Kuching, Sarawak, Malaysia', '1.5125012504193178,110.38926830000001', '1.5526371504304401,110.36251260000003', '9.50', '12', '23:46', 'Additional Message.. Additional Message.. Additional Message.. ', 'Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. ', 'Collected', NULL, NULL, NULL, '2021-04-14 21:52:23', '2021-04-14 21:52:23'),
(2, 'cpcm2kfeb6cn4q962sqo31ph0j', 2, 1, 1, 1, 1, 'Taka Sdn. Bhd. Tabuan Branch', 1, NULL, NULL, NULL, 'Ali', '016837745675', 'Taka Patisserie, Jalan Tabuan Tranquility, Tabuan Jaya, Kuching, Sarawak, Malaysia', 'A.S.D Solutions Company, Wee Kheng Chiang, Jalan Datuk Wee Kheng Chiang, Kuching, Sarawak, Malaysia', '1.5125012504193178,110.38926830000001', '1.5526371504304401,110.36251260000003', '9.50', '12', '23:46', 'Additional Message.. Additional Message.. Additional Message.. ', 'Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. ', 'Accepted', NULL, NULL, NULL, '2021-04-14 21:53:02', '2021-04-14 21:53:02'),
(3, 'cpcm2kfeb6cn4q962sqo31ph0j', 2, 1, 1, 1, 1, 'Taka Sdn. Bhd. Tabuan Branch', 1, NULL, NULL, NULL, 'John', '016837745675', 'Taka Patisserie, Jalan Tabuan Tranquility, Tabuan Jaya, Kuching, Sarawak, Malaysia', 'A.S.D Solutions Company, Wee Kheng Chiang, Jalan Datuk Wee Kheng Chiang, Kuching, Sarawak, Malaysia', '1.5125012504193178,110.38926830000001', '1.5526371504304401,110.36251260000003', '9.50', '12', '23:46', 'Additional Message.. Additional Message.. Additional Message.. ', 'Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. ', 'Delivering', NULL, NULL, NULL, '2021-04-14 21:53:03', '2021-04-14 21:53:03'),
(4, 'cpcm2kfeb6cn4q962sqo31ph0j', 2, 1, 1, 1, 1, 'Taka Sdn. Bhd. Tabuan Branch', 1, NULL, NULL, NULL, 'Wong', '016837745675', 'Taka Patisserie, Jalan Tabuan Tranquility, Tabuan Jaya, Kuching, Sarawak, Malaysia', 'A.S.D Solutions Company, Wee Kheng Chiang, Jalan Datuk Wee Kheng Chiang, Kuching, Sarawak, Malaysia', '1.5125012504193178,110.38926830000001', '1.5526371504304401,110.36251260000003', '9.50', '12', '23:46', 'Additional Message.. Additional Message.. Additional Message.. ', 'Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. ', 'Received', NULL, NULL, NULL, '2021-04-14 21:53:04', '2021-04-14 21:53:04'),
(5, 'cpcm2kfeb6cn4q962sqo31ph0j', 2, 1, 1, 1, 1, 'Taka Sdn. Bhd. Tabuan Branch', 1, NULL, NULL, NULL, 'Joe', '016837745675', 'Taka Patisserie, Jalan Tabuan Tranquility, Tabuan Jaya, Kuching, Sarawak, Malaysia', 'A.S.D Solutions Company, Wee Kheng Chiang, Jalan Datuk Wee Kheng Chiang, Kuching, Sarawak, Malaysia', '1.5125012504193178,110.38926830000001', '1.5526371504304401,110.36251260000003', '9.50', '12', '23:46', 'Additional Message.. Additional Message.. Additional Message.. ', 'Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. ', 'Ordered', NULL, NULL, NULL, '2021-04-14 21:53:06', '2021-04-14 21:53:06'),
(6, 'cpcm2kfeb6cn4q962sqo31ph0j', 2, 1, 1, 1, 1, 'Taka Sdn. Bhd. Tabuan Branch', 1, NULL, NULL, NULL, 'Tonny', '016837745675', 'Taka Patisserie, Jalan Tabuan Tranquility, Tabuan Jaya, Kuching, Sarawak, Malaysia', 'A.S.D Solutions Company, Wee Kheng Chiang, Jalan Datuk Wee Kheng Chiang, Kuching, Sarawak, Malaysia', '1.5125012504193178,110.38926830000001', '1.5526371504304401,110.36251260000003', '9.50', '12', '23:46', 'Additional Message.. Additional Message.. Additional Message.. ', 'Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. ', 'Ordered', NULL, NULL, NULL, '2021-04-14 21:53:10', '2021-04-14 21:53:10'),
(7, 'cpcm2kfeb6cn4q962sqo31ph0j', 2, 1, 1, 1, 1, 'Taka Sdn. Bhd. Tabuan Branch', 1, NULL, NULL, NULL, 'Clar', '016837745675', 'Taka Patisserie, Jalan Tabuan Tranquility, Tabuan Jaya, Kuching, Sarawak, Malaysia', 'A.S.D Solutions Company, Wee Kheng Chiang, Jalan Datuk Wee Kheng Chiang, Kuching, Sarawak, Malaysia', '1.5125012504193178,110.38926830000001', '1.5526371504304401,110.36251260000003', '9.50', '12', '23:46', 'Additional Message.. Additional Message.. Additional Message.. ', 'Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. ', 'Ordered', NULL, NULL, NULL, '2021-04-14 21:53:11', '2021-04-14 21:53:11'),
(8, 'cpcm2kfeb6cn4q962sqo31ph0j', 2, 1, 1, 1, 1, 'Taka Sdn. Bhd. Tabuan Branch', 1, NULL, NULL, NULL, 'Jonathan', '016837745675', 'Taka Patisserie, Jalan Tabuan Tranquility, Tabuan Jaya, Kuching, Sarawak, Malaysia', 'A.S.D Solutions Company, Wee Kheng Chiang, Jalan Datuk Wee Kheng Chiang, Kuching, Sarawak, Malaysia', '1.5125012504193178,110.38926830000001', '1.5526371504304401,110.36251260000003', '9.50', '12', '23:46', 'Additional Message.. Additional Message.. Additional Message.. ', 'Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. ', 'Ordered', NULL, NULL, NULL, '2021-04-14 21:53:12', '2021-04-14 21:53:12'),
(9, 'cpcm2kfeb6cn4q962sqo31ph0j', 2, 1, 1, 1, 1, 'Taka Sdn. Bhd. Tabuan Branch', 1, NULL, NULL, NULL, 'Abdul', '016837745675', 'Taka Patisserie, Jalan Tabuan Tranquility, Tabuan Jaya, Kuching, Sarawak, Malaysia', 'A.S.D Solutions Company, Wee Kheng Chiang, Jalan Datuk Wee Kheng Chiang, Kuching, Sarawak, Malaysia', '1.5125012504193178,110.38926830000001', '1.5526371504304401,110.36251260000003', '9.50', '12', '23:46', 'Additional Message.. Additional Message.. Additional Message.. ', 'Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. ', 'Ordered', NULL, NULL, NULL, '2021-04-14 21:53:24', '2021-04-14 21:53:24'),
(10, 'cpcm2kfeb6cn4q962sqo31ph0j', 4, 1, 1, 1, 2, 'Taka sdn bhd (R.H. Plaza)', 2, NULL, NULL, NULL, 'Plaza customer name', '099846782', 'Taka Cake House, 900B, R.H Plaza, Kuching, Sarawak, Malaysia', 'Siburan New Township, Siburan, Sarawak, Malaysia', '1.5039154504169283,110.35120765000002', '1.3451253003729107,110.40779844999999', '26.60', 'lot 20, 2nd floor', '22:35', 'asd asd asdasd asdas dasdsd', 'no need', 'Ordered', NULL, NULL, NULL, '2021-04-14 23:12:25', '2021-04-14 23:12:25'),
(11, 'cpcm2kfeb6cn4q962sqo31ph0j', 4, 1, 1, 1, 2, 'Taka sdn bhd (R.H. Plaza)', 2, NULL, NULL, NULL, 'Plaza customer name', '099846782', 'Taka Cake House, 900B, R.H Plaza, Kuching, Sarawak, Malaysia', 'Siburan New Township, Siburan, Sarawak, Malaysia', '1.5039154504169283,110.35120765000002', '1.3451253003729107,110.40779844999999', '26.60', 'lot 20, 2nd floor', '22:35', 'asd asd asdasd asdas dasdsd', 'no need', 'Ordered', NULL, NULL, NULL, '2021-04-14 23:13:33', '2021-04-14 23:13:33');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `position`, `status`, `content`, `created`, `modified`) VALUES
(1, 'About Us', 1, '1', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<div class=\"row\">About Us content here</div>\r\n<div class=\"row\">&nbsp;</div>\r\n<div class=\"row\">&nbsp;</div>\r\n<div class=\"row\">&nbsp;</div>\r\n<div class=\"row\">&nbsp;</div>\r\n<div class=\"row\">&nbsp;</div>\r\n<div class=\"row\">&nbsp;</div>\r\n<div class=\"row\">&nbsp;</div>\r\n<div class=\"row\">&nbsp;</div>\r\n<div class=\"row\">&nbsp;</div>\r\n<div class=\"row\">&nbsp;</div>\r\n<div class=\"row\">&nbsp;</div>\r\n</body>', '2020-10-27 13:43:52', '2021-04-08 14:02:41'),
(3, 'Gallery', 2, '2', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Gallery here</p>\r\n</body>\r\n</html>', '2020-12-31 17:14:14', '2021-03-10 12:33:31'),
(2, 'Services', 0, '2', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>', '2020-10-27 13:44:23', '2020-11-14 12:50:05');

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateway`
--

CREATE TABLE `payment_gateway` (
  `id` int(11) NOT NULL,
  `para1` varchar(255) DEFAULT NULL,
  `para2` varchar(255) DEFAULT NULL,
  `para3` varchar(255) DEFAULT NULL,
  `para4` varchar(255) DEFAULT NULL,
  `para5` varchar(255) DEFAULT NULL,
  `para6` varchar(255) DEFAULT NULL,
  `para7` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_gateway`
--

INSERT INTO `payment_gateway` (`id`, `para1`, `para2`, `para3`, `para4`, `para5`, `para6`, `para7`, `status`, `created`, `modified`) VALUES
(1, 'paypal', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-09-04 13:50:26', '2021-01-04 17:27:33'),
(2, 'eghl', 'testing_server', 'sit', 'sit12345', NULL, NULL, NULL, 1, NULL, '2020-09-29 12:13:00'),
(3, 'PayPal', 'testing_server', 'sb-zv43ii3073669@business.example.com', NULL, NULL, NULL, NULL, 1, NULL, '2020-09-07 15:02:58'),
(4, 'revpay', 'live_server', 'MER00000000466', 'AwrvLjTvji', NULL, NULL, NULL, 1, NULL, '2020-11-06 11:11:58');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `parent_table` varchar(255) DEFAULT NULL,
  `parent_id` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `parent_table`, `parent_id`, `status`, `position`, `photo`, `created`, `modified`) VALUES
(10, 'property', '1', '1', 0, 'photo/5fa0af4082d05.jpg', '2020-11-03 09:15:44', '2020-11-03 09:15:44'),
(9, 'property', '1', '1', 0, 'photo/5fa0af4081fe4.jpg', '2020-11-03 09:15:44', '2020-11-03 09:15:44'),
(8, 'property', '1', '1', 0, 'photo/5fa0af408122f.jpg', '2020-11-03 09:15:44', '2020-11-03 09:15:44'),
(7, 'property', '1', '1', 0, 'photo/5fa0af40808e6.jpg', '2020-11-03 09:15:44', '2020-11-03 09:15:44'),
(6, 'property', '1', '1', 0, 'photo/5fa0af407fe86.jpg', '2020-11-03 09:15:44', '2020-11-03 09:15:44'),
(32, 'pages', '0', '1', 0, 'photo/60334b0b307b2.gif', '2021-02-22 14:11:23', '2021-02-22 14:11:23'),
(33, 'pages', '0', '1', 0, 'photo/60334b0ea4db1.gif', '2021-02-22 14:11:26', '2021-02-22 14:11:26'),
(13, 'tour', '0', '1', 0, 'photo/5fc07bbae43eb.jpg', '2020-11-27 12:08:26', '2020-11-27 12:08:26'),
(14, 'tour', '0', '1', 0, 'photo/5fc07bc641231.jpg', '2020-11-27 12:08:38', '2020-11-27 12:08:38'),
(15, 'tour', '0', '1', 0, 'photo/5fd1ca847f4a2.jpg', '2020-12-10 15:13:08', '2020-12-10 15:13:08'),
(16, 'tour', '0', '1', 0, 'photo/5fd1d5a8536dd.jpg', '2020-12-10 16:00:40', '2020-12-10 16:00:40'),
(17, 'tour', '0', '1', 0, NULL, '2020-12-10 16:00:43', '2020-12-10 16:00:43'),
(18, 'tour', '0', '1', 0, 'photo/5fd1d9026df43.jpg', '2020-12-10 16:14:58', '2020-12-10 16:14:58'),
(19, 'tour', '0', '1', 0, 'photo/5fd1d9305fe0a.jpg', '2020-12-10 16:15:44', '2020-12-10 16:15:44'),
(20, 'tour', '0', '1', 0, 'photo/5fd81df02c991.jpg', '2020-12-15 10:22:40', '2020-12-15 10:22:40'),
(21, 'tour', '0', '1', 0, 'photo/5fd841eed7561.jpg', '2020-12-15 12:56:14', '2020-12-15 12:56:14'),
(22, 'tour', '0', '1', 0, NULL, '2020-12-15 12:56:16', '2020-12-15 12:56:16'),
(23, 'tour', '0', '1', 0, 'photo/5fd84b7626f0c.jpg', '2020-12-15 13:36:54', '2020-12-15 13:36:54'),
(24, 'tour', '0', '1', 0, NULL, '2020-12-15 13:36:55', '2020-12-15 13:36:55'),
(25, 'tour', '0', '1', 0, 'photo/5fd852d6d3959.jpg', '2020-12-15 14:08:22', '2020-12-15 14:08:22'),
(26, 'tour', '0', '1', 0, NULL, '2020-12-15 14:08:24', '2020-12-15 14:08:24'),
(27, 'tour', '0', '1', 0, 'photo/5fd862c47c9e5.jpg', '2020-12-15 15:16:20', '2020-12-15 15:16:20'),
(28, 'content', '0', '1', 0, 'photo/5fdc07561d0c5.png', '2020-12-18 09:35:18', '2020-12-18 09:35:18'),
(30, 'content', '0', '1', 0, 'photo/603341298d44b.png', '2021-02-22 13:29:13', '2021-02-22 13:29:13'),
(31, 'pages', '0', '1', 0, 'photo/6033455a5e7d1.jpg', '2021-02-22 13:47:06', '2021-02-22 13:47:06');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `location` int(11) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `departure` varchar(255) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `validity_from` date DEFAULT NULL,
  `validity_to` date DEFAULT NULL,
  `sunday_sales` varchar(3) DEFAULT NULL,
  `monday_sales` varchar(3) DEFAULT NULL,
  `tuesday_sales` varchar(3) DEFAULT NULL,
  `wednesday_sales` varchar(3) DEFAULT NULL,
  `thursday_sales` varchar(3) DEFAULT NULL,
  `friday_sales` varchar(3) DEFAULT NULL,
  `saturday_sales` varchar(3) DEFAULT NULL,
  `min_travellers` int(11) DEFAULT NULL,
  `physical_level` varchar(25) DEFAULT NULL,
  `deletelater_brief_description` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `popular` varchar(3) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `location`, `category`, `photo`, `name`, `price`, `duration`, `departure`, `stock`, `validity_from`, `validity_to`, `sunday_sales`, `monday_sales`, `tuesday_sales`, `wednesday_sales`, `thursday_sales`, `friday_sales`, `saturday_sales`, `min_travellers`, `physical_level`, `deletelater_brief_description`, `description`, `popular`, `position`, `status`, `created`, `modified`) VALUES
(5, 1, 8, 'photo/603358e5d365d.jpg', 'Fabrication of Offshore Modules', '100.00', '1.5 hours', 'Daily', 10, '2020-12-18', '2021-12-18', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 1, 'Medium', 'Embark on M.V. Equatorial Sunset Cruise at Kuching Waterfront for an experience of a life time cruising along the legendary Sarawak River. Here time stands still and is very the same when the first white Rajah Sir James Brooke sailed into Kuching 175 years ago.', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p><strong>Fabrication of Offshore Modules</strong></p>\r\n<ul>\r\n<li>Drilling Platforms</li>\r\n<li>Gas Compression / Production Modules</li>\r\n<li>Water Injection Platforms</li>\r\n</ul>\r\n</body>\r\n</html>', 'Yes', 0, '1', '2020-11-24 12:12:42', '2021-02-22 15:10:29'),
(99, 1, 1, 'photo/6033592a541ee.jpg', 'Turnkey (EPCIC) for Offshore Marginal Field Development  ', '0.00', '2 DAYS 1 NIGHTS', 'KUCHING', 10, '2020-12-18', '2021-12-18', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 1, 'Medium', 'What was once an 8-hour hike to a Bidayuh Village is now a 15-minute boat ride away surrounded by scenic mountainous backdrops across the majestic Bengoh Lake (1 hour from Kuching). Many waterfalls and streams flow into the Bengoh Lake which now serves as a water catchment for Kuching. Hike towards Kling Waterfall for a cold dip awaits you while a sumptuous picnic native lunch is being prepared.\r\n\r\nThereafter proceed to the picturesque Susung waterfalls. Your overnight stay at Kampung Sting high above the lake will yet be another highlight as you take in the beautiful scenery of the lake.', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Turnkey (EPCIC) for Offshore Marginal Field Development&nbsp;</p>\r\n</body>\r\n</html>', 'Yes', 0, '1', '2020-12-10 15:13:26', '2021-02-22 15:11:51'),
(60, 2, 23, 'photo/6033520e30057.jpg', 'Two Semi Submersible Oil Rig Near Shore', '100.00', '3 Hours', '9.am & 2.pm', 10, '2020-12-18', '2021-12-18', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 1, '', '', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<div class=\"product-info-top\"><strong>PowerPoint presentation slides</strong>\r\n<p>Presenting this set of slides with name Two Semi Submersible Oil Rig Near Shore. The topics discussed in these slides are Oil Rig, Central Processing, Gas. This is a completely editable PowerPoint presentation and is available for immediate download. Download now and impress your audience.</p>\r\n</div>\r\n</body>\r\n</html>', NULL, 0, '1', '2020-11-24 12:12:42', '2021-02-22 15:05:21');

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE `region` (
  `id` int(11) NOT NULL,
  `region` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`id`, `region`, `position`, `status`, `created`, `modified`) VALUES
(1, 'Kuching', 1, '1', '2021-04-08 14:55:10', '2021-04-08 14:55:10'),
(2, 'Sibu', 2, '1', '2021-04-08 14:55:19', '2021-04-08 14:55:19'),
(3, 'Miri', 3, '1', '2021-04-08 14:55:27', '2021-04-08 14:55:27');

-- --------------------------------------------------------

--
-- Table structure for table `trip`
--

CREATE TABLE `trip` (
  `id` int(11) NOT NULL,
  `branch` int(11) DEFAULT NULL,
  `trip_distance` int(11) DEFAULT NULL,
  `topup_trip` int(11) DEFAULT NULL,
  `trip_balance` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trip`
--

INSERT INTO `trip` (`id`, `branch`, `trip_distance`, `topup_trip`, `trip_balance`, `created`, `modified`) VALUES
(1, 1, 20, 44, NULL, '2021-04-12 13:18:00', '2021-04-12 13:46:42'),
(2, 1, 30, 222, 122, '2021-04-12 13:19:00', '2021-04-12 13:47:01'),
(3, 2, 10, 1000, 1000, '2021-04-14 22:41:30', '2021-04-14 22:41:30'),
(4, 2, 30, 1000, 993, '2021-04-14 22:41:41', '2021-04-14 23:13:33'),
(5, 2, 50, 1000, 1000, '2021-04-14 22:41:46', '2021-04-14 22:41:46');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_type`
--

CREATE TABLE `vehicle_type` (
  `id` int(11) NOT NULL,
  `vehicle_type` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle_type`
--

INSERT INTO `vehicle_type` (`id`, `vehicle_type`, `description`, `position`, `status`, `created`, `modified`) VALUES
(1, 'Motobyte', 'Motobyte', 1, 1, '2021-04-12 14:13:48', '2021-04-12 14:14:22'),
(2, 'Van', 'Van (6 to 11 pessenger)', 2, 1, '2021-04-12 14:14:48', '2021-04-12 14:14:48');

-- --------------------------------------------------------

--
-- Table structure for table `zone`
--

CREATE TABLE `zone` (
  `id` int(11) NOT NULL,
  `region` int(11) DEFAULT NULL,
  `zone` varchar(255) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zone`
--

INSERT INTO `zone` (`id`, `region`, `zone`, `position`, `status`, `created`, `modified`) VALUES
(1, 1, 'BDC', 1, '1', '2021-04-08 15:01:27', '2021-04-08 15:01:27'),
(2, 1, 'Satok', 2, '1', '2021-04-08 15:01:34', '2021-04-08 15:01:34'),
(3, 2, 'Jalan Oya', 1, '1', '2021-04-08 15:01:54', '2021-04-08 15:01:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner_dashboard`
--
ALTER TABLE `banner_dashboard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `developer`
--
ALTER TABLE `developer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_block`
--
ALTER TABLE `home_block`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `merchant`
--
ALTER TABLE `merchant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_contact`
--
ALTER TABLE `message_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `navigator`
--
ALTER TABLE `navigator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_gateway`
--
ALTER TABLE `payment_gateway`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trip`
--
ALTER TABLE `trip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_type`
--
ALTER TABLE `vehicle_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zone`
--
ALTER TABLE `zone`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `banner_dashboard`
--
ALTER TABLE `banner_dashboard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `developer`
--
ALTER TABLE `developer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `guest`
--
ALTER TABLE `guest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `home_block`
--
ALTER TABLE `home_block`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `merchant`
--
ALTER TABLE `merchant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `message_contact`
--
ALTER TABLE `message_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `navigator`
--
ALTER TABLE `navigator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment_gateway`
--
ALTER TABLE `payment_gateway`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `trip`
--
ALTER TABLE `trip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vehicle_type`
--
ALTER TABLE `vehicle_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `zone`
--
ALTER TABLE `zone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
