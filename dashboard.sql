-- phpMyAdmin SQL Dump
-- version 4.1.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 01, 2014 at 04:34 PM
-- Server version: 5.6.15
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dashboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE IF NOT EXISTS `appointments` (
  `appointment_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Appointment primary key',
  `client_id` int(11) NOT NULL COMMENT 'Client ID',
  `appointment_date` date NOT NULL COMMENT 'Appointment date',
  `description` text NOT NULL COMMENT ' 	Apointment description',
  PRIMARY KEY (`appointment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Appointment records' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `client_id`, `appointment_date`, `description`) VALUES
(1, 3, '2014-01-02', 'What to talk about a large project. Possibly 10,000 pages.'),
(2, 8, '2014-01-07', 'Want to know if I can reduce my rate for less services in the near future.');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Client Primary Key',
  `company` text COMMENT 'Company Name',
  `client_name` text COMMENT 'Client Name',
  `email` text NOT NULL COMMENT 'Client Email',
  `phone_number` text COMMENT 'Client Phone Number',
  `client_rate` float DEFAULT NULL COMMENT 'Client Pay Rate',
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Client profile records' AUTO_INCREMENT=7 ;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `company`, `client_name`, `email`, `phone_number`, `client_rate`) VALUES
(1, 'Falso Compania', 'Tom Brady', 'tbrady@gmail.com', '555-555-5555', 50),
(2, 'Phony Occupancy', 'Susan Rose', 'srose@gmail.com', '555-555-5555', 100),
(3, 'Fake Facilities', 'Sam Johnson', 'sjohnson@gmail.com', '555-555-5555', 75),
(4, 'Mirage Systems', 'Kelly Gooding', 'kgooding@gmail.com', '555-555-5555', 500),
(5, 'Silly Placeholder', 'Phillip Jones', 'pjones@gmail.com', '555-555-5555', 1000),
(6, 'Casual Observer', 'Anthony Wong', 'awong@gmail.com', '555-555-5555', 435);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `feedback_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Feedback Primary Key',
  `client_id` int(11) NOT NULL COMMENT 'Client ID',
  `description` text NOT NULL COMMENT 'Feedback description',
  `feedback_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Feedback Date',
  PRIMARY KEY (`feedback_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Feedback Records' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `client_id`, `description`, `feedback_date`) VALUES
(1, 4, 'Though this is the best service I have ever had, the order process is a little confusing.', '2013-12-29 01:06:04'),
(2, 5, 'This new dashboard system is amazing!', '2013-12-29 01:06:04');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE IF NOT EXISTS `invoices` (
  `invoice_id` int(11) NOT NULL AUTO_INCREMENT COMMENT ' 	Invoice Primary Key',
  `client_id` int(11) NOT NULL COMMENT 'Client ID',
  `description` text NOT NULL COMMENT 'Invoice description',
  `total_cost` float NOT NULL COMMENT 'Invoice total cost',
  `invoice_number` text NOT NULL COMMENT 'Invoice number',
  PRIMARY KEY (`invoice_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Client invoice records' AUTO_INCREMENT=13 ;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`invoice_id`, `client_id`, `description`, `total_cost`, `invoice_number`) VALUES
(1, 3, 'Adding in content for new website.', 5000, '54323568'),
(2, 4, 'Add content for our vacation flyers', 3200, '54325632'),
(3, 3, 'Adding content to our transaction emails', 500, '56462717'),
(4, 5, 'Creating a contract template for us to use for various clients.', 3000, '47563463'),
(5, 6, 'Creating advertisement literature for our company''s flagship product.', 2000, '57363646'),
(6, 7, 'Adding new text to our existing site.', 500, '34536245'),
(7, 8, 'Creating legal documents for the company.', 5000, '23432543'),
(8, 8, 'Creating advertisement literature for company promotion.', 2800, '23432567'),
(9, 4, 'Adding content to commercial', 8000, '23432322'),
(10, 5, 'Creating a new sales pitch slogan', 3000, '24254342'),
(11, 6, 'A new user manual needs touching up.', 2300, '54843868'),
(12, 7, 'Redoing the website text content.', 6000, '95688483');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_status`
--

CREATE TABLE IF NOT EXISTS `invoice_status` (
  `invoice_status_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Invoice Status Primary ID',
  `invoice_id` int(11) NOT NULL COMMENT 'Invoice ID',
  `description` text NOT NULL COMMENT 'Status description',
  `invoice_status_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT ' 	Time that the status record was entered',
  PRIMARY KEY (`invoice_status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Invoice status records' AUTO_INCREMENT=13 ;

--
-- Dumping data for table `invoice_status`
--

INSERT INTO `invoice_status` (`invoice_status_id`, `invoice_id`, `description`, `invoice_status_date`) VALUES
(1, 1, 'Created', '2013-12-01 08:00:00'),
(2, 2, 'Created', '2013-12-01 08:00:00'),
(3, 3, 'Created', '2013-12-01 08:00:00'),
(4, 4, 'Created', '2013-12-01 08:00:00'),
(5, 5, 'Created', '2013-12-01 08:00:00'),
(6, 6, 'Created', '2013-12-01 08:00:00'),
(7, 7, 'Created', '2013-12-01 08:00:00'),
(8, 8, 'Created', '2013-12-01 08:00:00'),
(9, 9, 'Created', '2013-12-01 08:00:00'),
(10, 10, 'Created', '2013-12-01 08:00:00'),
(11, 11, 'Created', '2013-12-01 08:00:00'),
(12, 12, 'Created', '2013-12-01 08:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Order Primary Key',
  `client_id` int(11) NOT NULL COMMENT 'Client ID',
  `description` text NOT NULL COMMENT 'Order description',
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Order Date',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Order records' AUTO_INCREMENT=5 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `client_id`, `description`, `order_date`) VALUES
(1, 3, 'Need a new content set for the promotional literature to be created.', '2013-12-29 01:39:15'),
(2, 4, 'Need content for a pamphlet.', '2013-12-29 01:39:15'),
(3, 5, 'Updating company literature to reflect the new merger.', '2013-12-29 01:40:57'),
(4, 6, 'Create a new slogan for new product.', '2013-12-29 01:40:57');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Project primary key',
  `client_id` int(11) NOT NULL COMMENT 'Client ID',
  `description` text NOT NULL COMMENT 'Project description',
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Project Records' AUTO_INCREMENT=13 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `client_id`, `description`) VALUES
(1, 3, 'Adding in content for new website.'),
(2, 4, 'Add content for our vacation flyers'),
(3, 3, 'Adding content to our transaction emails'),
(4, 5, 'Creating a contract template.'),
(5, 6, 'Creating advertisement literature'),
(6, 7, 'Adding new text to existing site'),
(7, 8, 'Creating legal documents'),
(8, 8, 'Creating advertisement literature'),
(9, 4, 'Adding content to commercial'),
(10, 5, 'Creating a new sales pitch slogan'),
(11, 6, 'A new user manual needs touching up.'),
(12, 7, 'Redoing the website text content.');

-- --------------------------------------------------------

--
-- Table structure for table `project_status`
--

CREATE TABLE IF NOT EXISTS `project_status` (
  `project_status_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Project status primary key',
  `project_id` int(11) NOT NULL COMMENT 'Project ID',
  `status` text NOT NULL COMMENT 'Project status',
  `description` text COMMENT 'Project description',
  `project_status_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Project status change date',
  PRIMARY KEY (`project_status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Project status records' AUTO_INCREMENT=13 ;

--
-- Dumping data for table `project_status`
--

INSERT INTO `project_status` (`project_status_id`, `project_id`, `status`, `description`, `project_status_date`) VALUES
(1, 1, 'Created', NULL, '2013-12-01 08:00:00'),
(2, 2, 'Created', NULL, '2013-12-01 08:00:00'),
(3, 3, 'Created', NULL, '2013-12-01 08:00:00'),
(4, 4, 'Created', NULL, '2013-12-01 08:00:00'),
(5, 5, 'Created', NULL, '2013-12-01 08:00:00'),
(6, 6, 'Created', NULL, '2013-12-01 08:00:00'),
(7, 7, 'Created', NULL, '2013-12-01 08:00:00'),
(8, 8, 'Created', NULL, '2013-12-01 08:00:00'),
(9, 9, 'Created', NULL, '2013-12-01 08:00:00'),
(10, 10, 'Created', NULL, '2013-12-01 08:00:00'),
(11, 11, 'Created', NULL, '2013-12-01 08:00:00'),
(12, 12, 'Created', NULL, '2013-12-01 08:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'User''s primary key',
  `user_name` text NOT NULL COMMENT 'User''s name',
  `password` text NOT NULL COMMENT 'User''s password',
  `email` text NOT NULL COMMENT 'User''s email',
  `user_group_id` int(11) NOT NULL COMMENT 'User''s Group ID',
  `status` tinyint(1) NOT NULL COMMENT 'User''s Status: Active - 1, Inactive - 0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Dashboard User Records' AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `password`, `email`, `user_group_id`, `status`) VALUES
(1, 'Bryan Lowe', 'blowe2013', 'bryan.lowe@contentequalsmoney.com', 1, 1),
(2, 'Amie Marse', 'amarse2013', 'amie@contentequalsmoney.com', 1, 1),
(3, 'Tom Brady', 'tbrady2013', 'tbrady@gmail.com', 3, 1),
(4, 'Susan Rose', 'srose2013', 'srose@gmail.com', 3, 1),
(5, 'Sam Johnson', 'sjohnson2013', 'sjohnson@gmail.com', 3, 0),
(6, 'Kelly Gooding', 'kgooding2013', 'kgooding@gmail.com', 3, 1),
(7, 'Phillip Jones', 'pjones2013', 'pjones@gmail.com', 3, 1),
(8, 'Anthony Wong', 'awong2013', 'awong@gmail.com', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE IF NOT EXISTS `user_group` (
  `user_group_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'User Group Primary Key',
  `group_name` text NOT NULL COMMENT 'Group Name',
  PRIMARY KEY (`user_group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='User group table(Admin, Writer, Client)' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`user_group_id`, `group_name`) VALUES
(1, 'ADMIN'),
(2, 'WRITER'),
(3, 'CLIENT');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
