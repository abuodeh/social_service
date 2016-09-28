-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2016 at 11:46 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `social_service_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `user_id`, `post_id`, `time`) VALUES
(4, 'good morning', 1, 2, '2016-09-27 09:26:46'),
(5, '33', 3, 4, '2016-09-27 09:59:44'),
(6, '22', 1, 4, '2016-09-27 10:06:59'),
(9, ';)', 3, 21, '2016-09-28 08:06:55'),
(10, 'hi', 5, 23, '2016-09-28 09:44:12');

-- --------------------------------------------------------

--
-- Table structure for table `information`
--

CREATE TABLE IF NOT EXISTS `information` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `information`
--

INSERT INTO `information` (`id`, `email`, `password`, `name`) VALUES
(1, 's@h.com', '123', 'soad'),
(2, 's1@h.com', '1', 's'),
(3, 'r@h.com', '1234', 's'),
(4, 'a@b.com', '111', 'cd'),
(5, 'm@h.com', '1111', 'muna');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post` varchar(100) NOT NULL,
  `check_image` int(1) NOT NULL DEFAULT '0',
  `image` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `post`, `check_image`, `image`, `user_id`, `time`) VALUES
(2, 'good morning', 0, '', 3, '2016-09-27 07:09:34'),
(4, '11', 0, '', 3, '2016-09-27 08:11:50'),
(8, 'ff', 0, '', 1, '2016-09-27 12:02:01'),
(9, '123', 0, '', 1, '2016-09-27 13:53:03'),
(10, '111', 0, '', 2, '2016-09-27 13:56:28'),
(11, '444', 0, '', 1, '2016-09-27 14:44:19'),
(13, 'n', 0, '', 1, '2016-09-28 06:57:41'),
(14, 'q', 0, '', 1, '2016-09-28 07:08:49'),
(19, '', 1, '90665dreamjordan_com.png', 1, '2016-09-28 07:51:33'),
(21, '', 1, 'eid.jpg', 1, '2016-09-28 08:01:30'),
(22, '', 1, 'Chrysanthemum.jpg', 3, '2016-09-28 09:43:00'),
(23, 'good evening', 0, '', 3, '2016-09-28 09:43:20');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
