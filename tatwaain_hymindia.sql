-- phpMyAdmin SQL Dump
-- version 3.4.11.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 03, 2015 at 10:43 PM
-- Server version: 5.5.38
-- PHP Version: 5.4.23

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tatwaain_hymindia`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_accomodation`
--
create database tatwaain_hymindia;
use tatwaain_hymindia;
DROP TABLE IF EXISTS `tbl_accomodation`;
CREATE TABLE IF NOT EXISTS `tbl_accomodation` (
  `accomodation_id` int(11) NOT NULL AUTO_INCREMENT,
  `accomodation_place_id` int(11) NOT NULL,
  `check_in_date_time` datetime NOT NULL,
  `check_out_date_time` datetime NOT NULL,
  `additional_requests` varchar(500) DEFAULT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delegate_id` int(11) NOT NULL,
  PRIMARY KEY (`accomodation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_accomodation`
--

INSERT INTO `tbl_accomodation` (`accomodation_id`, `accomodation_place_id`, `check_in_date_time`, `check_out_date_time`, `additional_requests`, `last_updated`, `delegate_id`) VALUES
(1, 1, '2015-02-24 18:30:00', '2015-02-27 18:30:00', 'abcd', '2015-02-24 01:33:25', 2),
(2, 1, '2015-03-02 18:10:00', '2015-03-02 18:10:00', 'test', '2015-03-01 01:13:42', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_accomodation_place`
--

DROP TABLE IF EXISTS `tbl_accomodation_place`;
CREATE TABLE IF NOT EXISTS `tbl_accomodation_place` (
  `accomodation_place_id` int(11) NOT NULL AUTO_INCREMENT,
  `accomodation_place_name` varchar(500) NOT NULL,
  `traffi_type_id` int(11) NOT NULL,
  `country_mode` int(3) NOT NULL,
  `cost_room` decimal(10,2) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `published` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`accomodation_place_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tbl_accomodation_place`
--

INSERT INTO `tbl_accomodation_place` (`accomodation_place_id`, `accomodation_place_name`, `traffi_type_id`, `country_mode`, `cost_room`, `last_updated`, `published`) VALUES
(1, 'Taj West End', 1, 1, '10200.00', '2015-02-10 10:15:41', 1),
(2, 'Taj Yesh', 1, 1, '7350.00', '2015-02-10 10:16:23', 1),
(3, 'Gold Flinch\r\n', 1, 1, '3000.00', '2015-02-10 10:18:16', 1),
(4, 'Taj West End', 2, 1, '11400.00', '2015-02-10 10:18:49', 1),
(5, 'Taj Yesh', 2, 1, '8500.00', '2015-02-10 10:19:28', 1),
(6, 'Gold Flinch', 2, 1, '3500.00', '2015-02-10 10:19:45', 1),
(7, 'Taj West End', 1, 2, '142.00', '2015-02-10 10:15:41', 1),
(8, 'Taj Yesh', 1, 2, '101.00', '2015-02-10 10:16:23', 1),
(9, 'Gold Flinch\r\n', 1, 2, '58.00', '2015-02-10 10:18:16', 1),
(10, 'Taj West End', 2, 2, '158.00', '2015-02-10 10:18:49', 1),
(11, 'Taj Yesh', 2, 2, '116.00', '2015-02-10 10:19:28', 1),
(12, 'Gold Flinch', 2, 2, '66.00', '2015-02-10 10:19:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_delegates`
--

DROP TABLE IF EXISTS `tbl_delegates`;
CREATE TABLE IF NOT EXISTS `tbl_delegates` (
  `delegates_id` int(11) NOT NULL AUTO_INCREMENT,
  `delegates_title` int(11) DEFAULT '0',
  `delegates_hym_id` varchar(45) DEFAULT NULL,
  `delegates_firstname` varchar(255) DEFAULT NULL,
  `delegates_surname` varchar(255) DEFAULT NULL,
  `delegates_emailid` varchar(255) DEFAULT NULL,
  `delegates_club_no` varchar(255) DEFAULT NULL,
  `delegates_mode` int(11) DEFAULT '0',
  `delegates_relationship` int(11) DEFAULT '0',
  `delegates_address1` varchar(255) DEFAULT NULL,
  `delegates_address2` varchar(255) DEFAULT NULL,
  `delegates_postalcode` varchar(20) DEFAULT NULL,
  `delegates_country` varchar(5) DEFAULT NULL,
  `delegates_phone` varchar(255) DEFAULT NULL,
  `delegates_mobile` varchar(255) DEFAULT NULL,
  `delegates_food_prefrence` int(11) DEFAULT '0',
  `tbl_delegatescol` varchar(45) DEFAULT NULL,
  `delegates_allergies` text,
  `lastupdated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `delegates_password` varchar(45) DEFAULT NULL,
  `delegates_group` int(11) DEFAULT '0',
  `delegates_post` varchar(255) DEFAULT NULL,
  `delegates_city` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`delegates_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_delegates`
--

INSERT INTO `tbl_delegates` (`delegates_id`, `delegates_title`, `delegates_hym_id`, `delegates_firstname`, `delegates_surname`, `delegates_emailid`, `delegates_club_no`, `delegates_mode`, `delegates_relationship`, `delegates_address1`, `delegates_address2`, `delegates_postalcode`, `delegates_country`, `delegates_phone`, `delegates_mobile`, `delegates_food_prefrence`, `tbl_delegatescol`, `delegates_allergies`, `lastupdated`, `delegates_password`, `delegates_group`, `delegates_post`, `delegates_city`) VALUES
(1, 1, NULL, 'Soma', 'Shivanna', 'somushiv@gmail.com', 'XYXABCD', 1, 0, '51, Prashanth Nagar', NULL, '560057', 'IN', '8398577', '9845188706', 0, NULL, 'sdfsdffsdf', '2015-01-26 15:28:02', 'b1a6ad1a11c5176a9e9ada92a196b6d4', 0, NULL, 'City/Town'),
(2, 1, NULL, 'Soma', 'Shivanna', 'somushiv@gmail.com', 'XYXABCD', 1, 0, '51, Prashanth Nagar', 'T.Dasarahalli Post', '560057', 'IN', '8398577', '9845188706', 1, NULL, 'sdfsdfsdf', '2015-01-26 15:49:29', '15a00ab33070d69d3ec3f03a9222034b', 0, NULL, 'Bangalore'),
(4, 1, NULL, 'Kumar', 'Biradar', 'naveen.belandur@gmail.com', '12345', 2, 0, 'Bangalore', 'Bangalore', '435678', 'ES', '8095548004', '8095548004', 2, NULL, 'I am good at everything.', '2015-02-05 05:57:18', '79cfac6387e0d582f83a29a04d0bcdc4', 0, NULL, 'Bangalore'),
(5, 2, NULL, 'Kumar', 'fdasd', 'sadananda.kenganal@gmail.com', '3456', 1, 0, 'Bangalore', 'Bangalore', '435678', 'IN', '8095548004', '8095548004', 0, NULL, 'No', '2015-02-06 07:00:56', '79cfac6387e0d582f83a29a04d0bcdc4', 0, NULL, 'Bangalore');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_delegates_event_registration`
--

DROP TABLE IF EXISTS `tbl_delegates_event_registration`;
CREATE TABLE IF NOT EXISTS `tbl_delegates_event_registration` (
  `delegate_event_regid` int(11) NOT NULL AUTO_INCREMENT,
  `delegate_id` int(11) NOT NULL,
  `package_id` int(5) NOT NULL,
  `package_stage_id` int(5) NOT NULL,
  `date_of_registration` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`delegate_event_regid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_delegates_event_registration`
--

INSERT INTO `tbl_delegates_event_registration` (`delegate_event_regid`, `delegate_id`, `package_id`, `package_stage_id`, `date_of_registration`, `created_at`) VALUES
(1, 2, 1, 1, '2015-02-24 01:32:48', '2015-02-24 01:32:48'),
(2, 2, 2, 1, '2015-02-24 01:32:48', '2015-02-24 01:32:48');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_delegates_title`
--

DROP TABLE IF EXISTS `tbl_delegates_title`;
CREATE TABLE IF NOT EXISTS `tbl_delegates_title` (
  `title_id` int(11) NOT NULL AUTO_INCREMENT,
  `title_value` varchar(45) DEFAULT NULL,
  `lastupdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`title_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_delegates_title`
--

INSERT INTO `tbl_delegates_title` (`title_id`, `title_value`, `lastupdate`) VALUES
(1, 'Mr', '2015-01-24 12:56:44'),
(2, 'Mrs', '2015-01-24 12:56:57'),
(3, 'Ms', '2015-01-24 12:57:09'),
(4, 'Dr', '2015-01-24 12:57:18'),
(5, 'Prof', '2015-01-24 12:57:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_delegate_partner`
--

DROP TABLE IF EXISTS `tbl_delegate_partner`;
CREATE TABLE IF NOT EXISTS `tbl_delegate_partner` (
  `delegate_partner_id` int(11) NOT NULL AUTO_INCREMENT,
  `delegate_id` int(11) NOT NULL,
  `delegate_partner_name` varchar(255) DEFAULT NULL,
  `delegate_partner_food_pref` int(3) DEFAULT '0',
  `delagate_partner_rel` int(3) DEFAULT '0',
  `delagate_partner_about` varchar(500) DEFAULT NULL,
  `delegate_partner_passport` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`delegate_partner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_delegate_partner`
--

INSERT INTO `tbl_delegate_partner` (`delegate_partner_id`, `delegate_id`, `delegate_partner_name`, `delegate_partner_food_pref`, `delagate_partner_rel`, `delagate_partner_about`, `delegate_partner_passport`, `updated_at`) VALUES
(1, 2, 'Raghu', 0, 0, 'Text area', '0', '2015-02-24 01:30:41');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_packages_details`
--

DROP TABLE IF EXISTS `tbl_packages_details`;
CREATE TABLE IF NOT EXISTS `tbl_packages_details` (
  `packages_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `package_stage_id` int(11) DEFAULT NULL,
  `packages_title` varchar(255) DEFAULT NULL,
  `country_mode` int(11) DEFAULT '0',
  `packages_cost` float DEFAULT NULL,
  `packages_description` text,
  `published` int(11) DEFAULT '1',
  `lastupdated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`packages_details_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `tbl_packages_details`
--

INSERT INTO `tbl_packages_details` (`packages_details_id`, `package_stage_id`, `packages_title`, `country_mode`, `packages_cost`, `packages_description`, `published`, `lastupdated`) VALUES
(1, 1, 'All NAGM Sessions(Includes Kit gift)', 1, 6500, 'Regn+NAGM+Informal Night+Gala Dinner', 1, '2015-01-29 13:32:07'),
(2, 1, 'Parties  Only', 1, 6000, 'Regn+Informal Night+Gala Dinner', 1, '2015-01-29 13:33:42'),
(3, 1, 'Buisness Sessions Only', 1, 4250, 'Regn+NAGM +HYM', 1, '2015-01-29 13:34:18'),
(4, 1, 'Day 1 Only', 1, 4500, 'Regn+NAGM+Informal Night', 1, '2015-01-29 13:37:13'),
(5, 1, 'Day 2 Only', 1, 5000, 'Regn+HYM +Gala Dinner', 1, '2015-01-29 13:39:46'),
(6, 1, 'Formal Events Only', 1, 6000, 'Reg+NAGM +Gala Dinner', 1, '2015-01-29 13:41:19'),
(7, 1, 'Informal Night', 1, 3000, 'Single Event Option', 1, '2015-01-29 13:42:22'),
(8, 1, 'HYM Lunch', 1, 1800, 'Additional option ', 1, '2015-01-29 13:42:56'),
(9, 1, 'Farewell Brunch', 1, 1500, 'Additional option ', 1, '2015-01-29 13:43:32'),
(10, 2, 'All NAGM Sessions(Includes Kit gift)', 1, 7250, 'Regn+NAGM+Informal Night+Gala Dinner', 1, '2015-01-29 13:46:21'),
(11, 2, 'Parties  Only', 1, 6750, 'Regn+Informal Night+Gala Dinner', 1, '2015-01-29 14:01:21'),
(12, 2, 'Buisness Sessions Only', 1, 5000, 'Regn+NAGM +HYM ', 1, '2015-01-29 14:10:04'),
(13, 2, 'Day 1 Only', 1, 5250, 'Regn+NAGM+Informal Night', 1, '2015-01-29 14:10:16'),
(14, 2, 'Day 2 Only', 1, 5750, 'Regn+HYM +Gala Dinner', 1, '2015-01-29 14:10:25'),
(15, 2, 'Formal Events Only', 1, 6750, 'Reg+NAGM +Gala Dinner', 1, '2015-01-29 14:10:34'),
(16, 2, 'Informal Night', 1, 3250, 'Single Event Option', 1, '2015-01-29 14:10:42'),
(17, 2, 'HYM Lunch', 1, 2000, 'Additional option', 1, '2015-01-29 14:10:42'),
(18, 2, 'Farewell Brunch', 1, 1700, 'Additional option', 1, '2015-01-29 14:11:10'),
(19, 3, 'All NAGM Sessions(Includes Kit gift)', 1, 8000, 'Regn+NAGM+Informal Night+Gala Dinner', 1, '2015-01-29 14:16:08'),
(20, 3, 'Parties  Only', 1, 7000, 'Regn+Informal Night+Gala Dinner', 1, '2015-01-29 14:16:08'),
(21, 3, 'Buisness Sessions Only', 1, 5300, 'Regn+NAGM +HYM ', 1, '2015-01-29 14:16:08'),
(22, 3, 'Day 1 Only', 1, 5500, 'Regn+NAGM+Informal Night', 1, '2015-01-29 14:16:08'),
(23, 3, 'Day 2 Only', 1, 6000, 'Regn+HYM +Gala Dinner', 1, '2015-01-29 14:16:08'),
(24, 3, 'Formal Events Only', 1, 7000, 'Reg+NAGM +Gala Dinner', 1, '2015-01-29 14:16:08'),
(25, 3, 'Informal Night', 1, 3500, 'Single Event Option', 1, '2015-01-29 14:16:08'),
(26, 3, 'HYM Lunch', 1, 2100, 'Additional option', 1, '2015-01-29 14:16:08'),
(27, 3, 'Farewell Brunch', 1, 1800, 'Additional option', 1, '2015-01-29 14:16:14'),
(28, 1, 'Registration Couple ', 2, 550, 'Reg+ FriLunch+Fri Dinner+Sat Lunch+Sat Dinner+Sun Brunch(2 heads)', 1, '2015-01-29 14:25:30'),
(29, 1, 'Registration Single', 2, 275, 'Reg+ FriLunch+Fri Dinner+Sat Lunch+Sat Dinner+Sun Brunch(1 Head)', 1, '2015-01-29 14:28:19'),
(30, 2, 'Registration Couple', 2, 600, 'Reg+ FriLunch+Fri Dinner+Sat Lunch+Sat Dinner+Sun Brunch(2 heads)', 1, '2015-01-29 14:28:52'),
(31, 2, 'Registration Single', 2, 300, 'Reg+ FriLunch+Fri Dinner+Sat Lunch+Sat Dinner+Sun Brunch(1 Head)', 1, '2015-01-29 14:29:20'),
(32, 3, 'Registration Couple', 2, 650, 'Reg+ FriLunch+Fri Dinner+Sat Lunch+Sat Dinner+Sun Brunch(2 heads)', 1, '2015-01-29 14:29:50'),
(33, 3, 'Registration Single', 2, 350, 'Reg+ FriLunch+Fri Dinner+Sat Lunch+Sat Dinner+Sun Brunch(1 Head)', 1, '2015-01-29 14:30:18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_refrence`
--

DROP TABLE IF EXISTS `tbl_payment_refrence`;
CREATE TABLE IF NOT EXISTS `tbl_payment_refrence` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `delegate_id` int(11) NOT NULL,
  `payment_mode` int(3) NOT NULL,
  `total_cost` decimal(10,2) DEFAULT '0.00',
  `payment_reference_id` varchar(255) DEFAULT NULL,
  `payment_details` varchar(700) DEFAULT NULL,
  `payment_categary` int(3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_payment_refrence`
--

INSERT INTO `tbl_payment_refrence` (`payment_id`, `delegate_id`, `payment_mode`, `total_cost`, `payment_reference_id`, `payment_details`, `payment_categary`, `created_at`) VALUES
(1, 2, 1, '12500.00', '02938434', '{"payment_details":[\n                    {"bankName":SBI, "branchName": Dollars},\n                    {"date":2015-02-24, "note":" . Test"}\n                ]}', 0, '2015-02-24 01:32:48');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tours_places`
--

DROP TABLE IF EXISTS `tbl_tours_places`;
CREATE TABLE IF NOT EXISTS `tbl_tours_places` (
  `tours_places_id` int(11) NOT NULL AUTO_INCREMENT,
  `tours_is_pre_post` int(3) NOT NULL,
  `tours_places` varchar(500) NOT NULL,
  `cost_per_couple` decimal(10,2) NOT NULL,
  `cost_per_head` decimal(10,2) NOT NULL,
  `country_mode` int(4) NOT NULL,
  `published` int(2) NOT NULL DEFAULT '1',
  `updated_At` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`tours_places_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_tours_places`
--

INSERT INTO `tbl_tours_places` (`tours_places_id`, `tours_is_pre_post`, `tours_places`, `cost_per_couple`, `cost_per_head`, `country_mode`, `published`, `updated_At`) VALUES
(1, 1, 'Golden Triangle', '1262.00', '1119.00', 1, 1, '2015-02-11 07:30:04'),
(2, 1, 'Madhya Pradesh', '3330.00', '2725.00', 1, 1, '2015-02-11 07:30:38'),
(3, 1, 'Goa', '1992.00', '1849.00', 1, 1, '2015-02-11 07:31:16'),
(4, 1, 'Andaman', '1246.00', '1205.00', 1, 1, '2015-02-11 07:31:48'),
(5, 2, 'Karnataka', '1572.00', '1091.00', 1, 1, '2015-02-11 07:32:31'),
(6, 2, 'Kerala', '980.00', '981.00', 1, 1, '2015-02-11 07:32:56'),
(7, 2, 'Taj Safaries', '0.00', '0.00', 1, 1, '2015-02-11 07:33:38'),
(8, 2, 'Golden  Charriot', '8329.00', '7065.00', 1, 1, '2015-02-11 07:34:03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tour_master`
--

DROP TABLE IF EXISTS `tbl_tour_master`;
CREATE TABLE IF NOT EXISTS `tbl_tour_master` (
  `delegate_tour_id` int(11) NOT NULL AUTO_INCREMENT,
  `delegate_id` int(3) NOT NULL,
  `delegate_tourplace_id` int(3) NOT NULL,
  `is_couple_other` int(3) NOT NULL,
  `total_members` int(3) DEFAULT NULL,
  `tour_date` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`delegate_tour_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_tour_master`
--

INSERT INTO `tbl_tour_master` (`delegate_tour_id`, `delegate_id`, `delegate_tourplace_id`, `is_couple_other`, `total_members`, `tour_date`, `updated_at`) VALUES
(4, 2, 1, 1, 0, '0000-00-00 00:00:00', '2015-02-17 20:47:59'),
(5, 2, 1, 1, 0, '2015-02-25 00:00:00', '2015-02-24 01:33:47'),
(6, 2, 1, 1, 0, '2015-03-02 00:00:00', '2015-03-01 01:14:08');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transporation`
--

DROP TABLE IF EXISTS `tbl_transporation`;
CREATE TABLE IF NOT EXISTS `tbl_transporation` (
  `transporation_id` int(11) NOT NULL AUTO_INCREMENT,
  `transporation_mode` int(3) NOT NULL,
  `transporation_stage` int(3) NOT NULL,
  `transporation_datetime` datetime NOT NULL,
  `arrival_departure_from` varchar(500) NOT NULL,
  `delegate_id` int(11) NOT NULL,
  `additional_requests` varchar(500) DEFAULT NULL,
  `refrence_number` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`transporation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_transporation`
--

INSERT INTO `tbl_transporation` (`transporation_id`, `transporation_mode`, `transporation_stage`, `transporation_datetime`, `arrival_departure_from`, `delegate_id`, `additional_requests`, `refrence_number`, `updated_at`) VALUES
(1, 1, 2, '0000-00-00 00:00:00', 'Bangalore', 2, 'Nothing', 23456, '2015-02-11 06:01:50'),
(2, 1, 2, '2015-02-19 05:50:00', 'Bangalore', 2, 'Nothing', 0, '2015-02-11 06:02:28'),
(3, 1, 2, '2015-02-10 05:50:00', 'Bangalore', 2, 'Nothing', 23456, '2015-02-11 06:05:13'),
(4, 1, 2, '2015-02-10 23:50:00', 'Bangalore', 2, 'Nothing', 23456, '2015-02-11 06:07:57'),
(5, 1, 1, '2015-02-24 00:00:00', 'City Railwaystation', 2, 'check cout', 234234, '2015-02-24 01:34:22');

-- --------------------------------------------------------

--
-- Table structure for table `tb_registration_stage`
--

DROP TABLE IF EXISTS `tb_registration_stage`;
CREATE TABLE IF NOT EXISTS `tb_registration_stage` (
  `registration_stage_id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_stage_text` varchar(255) DEFAULT NULL,
  `registration_stage_start_date` date DEFAULT NULL,
  `registration_stage_cut_off_date` date DEFAULT NULL,
  `published` int(11) DEFAULT '1',
  `lastupdated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`registration_stage_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tb_registration_stage`
--

INSERT INTO `tb_registration_stage` (`registration_stage_id`, `registration_stage_text`, `registration_stage_start_date`, `registration_stage_cut_off_date`, `published`, `lastupdated`) VALUES
(1, 'Early Bird', '2015-01-01', '2015-12-31', 1, NULL),
(2, 'Late Bird', '2016-01-01', '2016-07-30', 1, NULL),
(3, 'Spot entry', '2016-08-01', '2016-09-01', 1, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
