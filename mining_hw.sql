-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 28 jun 2016 om 20:45
-- Serverversie: 5.5.14
-- PHP-versie: 5.3.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `mining_hw`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  `comment` text NOT NULL,
  `rating` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=223 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(65) NOT NULL DEFAULT '',
  `password` varchar(65) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `id` int(11) NOT NULL,
  `feature1_name` varchar(255) NOT NULL COMMENT 'Feature 1 name',
  `feature2_name` varchar(255) NOT NULL COMMENT 'Feature 2 name',
  `feature3_name` varchar(255) NOT NULL COMMENT 'Feature 3 name',
  `feature4_name` varchar(255) NOT NULL COMMENT 'Feature 4 name',
  `feature5_name` varchar(255) NOT NULL COMMENT 'Feature 5 name',
  `feature6_name` varchar(255) NOT NULL,
  `feature7_name` varchar(255) NOT NULL,
  `feature8_name` varchar(255) NOT NULL,
  `feature9_name` varchar(255) NOT NULL,
  `feature10_name` varchar(255) NOT NULL,
  `seo_title_hp` varchar(255) NOT NULL,
  `seo_description_hp` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `top_listing`
--

CREATE TABLE IF NOT EXISTS `top_listing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `base` text NOT NULL,
  `rank` int(11) NOT NULL,
  `value_feature1` text NOT NULL,
  `value_feature2` text NOT NULL,
  `value_feature3` text NOT NULL,
  `value_feature4` text NOT NULL,
  `value_feature5` text NOT NULL,
  `feature5link` varchar(255) NOT NULL,
  `value_feature6` text NOT NULL,
  `value_feature7` text NOT NULL,
  `value_feature8` text NOT NULL,
  `value_feature9` text NOT NULL,
  `value_feature10` text NOT NULL,
  `description` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `price_display` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `seo_title` varchar(255) NOT NULL,
  `seo_description` varchar(255) NOT NULL,
  `banner1` varchar(255) NOT NULL,
  `banner2` varchar(255) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=300237 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tracking_table`
--

CREATE TABLE IF NOT EXISTS `tracking_table` (
  `recid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `rec_use_topnumber` varchar(220) DEFAULT NULL,
  `rec_use_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`recid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=223 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
