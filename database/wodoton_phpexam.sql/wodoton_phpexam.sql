-- phpMyAdmin SQL Dump
-- version 3.4.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 21, 2012 at 01:10 PM
-- Server version: 5.0.92
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wodoton_phpexam`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_answer`
--

DROP TABLE IF EXISTS `tb_answer`;
CREATE TABLE IF NOT EXISTS `tb_answer` (
  `int_id_answer` int(11) NOT NULL auto_increment,
  `int_id_question` int(11) NOT NULL,
  `txt_answer` int(11) NOT NULL,
  `bln_correct` tinyint(1) NOT NULL,
  PRIMARY KEY  (`int_id_answer`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_log`
--

DROP TABLE IF EXISTS `tb_log`;
CREATE TABLE IF NOT EXISTS `tb_log` (
  `int_id_log` int(11) NOT NULL auto_increment,
  `int_id_user` int(11) NOT NULL,
  `dat_date` date NOT NULL,
  `chr_alteration` varchar(300) NOT NULL,
  PRIMARY KEY  (`int_id_log`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_question`
--

DROP TABLE IF EXISTS `tb_question`;
CREATE TABLE IF NOT EXISTS `tb_question` (
  `int_id_question` int(11) NOT NULL auto_increment,
  `int_id_typequestion` int(11) NOT NULL,
  `txt_question` text NOT NULL,
  `chr_versionphp` varchar(10) NOT NULL,
  `bln_depreciated` tinyint(1) NOT NULL,
  `flo_difficulty` float NOT NULL,
  `int_flagged` int(1) NOT NULL,
  `int_id_topic` int(11) NOT NULL,
  `bln_eval` tinyint(1) NOT NULL,
  `txt_eval` text NOT NULL,
  `txt_explanation` text NOT NULL,
  `int_id_author` int(11) NOT NULL,
  PRIMARY KEY  (`int_id_question`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_topic`
--

DROP TABLE IF EXISTS `tb_topic`;
CREATE TABLE IF NOT EXISTS `tb_topic` (
  `int_id_topic` int(11) NOT NULL auto_increment,
  `chr_name` varchar(100) NOT NULL,
  `txt_description` text NOT NULL,
  PRIMARY KEY  (`int_id_topic`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_typequestion`
--

DROP TABLE IF EXISTS `tb_typequestion`;
CREATE TABLE IF NOT EXISTS `tb_typequestion` (
  `id_typequestion` int(11) NOT NULL auto_increment,
  `chr_nametypequestion` varchar(50) NOT NULL,
  `chr_description` varchar(200) NOT NULL,
  PRIMARY KEY  (`id_typequestion`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_typeuser`
--

DROP TABLE IF EXISTS `tb_typeuser`;
CREATE TABLE IF NOT EXISTS `tb_typeuser` (
  `int_id_typeuser` int(11) NOT NULL,
  `chr_description` varchar(30) NOT NULL,
  PRIMARY KEY  (`int_id_typeuser`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE IF NOT EXISTS `tb_user` (
  `int_id_user` int(11) NOT NULL,
  `chr_email` varchar(60) NOT NULL,
  `chr_password` varchar(8) NOT NULL,
  `chr_username` varchar(60) NOT NULL,
  `int_id_typeuser` int(11) NOT NULL,
  `bln_active` tinyint(1) NOT NULL,
  PRIMARY KEY  (`int_id_user`),
  UNIQUE KEY `chr_email` (`chr_email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
