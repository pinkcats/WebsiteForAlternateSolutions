-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 15, 2015 at 08:25 PM
-- Server version: 5.5.41-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `likwam29`
--

-- --------------------------------------------------------

--
-- Table structure for table `contactUs`
--

CREATE TABLE IF NOT EXISTS `contactUs` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `phone` int(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` varchar(500) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `contactUs`
--

INSERT INTO `contactUs` (`Id`, `name`, `phone`, `email`, `subject`, `message`) VALUES
(19, 'austin', 2147483647, 'austinhoefs@gmail.com', 'Hello', 'How are you doing?'),
(20, 'Austin', 2147483647, 'austin@hoefs.com', 'Hello', 'Please get back to me');

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE IF NOT EXISTS `organization` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `organizationKey` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `zip_code` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`Id`, `name`, `organizationKey`, `email`, `address`, `city`, `state`, `zip_code`) VALUES
(10, 'Test', '5572b007', 'test@test.com', '922 St Helena Rd', 'Horicon', 'Wi', 53032),
(13, 'Austin''s Org', '559bcca0', 'Austin@test.com', '922 St Helena Rd', 'Horicon', 'WI', 53032);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE IF NOT EXISTS `schedule` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `clientId` int(11) NOT NULL,
  `staffId` int(11) NOT NULL,
  `isArchived` bit(1) NOT NULL,
  `serviceId` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`Id`, `startDate`, `endDate`, `clientId`, `staffId`, `isArchived`, `serviceId`) VALUES
(1, '2015-12-24', '2015-12-28', 3, 36, b'0', 2),
(2, '2015-12-12', '2015-12-18', 56, 36, b'0', 6),
(3, '2015-12-11', '2015-12-19', 1, 0, b'0', 4),
(4, '2015-12-11', '2015-12-19', 1, 0, b'0', 4),
(5, '2015-12-14', '2015-12-18', 57, 0, b'0', 7),
(6, '2015-12-13', '2015-12-18', 56, 0, b'0', 3),
(7, '2015-12-21', '2015-12-25', 3, 0, b'0', 5),
(8, '2016-02-01', '2016-02-06', 1, 0, b'0', 6),
(9, '2015-12-08', '2015-12-19', 3, 0, b'0', 7),
(10, '2015-12-14', '2015-12-18', 57, 0, b'0', 2),
(11, '2015-12-14', '2015-12-18', 56, 0, b'0', 3),
(12, '2015-12-01', '2015-12-31', 1, 0, b'0', 2);

-- --------------------------------------------------------

--
-- Table structure for table `serviceRequests`
--

CREATE TABLE IF NOT EXISTS `serviceRequests` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `serviceId` int(11) NOT NULL,
  `Date` date NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `serviceRequests`
--

INSERT INTO `serviceRequests` (`Id`, `serviceId`, `Date`, `userId`) VALUES
(2, 2, '2015-06-12', 0),
(3, 2, '2015-06-12', 0),
(4, -1, '2015-12-16', 1),
(6, 2, '2015-12-10', 1),
(7, 2, '2015-12-08', 1),
(8, 5, '2015-12-10', 1),
(9, 5, '2016-02-10', 1),
(10, 2, '2015-12-02', 58),
(11, 2, '2015-12-25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`Id`, `name`, `description`) VALUES
(2, 'Mediation', 'Mediation is a voluntary process in which parties choose to work together with an impartial third party (mediator) to resolve their conflict in a mutually beneficial way.'),
(3, 'Facilitation', 'A process in which an impartial third party (facilitator) works with a group by helping group members communicate and problem-solve productively, resulting in high quality decisions.  '),
(4, 'Consultation', 'In order to effectively address organizational needs, an organization must first understand the scope of the need. A consultant with specific expertise works with a client to identify the problem, recommend possible solutions/services, and identify available resources. The objectivity of the consultant provides valuable insight. By partnering with the client, the client is actively engaged in addressing organizational issues and conflicts, with the support of the consultant''s expertise.'),
(5, 'Coaching', 'Coaching is a learning partnership for generating creative, purposeful action toward one person''s goals and desires. It is an effective means to help people improve job performance, build leadership skills, and remove obstacles blocking their path to success.'),
(6, 'Training', 'Mediation is a voluntary process in which parties choose to work together with an impartial third party (mediator) to resolve their conflict in a mutually beneficial way. It is a confidential, uniquely flexible process that can be tailored to meet a wide variety of situations.'),
(7, 'Systems Design', 'Assist in the design of a system');

-- --------------------------------------------------------

--
-- Table structure for table `sidebarLinks`
--

CREATE TABLE IF NOT EXISTS `sidebarLinks` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `link` varchar(1000) NOT NULL,
  `isArchived` bit(1) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `sidebarLinks`
--

INSERT INTO `sidebarLinks` (`Id`, `title`, `link`, `isArchived`) VALUES
(34, 'Google', 'http://google.com', b'0'),
(35, 'Facebook', 'http://facebook.com', b'0'),
(39, 'test', 'http://www.google.com', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `userOrganization`
--

CREATE TABLE IF NOT EXISTS `userOrganization` (
  `user_Id` int(11) NOT NULL,
  `organization_Id` int(11) NOT NULL,
  PRIMARY KEY (`user_Id`,`organization_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userOrganization`
--

INSERT INTO `userOrganization` (`user_Id`, `organization_Id`) VALUES
(1, 8),
(57, 8),
(58, 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zip_code` int(11) NOT NULL,
  `is_staff` bit(1) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(13) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=59 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `first_name`, `last_name`, `address`, `city`, `state`, `zip_code`, `is_staff`, `email`, `phone_number`, `password`) VALUES
