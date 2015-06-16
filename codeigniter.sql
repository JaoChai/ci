-- phpMyAdmin SQL Dump
-- version 3.5.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 05, 2013 at 11:52 AM
-- Server version: 5.0.51a-community-log
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `zp10141_ci`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_board_group`
--

CREATE TABLE IF NOT EXISTS `ci_board_group` (
  `id` int(3) NOT NULL auto_increment,
  `seq` int(4) NOT NULL,
  `url` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `detail` text,
  `counter` int(6) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `ci_board_message`
--

CREATE TABLE IF NOT EXISTS `ci_board_message` (
  `id` int(4) NOT NULL auto_increment,
  `by_type` varchar(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `del_id` int(10) NOT NULL,
  `post_date` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

-- --------------------------------------------------------

--
-- Table structure for table `ci_board_reply`
--

CREATE TABLE IF NOT EXISTS `ci_board_reply` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(5) NOT NULL,
  `topic_id` int(6) NOT NULL,
  `detail` text NOT NULL,
  `post_date` datetime NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `topic_id` (`topic_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=526 ;

-- --------------------------------------------------------

--
-- Table structure for table `ci_board_thanks`
--

CREATE TABLE IF NOT EXISTS `ci_board_thanks` (
  `id` int(6) NOT NULL auto_increment,
  `user_id_a` int(5) NOT NULL,
  `user_id_b` int(5) NOT NULL,
  `post_date` date NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=63 ;

-- --------------------------------------------------------

--
-- Table structure for table `ci_board_topic`
--

CREATE TABLE IF NOT EXISTS `ci_board_topic` (
  `id` int(6) NOT NULL auto_increment,
  `seq` int(2) NOT NULL,
  `user_id` int(5) NOT NULL,
  `group_id` int(3) NOT NULL,
  `title` varchar(100) NOT NULL,
  `detail` text NOT NULL,
  `post_date` datetime NOT NULL,
  `up_date` datetime default NULL,
  `reply_date` datetime default NULL,
  `counter` int(6) NOT NULL,
  `reply` int(6) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=327 ;

-- --------------------------------------------------------

--
-- Table structure for table `ci_downloads`
--

CREATE TABLE IF NOT EXISTS `ci_downloads` (
  `id` int(3) NOT NULL auto_increment,
  `group` int(2) NOT NULL,
  `title` varchar(50) NOT NULL,
  `detail` text,
  `name` varchar(30) NOT NULL,
  `add_date` datetime NOT NULL,
  `up_date` datetime default NULL,
  `counter` int(6) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

-- --------------------------------------------------------

--
-- Table structure for table `ci_guide`
--

CREATE TABLE IF NOT EXISTS `ci_guide` (
  `id` int(4) NOT NULL auto_increment,
  `url` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `detail` text NOT NULL,
  `keyword` varchar(100) NOT NULL,
  `post_date` datetime NOT NULL,
  `counter` int(6) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `ci_member`
--

CREATE TABLE IF NOT EXISTS `ci_member` (
  `user_id` int(5) NOT NULL auto_increment,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(30) NOT NULL,
  `image` varchar(30) default NULL,
  `thanks` int(6) NOT NULL,
  `exp` int(6) NOT NULL default '1',
  `signature` text,
  `regis_date` datetime NOT NULL,
  `up_date` datetime default NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=729 ;

-- --------------------------------------------------------

--
-- Table structure for table `ci_message`
--

CREATE TABLE IF NOT EXISTS `ci_message` (
  `id` int(6) NOT NULL auto_increment,
  `user_id` int(5) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `email` varchar(50) default NULL,
  `title` varchar(100) NOT NULL,
  `detail` text NOT NULL,
  `post_date` datetime NOT NULL,
  `user_read` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5508 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
