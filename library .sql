-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2014 at 04:16 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `library`
--
CREATE DATABASE IF NOT EXISTS `library` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `library`;

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isbn` int(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `year` year(4) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `quantity` int(100) DEFAULT NULL,
  `borrowed` int(100) NOT NULL,
  `remaining` int(100) NOT NULL,
  `category` varchar(30) NOT NULL,
  `type` varchar(30) NOT NULL,
  `borrowCount` int(10) NOT NULL,
  `timeAdded` timestamp NULL DEFAULT NULL,
  `increaseTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `addedBy` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `isbn` (`isbn`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `isbn`, `title`, `author`, `year`, `status`, `quantity`, `borrowed`, `remaining`, `category`, `type`, `borrowCount`, `timeAdded`, `increaseTime`, `addedBy`) VALUES
(4, 123000000, 'Ijapa Tiroko', 'Shola Rotimi', 1988, 1, 47, 0, 47, 'Folklore', 'Pamphlet', 20, '2014-01-31 08:10:59', '2014-01-31 08:10:59', 4),
(8, 146578932, 'Started from the bottom now we here.', 'Drizzy Drake', 2012, 1, 25, 0, 25, 'Rap', 'CD', 0, '2014-02-07 01:34:00', '2014-03-31 10:36:26', 7),
(6, 212777221, 'Animal Farm', 'George Orwell', 1998, 1, 16, 2, 14, 'Fiction', 'Novel', 4, '2014-02-05 10:34:23', '2014-03-13 20:42:36', 4),
(11, 298248792, 'Gangsta Dream', 'Robert Williams', 2014, 1, 25, 1, 24, 'Rap', 'CD', 1, '2014-03-14 10:36:14', '2014-03-14 10:36:14', 4),
(10, 2147483647, 'Rich Dad Rich Dad', 'Shawn Carter', 2012, 1, 143, 0, 143, 'Biography', 'Hard Cover', 1, '2014-02-13 12:10:23', '2014-03-14 10:05:42', 9),
(9, 230112012, 'My love for Bintu', 'Solomon Omojola', 2014, 1, 112, 0, 112, 'Romance', 'Poetry Collection', 1, '2014-02-10 16:19:55', '2014-02-10 16:51:29', 9),
(12, 123456776, 'Bad Man Things', 'Unknown Artiste', 2009, 1, 137, 0, 137, 'Unknown', 'CD', 0, '2014-03-31 10:22:41', '2014-03-31 10:34:14', 14);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE IF NOT EXISTS `booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student` int(11) NOT NULL,
  `bookTitle` varchar(100) NOT NULL,
  `returnDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `isReturned` tinyint(4) NOT NULL,
  `isOverdue` tinyint(4) NOT NULL,
  `book` int(11) NOT NULL,
  `isExpired` tinyint(4) NOT NULL,
  `isClaimed` tinyint(4) NOT NULL,
  `expiryDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dueDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `student`, `bookTitle`, `returnDateTime`, `dateTime`, `isReturned`, `isOverdue`, `book`, `isExpired`, `isClaimed`, `expiryDate`, `dueDate`) VALUES