(1, 'John', 'Doe', 'test', 'test1', 'test', 54901, b'0', 'test@test.test', '9203827193', 'test'),
(3, 'Austin', 'Hoefs', '1008 Elmwood Ave', 'Oshkosh', 'Wisconsin', 54901, b'0', 'austinhoefs@gmail.com', '9203827193', 'test'),
(15, 'Austin', 'Test', 'test', 'test', 'test', 53032, b'1', 'test@work.please', '9203827193', 'test'),
(16, 'Austin', 'LastTest', 'Last', 'Last', 'Last', 50305, b'1', 'last@test.com', '920382', 'test'),
(17, 'Matthew', 'Likwarz', '334 Brookside Drive #6', 'Mayville', 'Wisconsin', 53050, b'1', 'likwam29@uwosh.edu', '2147483647', 'test'),
(18, 'thomas', 'petersen', '123 ', 'city', 'state', 45612, b'1', 'thomas@petersen.com', '2147483647', 'test'),
(19, 'thomas ', 'naps', 'asdf', 'asdf', 'asdf', 65465, b'1', 'naps@uwosh.edu', '2147483647', 'test'),
(20, '1', '1', '1', '1', '1', 1, b'1', '1', '1', 'asdf'),
(21, 'Austin', 'Hoefs', '', '', '', 0, b'1', '', '0', ''),
(22, '', '', '', '', '', 0, b'1', '', '0', ''),
(23, '', '', '', '', '', 0, b'1', '', '0', ''),
(24, 'matthew ', 'likwarz', 'test', 'test', 'test', 0, b'1', 'etst', '2147483647', 'matt'),
(36, 'kiley', 'gray', '1001 van buren ave', 'oshkosh', 'wi', 54902, b'1', 'grayk58@uwosh.edu', '920', 'cats'),
(47, 'cat', 'cat', 'cat', 'cat', 'cat', 59487, b'1', 'cat@cat.cat', '965', 'cat'),
(56, 'Matt', 'Likwarz', 'adf', 'adf', 'adf', 53032, b'0', '9a@asdf.adfss', '2147483647', 'asdf'),
(57, 'Kiley', 'Gray', '922 St Helena Rd', 'Horicon', 'WI', 53032, b'0', 'keitser@att.net', '9203827193', 'test'),
(58, 'Austin', 'Test', 'Test', 'Test', 'Test', 54901, b'0', 'austin@test.com', '9203827193', 'test');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
