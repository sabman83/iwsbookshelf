-- phpMyAdmin SQL Dump
-- version 2.9.0.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Dec 02, 2007 at 02:19 PM
-- Server version: 5.0.24
-- PHP Version: 5.1.6
-- 
-- Database: `bookshelf`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `bookmark`
-- 

DROP TABLE IF EXISTS `bookmark`;
CREATE TABLE IF NOT EXISTS `bookmark` (
  `uid` int(10) unsigned NOT NULL,
  `url` varchar(100) collate latin1_general_ci NOT NULL,
  `tags` varchar(30) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`uid`,`url`,`tags`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

-- 
-- Table structure for table `books`
-- 

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `uid` int(10) unsigned NOT NULL,
  `asin` varchar(15) collate latin1_general_ci NOT NULL,
  `rating` int(10) unsigned default NULL,
  `comments` text collate latin1_general_ci,
  `date` date default NULL,
  PRIMARY KEY  (`uid`,`asin`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

-- 
-- Table structure for table `tags`
-- 

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `uid` int(11) NOT NULL,
  `asin` varchar(15) collate latin1_general_ci NOT NULL,
  `tag_names` varchar(45) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`uid`,`asin`,`tag_names`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

-- 
-- Table structure for table `user`
-- 

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(10) unsigned NOT NULL auto_increment,
  `uemail` varchar(30) collate latin1_general_ci NOT NULL,
  `upassword` varchar(10) collate latin1_general_ci NOT NULL,
  `ufirstname` varchar(20) collate latin1_general_ci NOT NULL,
  `ulastname` varchar(20) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`uid`),
  UNIQUE KEY `uemail` (`uemail`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=9 ;