(12, 81343, 'Animal Farm', '0000-00-00 00:00:00', '2014-03-15 10:32:26', 0, 0, 6, 0, 1, '2014-03-18 10:32:26', '2014-03-22 00:31:27'),
(13, 81343, 'Ijapa Tiroko', '2014-03-15 11:23:43', '2014-03-15 10:35:58', 1, 0, 4, 0, 1, '2014-03-18 10:35:58', '2014-03-22 11:23:08'),
(14, 81343, 'Gangsta Dream', '0000-00-00 00:00:00', '2014-03-15 12:33:02', 0, 0, 11, 0, 0, '2014-03-18 00:33:02', '2014-06-23 00:33:02');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isRead` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `student`, `message`, `time`, `isRead`) VALUES
(1, 81343, 'I am a programmer, what are you?', '2014-03-14 13:17:14', 1),
(2, 81342, 'Hello, i hope this works this time around\r\n', '2014-03-14 12:16:18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `year` year(4) NOT NULL,
  `author` varchar(200) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `seen` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `student`, `title`, `year`, `author`, `time`, `seen`) VALUES
(1, 81342, 'Telephone Conversation', 1994, 'Wole Soyinka', '0000-00-00 00:00:00', 1),
(2, 81342, 'How i met your mum', 2012, 'Chris Rock', '2014-02-09 13:26:53', 1),
(3, 81343, 'Holla at me when you see me', 2000, 'Unknown Author', '2014-03-14 11:57:29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `isLibrarian` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `username`, `password`, `isLibrarian`) VALUES
(4, 'Fibonacci', '1a1dc91c907325c69271ddf0c944bc72', 0),
(7, 'fibo', '21232f297a57a5a743894a0e4a801fc3', 0),
(8, 'teddy', '1a1dc91c907325c69271ddf0c944bc72', 0),
(9, 'liblib', '5f4dcc3b5aa765d61d8327deb882cf99', 1),
(10, 'libro', '5f4dcc3b5aa765d61d8327deb882cf99', 1),
(11, 'Adamu', '5f4dcc3b5aa765d61d8327deb882cf99', 0),
(14, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', 0),
(15, 'MobileAdmin', 'e51fe96c7b3f4a370de1066d09148110', 0);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `studentNo` int(20) NOT NULL,
  `isActive` tinyint(4) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lastLogin` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `password` varchar(100) NOT NULL,
  `approvalDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `email` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `matricNo` (`studentNo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `studentNo`, `isActive`, `firstName`, `lastName`, `regDate`, `lastLogin`, `password`, `approvalDate`, `email`, `dob`, `address`) VALUES
(9, 81343, 1, 'Solomon', 'Omojola', '2014-03-31 09:51:16', '2014-03-29 19:14:35', '5f4dcc3b5aa765d61d8327deb882cf99', '2014-03-31 10:51:41', '', '0000-00-00', ''),
(31, 81342, 1, 'Mayowa', 'Osinjolu', '2014-03-31 09:51:16', '2014-03-31 11:31:22', '5f4dcc3b5aa765d61d8327deb882cf99', '2014-03-31 10:51:52', '', '0000-00-00', ''),
(32, 81344, 1, 'Teddy', 'Bongy', '2014-03-31 09:51:16', '0000-00-00 00:00:00', '1a1dc91c907325c69271ddf0c944bc72', '2014-03-31 10:52:17', '', '0000-00-00', ''),
(33, 81333, 1, 'Segun', 'Java', '2014-03-31 09:51:16', '2014-02-13 11:24:04', '1a1dc91c907325c69271ddf0c944bc72', '2014-03-31 10:52:51', '', '0000-00-00', ''),
(35, 81234, 0, 'Alan', 'Turing', '2014-03-31 09:51:16', '0000-00-00 00:00:00', '1a1dc91c907325c69271ddf0c944bc72', '2014-02-28 15:47:01', '', '0000-00-00', ''),
(36, 83456, 0, 'John', 'Doe', '2014-03-31 09:51:16', '0000-00-00 00:00:00', '5f4dcc3b5aa765d61d8327deb882cf99', '2014-03-14 12:33:50', 'jdoe@gmail.com', '0000-00-00', ''),
(38, 5484, 0, 'Solomon', 'Omojola', '2014-03-31 09:51:16', '0000-00-00 00:00:00', '5f4dcc3b5aa765d61d8327deb882cf99', '2014-03-31 10:37:56', 'omojolasolomon@gmail.com', '0000-00-00', 'omojolasolomon@gmail.com'),
(39, 45322, 0, 'Solomon', 'Omojola', '2014-03-31 09:51:16', '0000-00-00 00:00:00', '5f4dcc3b5aa765d61d8327deb882cf99', '2014-03-31 10:47:49', 'omojolasolomn@gmail.com', '0000-00-00', 'omojolasolomn@gmail.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
